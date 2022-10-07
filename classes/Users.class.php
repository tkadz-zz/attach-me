<?php


class Users extends Dbh
{



    protected function loginCompanySubAcc($subID, $subCompanyID, $password){
        //login SubAcc
        $sql = "SELECT * FROM company_sub_accounts WHERE id=? AND companyID=? ";
        $stmt = $this->con()->prepare($sql);
        $res = $stmt->execute([$subID, $subCompanyID]);
        //TODO Update code to check if user is active or not
        if ($res) {
            $record = $stmt->fetchAll();
            /* Check the number of rows that match the SELECT statement */
            if (count($record) > 0) {
                foreach ($record as $row) {
                    //
                    $passwords = $row["password"];
                    if (password_verify($password, $passwords)) {
                        session_start();
                        $_SESSION['subID'] = $subID;

                        $_SESSION['subName'] = $row['name'];
                        $_SESSION['subSurname'] = $row['surname'];
                        $_SESSION['subDepartment'] = $row['department'];

                        //Sub Acc Logged-in
                        $_SESSION['type'] = 's';
                        $_SESSION['err'] = 'Welcome Back '. $row["name"] ." ". $row["surname"] .' ';
                        echo "<script type='text/javascript'>;
                          window.location='../dashboard.php';
                        </script>";

                    } else {
                        //Password Did Not match
                        $_SESSION['type'] = 'w';
                        $_SESSION['err'] = 'Wrong Sub-Account Or Password for '. $row["name"] ." ". $row["surname"] .' ';

                        echo "<script type='text/javascript'>;
                          window.location='../accounts.php';
                        </script>";
                    }
                }

            }
            else{
                //else of countrecords
            }
        }
        else{
            //else of if res
        }


    }


    //Notifications
    protected function getallnotifications($id){
        $sql = "SELECT * from notifications where receiverID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function getallactivenotifications($id){
        $unreadStatus = 1;
        $undelStatus = 1;
        $notyTypeLimit = 6;
        $sql = "SELECT * from notifications where receiverID=? AND notyStatus=? AND notyType<=? AND notyDelStatus=? ORDER BY dateReceived DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id, $unreadStatus,$notyTypeLimit, $undelStatus]);
        return $stmt->fetchAll();
    }





    protected function passwordreserttoken($email)
    {
        $expFormat = mktime(
            date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y")
        );
        $expDate = date("Y-m-d H:i:s", $expFormat);
        $key = md5($email);
        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
        $key = $key . $addKey;

        $sql = "INSERT INTO password_reset_temp(email, token_key, expDate) VALUES(?, ?, ?)";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$email, $key, $expDate]);

        /* $r = mysqli_fetch_assoc($res);
         $password = $r['password'];
         $to = $email;
         $subject = "Your Recovered Password";

         $message = "Please use this password to login " . $password;
         $headers = "From : vivek@codingcyber.com";
         if(mail($to, $subject, $message, $headers)){
             echo "Your Password has been sent to your email id";
         }else{
             echo "Failed to Recover your password, try again";
         }*/





    }


    protected function forgotpassword($email){
        $sql1 = "SELECT email FROM students WHERE email=?;";
        $sql2 = "SELECT email FROM company WHERE email=?;";
        $sql3 = "SELECT email FROM institute WHERE email=?;";

        $stmt1 = $this->con()->prepare($sql1);
        $stmt2 = $this->con()->prepare($sql2);
        $stmt3 = $this->con()->prepare($sql3);

        $stmt1->execute([$email]);
        $stmt2->execute([$email]);
        $stmt3->execute([$email]);

        $value1 = $stmt1->fetchAll();
        $value2 = $stmt2->fetchAll();
        $value3 = $stmt3->fetchAll();

        if(count($value1) > 0){
            Usercontr::passwordreserttoken($email);
        }
        elseif (count($value2) > 0){
            Usercontr::passwordreserttoken($email);
        }
        elseif (count($value3)){
            Usercontr::passwordreserttoken($email);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'No account is linked with this email address';
            echo "<script type='text/javascript'>;
                      window.location='../forgotpassword.php?email=$email';
                    </script>";
        }


    }


    //-------------------------------------------------------------
    //student profile section

    protected function studentUpdatePassword($op, $cp, $id){
        //update student password
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $rows = $stmt->fetchAll();

        if(password_verify($op, $rows[0]['password'])){
            //Match
            $sql2 = "UPDATE users SET password=? WHERE id=?";
            $stmt2 = $this->con()->prepare($sql2);
            $pass_safe = password_hash($cp, PASSWORD_DEFAULT);

            if($stmt2->execute([$pass_safe, $id])){

                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Password Updated Successfully';

                echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
            }
            else{

                $_SESSION['type'] = 'd';
                $_SESSION['err'] = 'Password Update Failed';

                echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
            }
        }
        else{
            //Not Matched

            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Old password did not match';

            echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
        }

    }


    protected function studentUpdateProfile($name,$surname,$phone,$homeAddress,$postalAddress,$country,$email,$sex,$dob,$id){

        $sql = "Update students Set name=?, surname=?, phone=?, homeAddress=?, postalAddress=?, nationality=?, email=?, sex=?, dob=? WHERE user_id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name,$surname,$phone,$homeAddress,$postalAddress,$country,$email,$sex,$dob,$id])){
            //success
            $_SESSION['name'] = $name;
            $_SESSION['surname'] = $surname;

            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Profile Updated Successfully';

            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }
        else{
            //err
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile Failed To Update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }

    }






    //student profile section

    //---------------------------------------------------------------



    protected function ShowPrograms(){
        $active_status = 1;
        $sql = "SELECT * from program where status=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$active_status]);
        return $stmt->fetchAll();
    }

    protected function ShowInstitutes(){
        $instituteRole = 'institute';
        $active_status = 1;
        $sql1 = "SELECT * FROM users where role=? AND status=?";
        $stmt1 = $this->con()->prepare($sql1);
        $stmt1->execute([$instituteRole, $active_status]);
        $rows1 = $stmt1->fetchAll();

        $userID = $rows1[0]['id'];

        $sql = "SELECT * from institute where user_id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$userID]);
        return  $stmt->fetchAll();
    }

    //STUDENT LOGIN/SIGNIN
    protected function SigninUser($loginID, $password)
    {
        $sql = "SELECT * FROM users WHERE loginID=? ";
        $stmt = $this->con()->prepare($sql);
        $res = $stmt->execute([$loginID]);

        if ($res) {
            $record = $stmt->fetchAll();
            /* Check the number of rows that match the SELECT statement */
            if (count($record) > 0) {
                foreach ($record as $row) {
                    $passwords = $row["password"];
                    $user_id = $row["id"];

                    if (password_verify($password, $passwords)) {
                        session_start();
                        $_SESSION['id'] = $user_id;
                        Usercontr::autologinUsers($_SESSION['id'], $loginID);
                    } else {
                        //Password Did Not match
                        $_SESSION['type'] = 'w';
                        $_SESSION['err'] = 'Wrong LoginID or Password';

                        echo "<script type='text/javascript'>;
                          window.location='../signin.php?regNum=".$loginID."';
                        </script>";
                    }
                }
            }
            /* No rows matched -- do something else */
            else {
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Wrong LoginID or Password';

                echo "<script type='text/javascript'>;
                          window.location='../signin.php?regNum=".$loginID."';
                        </script>";
            }
        }
    }





    //STUDENT REGISTRATION CLASSES

    protected function Stage4($id){
        $regStatus = 4;
        Usercontr::UpdateRegStatus($regStatus, $id);

    }


    protected function Stage3($institute, $program, $programType, $dateStart, $dateEnd, $id){
        $sql = 'INSERT into studentEducation(user_id, school_id, program, programType, initial_year, final_year)
                VALUES(?,?,?,?,?,?)';
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$id, $institute, $program, $programType, $dateStart, $dateEnd])) {
            $regStatus = 3;
            Usercontr::UpdateRegStatus($regStatus, $id);
        }
        else{
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'Opps! Something went wrong with this step';
            echo "<script type='text/javascript'>;
                      window.location='../signup.php';
                    </script>";
        }
    }


    protected function Stage2($DOB, $marital, $gender, $phone, $email, $country, $religion, $about, $id){
        $sql = 'UPDATE students SET dob=?, marital=?, sex=?, phone=?, email=?, nationality=?, religion=?, aboutSelf=? WHERE user_id=?';
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$DOB, $marital, $gender, $phone, $email, $country, $religion, $about, $id])) {
            $regStatus = 2;
            Usercontr::UpdateRegStatus($regStatus, $id);
        }
        else{
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'Opps! Something went wrong with this step';
            echo "<script type='text/javascript'>;
                      window.location='../signup.php';
                    </script>";
        }
    }



    protected function UpdateRegStatus($regStatus, $id){
        $NewRegStatus = $regStatus + 1;
        $sql = 'UPDATE users SET regStatus=? WHERE id=?';
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$NewRegStatus, $id])) {
            if($NewRegStatus == 2){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Hooray!, you are now one of us. We just need a few information to get your account up and going';
                echo "<script type='text/javascript'>;
                          window.location='../signup.php';
                        </script>";
            }
            elseif($NewRegStatus == 3){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'You are a step closer to finalising your account setup';
                echo "<script type='text/javascript'>;
                          window.location='../signup.php';
                        </script>";
            }
            elseif($NewRegStatus == 4){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Your account setup is complete, you can now enjoy learning the easy way';
                echo "<script type='text/javascript'>;
                          window.location='../signup.php';
                        </script>";
            }
            elseif($NewRegStatus == 5){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Thank you for being part of us once again';
                echo "<script type='text/javascript'>;
                          window.location='../". $_SESSION['role'] ."/index.php';
                        </script>";
            }

        }
        else{
            //FAILED UPDATING REG STATUS
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to update Registration Status';
            echo "<script type='text/javascript'>;
                          window.location='../signup.php';
                        </script>";
        }
    }


    protected function GetCompanyById($id){
        $sql = "SELECT * FROM company WHERE user_id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetSubCompanyById($id){
        $sql = "SELECT * FROM company_sub_accounts WHERE companyID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetUser($id){
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetStudentByID($id){
        $sql = "SELECT * FROM students WHERE user_id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }


    protected function GetUserByLoginID($loginID){
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$loginID]);
        return $stmt->fetchAll();
    }


    protected function autoLogin($id, $loginID){
        //AUTO LOGIN FROM ACCOUNT CREATION
        $rowsUser = $this->GetUserByLoginID($loginID);


        if($rowsUser[0]['role'] == 'student'){

            $rowsStudent = $this->GetStudentByID($id);
            session_start();
            $_SESSION['name'] = $rowsStudent[0]['name'];
            $_SESSION['surname'] = $rowsStudent[0]['surname'];
            $_SESSION['id'] = $rowsUser[0]['id'];
            $_SESSION['regNumber'] = $loginID;
            $_SESSION['role'] = $rowsUser[0]['role'];

            $updateRegS = new Usercontr();
            $updateRegS->UpdateRegStatus($rowsUser[0]['regStatus'], $_SESSION['id']);
        }

        elseif($rowsUser[0]['role'] == 'company'){
            echo '<br>Company, This user role redirect behaviour has not yet been set up , please define it';
        }

        elseif($rowsUser[0]['role'] == 'institute'){
            echo '<br>institute, This user role redirect behaviour has not yet been set up , please define it';
        }

        elseif($rowsUser[0]['role'] == 'admin'){
            echo '<br>admin, This user role redirect behaviour has not yet been set up , please define it';
        }
        else{
            echo '<br>error role';
        }

    }


    protected function autoLoginUsers($id, $loginID){
        //LOGIN FROM NORMAL LOGIN PAGE
        $rowsUser = $this->GetUserByLoginID($loginID);


        if($rowsUser[0]['role'] == 'student'){
            //redirect to student Portal
            $rowsStudent = $this->GetStudentByID($id);
            $_SESSION['name'] = $rowsStudent[0]['name'];
            $_SESSION['surname'] = $rowsStudent[0]['surname'];
            $_SESSION['regNumber'] = $loginID;
            $_SESSION['role'] = $rowsUser[0]['role'];

            if($rowsUser[0]['status'] != 1){
                $_SESSION['type'] = 'd';
                $_SESSION['err'] = 'Your account ('. $rowsStudent[0]['name'] .' '. $rowsStudent[0]['surname'] .') is temporarily deactivated. Contact the administrator to get this issue fixed';

                unset($_SESSION['id']);
                unset($_SESSION['name']);
                unset($_SESSION['surname']);
                unset($_SESSION['email']);
                unset($_SESSION['role']);
                unset($_SESSION['status']);

                echo "<script type='text/javascript'>
                        window.location='../signin.php?regNum=$loginID';
                      </script>";
            }
            else {
                if ($rowsUser[0]['regStatus'] < 5) {
                    //redirect to signupPage to finish registration

                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = 'Your account registration progress was successfully retrieved from last registration attempt';

                    echo "<script type='text/javascript'>
                        window.location='../signup.php';
                      </script>";
                }

                else{

                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = 'Welcome Back!';

                    echo "<script type='text/javascript'>
                        window.location='../student/index.php';
                      </script>";
                }
            }
        }

        //TODO Update company login to check for deactivated and active users
        elseif($rowsUser[0]['role'] == 'company'){

            $rowsCompany = $this->GetCompanyById($id);
            $_SESSION['name'] = $rowsCompany[0]['name'];
            $_SESSION['email'] = $rowsCompany[0]['email'];
            $_SESSION['role'] = $rowsUser[0]['role'];

            //redirect to company profile
            if($rowsUser[0]['status'] != 1){
                $_SESSION['type'] = 'd';
                $_SESSION['err'] = 'Your account is temporarily deactivated. Contact the administrator to get this issue fixed';

                unset($_SESSION['id']);
                unset($_SESSION['name']);
                unset($_SESSION['surname']);
                unset($_SESSION['email']);
                unset($_SESSION['role']);
                unset($_SESSION['status']);

                echo "<script type='text/javascript'>
                        window.location='../signin.php?regNum=$loginID';
                      </script>";
            }
            else {

                echo "<script type='text/javascript'>
                        window.location='../company/index.php?type=s&err=Welcome Back!';
                      </script>";

            }
        }

        //TODO Update institute login to check for deactivated and active users
        elseif($rowsUser[0]['role'] == 'institute'){
            //redirrect to institute profile
            if($rowsUser[0]['regStatus'] < 4){
                //redirect to signupPage to finish registration
                echo "<script type='text/javascript'>
                        window.location='../signup.php?type=w&err=Your account registration progress was successfully retrieved from last registration attempt';
                      </script>";
            }
            else{
                echo "<script type='text/javascript'>
                        window.location='../institute/index.php?type=s&err=Welcome Back!';
                      </script>";
            }
        }

        //TODO Update admin login to check for deactivated and active users
        elseif ($rowsUser[0]['role'] == 'admin'){
            //redirect to admin profile
            //redirrect to institute profile
            $rowsStudent = $this->GetStudentByID($id);

            $_SESSION['role'] = $rowsUser[0]['role'];

            echo "<script type='text/javascript'>
                    window.location='../admin/index.php?type=s&err=Logged in as an Administrator ';
                  </script>";

        }

        else{
            //error user login destination not defined
        }




    }



    protected function setIndexUserRow($loginID, $name, $surname){
        $rows = $this->GetUserByLoginID($loginID);
        $user_id = $rows[0]['id'];
        $user_role = $rows[0]['role'];
        $blank = '';
        $myNull = 0;
        if($user_role == 'admin'){
            // TODO: CODE ADMIN SIGN SIGNUP INDEX
            //ADMIN
        }
        elseif ($user_role == 'student'){
            //STUDENT
            $sql = "INSERT INTO students(user_id, name, surname, email, phone, dob, sex, marital, avatar, homeAddress, postalAddress, nationality, religion, aboutSelf, attachmentStatus)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);

            if($stmt->execute([$user_id, $name, $surname, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $myNull])){
                //USER CREATED SUCCESSFULLY
                $autoLogin = new Usercontr();
                $autoLogin -> autologinSet($user_id, $loginID);
            }
            else{
                //FAILED CREATING THE STUDENT
                //echo 'Failed to create student';
                echo "<script type='text/javascript'>;
                          window.location='../signup.php?type=w&err=Failed to create student account';
                        </script>";
            }
        }
        elseif ($user_role == 'company'){
            // TODO: CODE COMPANY SIGNUP INDEX
            //COMPANY
        }
        elseif ($user_role == 'institute'){
            // TODO: CODE COMPANY SIGNUP INDEX
            //INSTITUTE
        }
        else{
            //echo 'ERROR: INVALID USER';
            echo "<script type='text/javascript'>;
                          window.location='../signup.php?type=w&err=ERROR: INVALID USER';
                        </script>";
        }
    }



    protected function setStudentAccount($name, $surname, $loginID, $password, $user_role, $active_status, $reg_status, $joined){
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$loginID]);
        $rows = $stmt->fetchAll();
        if($stmt){
            //QUERY SUCCESS
            if(count($rows) > 0){
                //  ACCOUNT EXIST
                if($user_role == "student")
                {
                    // echo "Account with same RegNumber already exist";
                    echo "<script type='text/javascript'>;
                          window.location='../signup.php?type=w&err=Account with same RegNumber already exist';
                        </script>";

                }
                else{
                    // echo "Account with same Login-ID already exist";
                    echo "<script type='text/javascript'>;
                          window.location='../signup.php?type=w&err=Account with same Login-ID already exist';
                        </script>";

                }
            }
            else{
                //ACCOUNT NOT FOUND HENCE PROCEED
                $setSql = "INSERT INTO users(loginID, password, role, joined, regStatus, status)
                        VALUES (?,?,?,?,?,?)";
                $setStmt = $this->con()->prepare($setSql);
                if($setStmt->execute([$loginID, $password, $user_role, $joined, $reg_status, $active_status])){
                    //ACCOUNT CREATED SUCCESSFULLY
                    //echo 'ACCOUNT CREATED SUCCESSFULLY';
                    //PROCEED WITHOUT REDIRECT

                    $createIndexUserRow = new Usercontr();
                    $createIndexUserRow->createIndexUserRow($loginID, $name, $surname);

                }
                else{
                    //FAILED TO CREATE USER
                    //echo 'Failed to create user';
                    echo "<script type='text/javascript'>;
                          window.location='../signup.php?type=w&err=Failed to create user';
                        </script>";
                }
            }
        }
        else{
            //FAILED EXECUTING THE QUERY;
            //echo 'Failed executing query';
            echo "<script type='text/javascript'>;
                          window.location='../signup.php?type=w&err=Failed executing query';
                        </script>";
        }
    }


}