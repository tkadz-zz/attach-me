<?php


class Users extends Dbh{



    public function deleteApplication($vuid, $userID){
        $sql = 'DELETE FROM applications WHERE vacancyUID=? and userID=?';
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$vuid, $userID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Application Has been Deleted Successfully';
            echo "<script type='text/javascript'>;
                      window.location='../applicants.php?vuid=$vuid';
                    </script>";
        }
        else{
            $this->opps();
        }
    }

    public function markApplicationAsRead($vuid, $userID){
        $this->ReadUnreadApplication($vuid, $userID);
        $_SESSION['type'] = 's';
        $_SESSION['err'] = 'Action Successful';
        echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
    }




    protected function attachStudent($companyID, $subID, $today, $start, $end, $userID){
        $status = 1;
        $sql = "INSERT INTO attachments(userID, companyID, subID, dateAdded, dateStart, dateEnd, status) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);

        $this->updateAttachmentStatus($userID);

        $this->updateApplicantStatusToInavtive($userID);


        if($stmt->execute([$userID, $companyID, $subID, $today, $start, $end, $status])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Student successfully attached';
            echo "<script type='text/javascript'>;
                      window.location='../studentProfile.php?userID=$userID';
                    </script>";
        }
        else{
            $this->opps();
        }
    }

    protected function updateApplicantStatusToInavtive($id){
        $active = 0;
        $sql = "UPDATE applications SET status=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$active, $id]);
    }

    protected function updateAttachmentStatus($id){
        $active = 1;
        $sql = "UPDATE students SET attachmentStatus=? WHERE user_id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$active, $id]);
    }


    protected function ReadUnreadApplication($vuid, $id){
        $appRows = $this->GetApplicationByUserID($id);

        if($appRows[0]['readStatus'] != 1) {
            $read = 1;
        }
        else {
            $read = 0;
        }
        $today = date('Y-m-d H:m:s');
        $sql = "UPDATE applications SET readStatus=?, dateRead=? WHERE userID=? AND vacancyUID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$read, $today, $id, $vuid]);
    }


    protected function openApplication($vuid, $id){
        $appRows = $this->GetApplicationByUserID($id);
        if($appRows[0]['readStatus'] != 1) {
            $today = date('Y-m-d H:m:s');
            $read = 1;
            $sql = "UPDATE applications SET readStatus=?, dateRead=? WHERE userID=? AND vacancyUID=?";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$read, $today, $id, $vuid]);
        }
    }


    protected function vacancyApply($vuid, $id){
        $vacancyRows = $this->GetVacancyByUniqueID($vuid);
        $companyID = $vacancyRows[0]['companyID'];
        $readStatus = 0; $blank = ''; $today = date('Y-m-d H:m:s'); $activeStatus = 1;

        $sql = 'INSERT INTO applications(userID, companyID, vacancyUID, readStatus, dateRead, dateAdded, status)VALUES(?,?,?,?,?,?,?)';
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$id, $companyID, $vuid, $readStatus, $blank, $today, $activeStatus])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Vacancy Application has been Successfully Sent';
            echo "<script type='text/javascript'>;
                      window.location='../apply.php?vuid=$vuid';
                    </script>";
        }
        else{
            $this->opps();
        }
    }


    protected function subAccUpdateProfile($name,$surname,$phone,$email,$sex,$id){
        $sql = "UPDATE company_sub_accounts SET name=?, surname=?, sex=?, email=?, phone=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $sex, $email, $phone, $id])){

            $_SESSION['subName'] = $name;
            $_SESSION['subSurname'] = $surname;
            $_SESSION['subEmail'] = $email;
            $_SESSION['sex'] = $sex;

            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Profile Update Successfully';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Something went wrong. Please try again. If the problem persist contact system administrator';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
    }

    protected function deleteProfilePicture($id){
        $userRows = $this->isUser($id, $_SESSION['role']);
        $source = "../" . $userRows[0]['avatar'];
        $blank = '';

        if($userRows[0]['avatar'] == ''){
            $_SESSION['type'] = 'i';
            $_SESSION['err'] = 'Profile picture unavailable';
            echo "<script type='text/javascript'>
                    history.back(-1);
                </script>";
        }
        else {
            if (unlink($source)) {
                if($_SESSION['role'] == 'student'){
                    $sql = "UPDATE students SET avatar=? WHERE user_id=?";
                }
                if($_SESSION['role'] == 'company'){
                    //TODO: Company Profile Picture Update
                    $sql = "UPDATE company_sub_accounts SET avatar=? WHERE id=?";
                }
                //TODO: More Profile to appear here


                $stmt = $this->con()->prepare($sql);

                if ($stmt->execute([$blank, $id])) {
                    $_SESSION['avatar'] = $blank;
                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = 'Profile Picture Removed';
                    echo "<script type='text/javascript'>
                    history.back(-1);
                </script>";
                } else {
                    $this->opps();
                }
            } else {
                $this->opps();
            }
        }
    }

    protected function updateProfileImage($file_tmp, $file_destination, $file_name_new, $file_ext, $id)
    {
        $filed = '../profileImages/' . $file_name_new . '';
        $userRows = $this->isUser($id, $_SESSION['role']);

            if ($userRows[0]['avatar'] != '') {
                $source = "../" . $userRows[0]['avatar'];
                if (!unlink($source)) {
                    $this->opps();
                }
            }

            if(move_uploaded_file($file_tmp, $file_destination)) {
                if($_SESSION['role'] == 'student'){
                    $sql = "UPDATE students SET avatar=? WHERE user_id=?";
                }
                if($_SESSION['role'] == 'company'){
                    //TODO: Company Profile Picture Update
                    $sql = "UPDATE company_sub_accounts SET avatar=? WHERE id=?";
                }

                $stmt = $this->con()->prepare($sql);

                if ($stmt->execute([$filed, $id])) {
                    $_SESSION['avatar'] = $filed;
                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = 'Profile Picture Updated Successfully';
                    echo "<script type='text/javascript'>
                    window.location='../profile.php';
                </script>";
                } else {
                    $this->opps();

                }
            }
            else{
                $this->opps();
            }
    }


    protected function opps(){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Sorry! Something went wrong. Please try again and if the problem persist contact system administrator';
        echo "<script type='text/javascript'>;
                      history.back();
                    </script>";
    }

    protected function addCategory($category, $description, $dateAdded, $companyID, $subID){
        $actives = 1;
        $sql = "INSERT INTO vacancyCategories(companyID, category, addedOn, subID, comment, status) VALUES(?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$companyID, $category, $dateAdded, $subID, $description, $actives])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Category Added Successfully';
            echo "<script type='text/javascript'>;
                      window.location='../vacancyCategories.php';
                    </script>";
        }
        else{
            $this->opps();
        }
    }

    protected function finishPostingVacancy($vuid){
        $rows = $this->GetVacancyByUniqueID($vuid);
        $rows2 = $this->getQualificationsByVacancyID($vuid);

        if($rows[0]['dateOnline'] == ''){
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Please set the date to post this vacancy online';
            echo "<script type='text/javascript'>;
                      window.location='../postVacancyFinal.php?vuid=$vuid';
                    </script>";
        }
        elseif (count($rows2) < 1){
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Please provide atleast one qualification before proceeding';
            echo "<script type='text/javascript'>;
                      window.location='../postVacancyFinal.php?vuid=$vuid';
                    </script>";
        }
        else{
            $status = 1;
            $sql = "UPDATE vacancies set status=? WHERE uniqueID=?";
            $stmt = $this->con()->prepare($sql);
            if($stmt->execute([$status, $vuid])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Everything is now ready';
                echo "<script type='text/javascript'>;
                      window.location='../vacancySummery.php?vuid=$vuid';
                    </script>";
            }
            else{
                $this->opps();
            }

        }

    }

    protected function postVacancyOnlineDate($vuid, $onlineDate){
        $sql = "UPDATE vacancies SET dateOnline=? WHERE uniqueID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$onlineDate,$vuid])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Vacancy online date successfully set';
            echo "<script type='text/javascript'>;
                      window.location='../postVacancyFinal.php?vuid=$vuid';
                    </script>";
        }
        else{
            $this->opps();
        }

    }

    protected function deletePostVacancyQualification($vuid, $id){
        $sql = "DELETE FROM vacancyQualifications WHERE vacancyID=? AND id=?";
        $stmt = $this->con()->prepare($sql);
        if ($stmt->execute([$vuid, $id])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Qualification removed successfully';
            echo "<script type='text/javascript'>;
                      window.location='../postVacancyFinal.php?vuid=$vuid';
                    </script>";
        }
        else{
            $this->opps();
        }
    }

    protected function postVacancyQualification($qualification, $vacancyID, $dateAdded){
        $sql = "INSERT INTO vacancyQualifications(vacancyID, qualification, dateAdded)
                VALUES (?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$vacancyID, $qualification, $dateAdded])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Qualification added successfully';
            echo "<script type='text/javascript'>;
                      window.location='../postVacancyFinal.php?vuid=$vacancyID';
                    </script>";

        }
        else{
            $this->opps();
        }
    }

    protected function postVacancy($randomSTR, $title, $location, $expDate, $category, $body, $dateAdded, $postOnlineDate, $companyID, $subID){
        $status = 0;
        $sql = "INSERT INTO vacancies(uniqueID, companyID, subID, title, location, body, cartegory, expiryDate, datePosted, dateOnline, status)
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$randomSTR, $companyID, $subID, $title, $location, $body, $category, $expDate, $dateAdded, $postOnlineDate, $status])){
            $sql1 = 'SELECT * FROM vacancies WHERE uniqueID=?';
            $stmt1 = $this->con()->prepare($sql1);
            $stmt1->execute([$randomSTR]);
            $rows = $stmt1->fetchAll();
            $newV = $rows[0]['uniqueID'];

            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Vacancy Set Successfully';
            echo "<script type='text/javascript'>;
                      window.location='../postVacancyFinal.php?vuid=$randomSTR';
                    </script>";

        }
        else{
            $this->opps();
        }


    }

    protected function subCompanyUpdatePassword($op, $cp, $id){
        //update student password
        $sql = "SELECT * FROM company_sub_accounts WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $rows = $stmt->fetchAll();

        if(password_verify($op, $rows[0]['password'])){
            //Match
            $sql2 = "UPDATE company_sub_accounts SET password=? WHERE id=?";
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
                $this->opps();
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
                $this->opps();
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
            $_SESSION['sex'] = $sex;

            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Profile Updated Successfully';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }
        else{
            $this->opps();
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

    protected function getQualificationsByVacancyID($id){
        $active_status = 1;
        $sql = "SELECT * from vacancyQualifications where vacancyID=? order by id desc";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
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

    protected function GetAllInstitutes(){
        $sql = "SELECT * FROM institute";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
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
        $sql = 'INSERT into studentEducation(userID, schoolID, programID, programType, initial_year, final_year)
                VALUES(?,?,?,?,?,?)';
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$id, $institute, $program, $programType, $dateStart, $dateEnd])) {
            $regStatus = 3;
            Usercontr::UpdateRegStatus($regStatus, $id);
        }
        else{
            $this->opps();
        }
    }

    protected function Stage2($nid, $DOB, $marital, $gender, $phone, $email, $country, $religion, $about, $id){
        $sql = 'UPDATE students SET nationalID=?, dob=?, marital=?, sex=?, phone=?, email=?, nationality=?, religion=?, aboutSelf=? WHERE user_id=?';
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$nid, $DOB, $marital, $gender, $phone, $email, $country, $religion, $about, $id])) {
            $regStatus = 2;
            Usercontr::UpdateRegStatus($regStatus, $id);
        }
        else{
            $this->opps();
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
            $this->opps();
        }
    }

    protected function dateToDay($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('l j F Y',$history_bus_date_tostring);
    }

    protected function dayDate($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('j F Y',$history_bus_date_tostring);
    }

    protected function dateToDayMDY($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('F j Y',$history_bus_date_tostring);
    }

    protected function timeAgo($mydate){
        $time_ago = strtotime($mydate);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "just now";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "one minute ago";
            }
            else{
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "an hour ago";
            }else{
                return "$hours hrs ago";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "yesterday";
            }else{
                return "$days days ago";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "a week ago";
            }else{
                return "$weeks weeks ago";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "a month ago";
            }else{
                return "$months months ago";
            }
        }
        //Years
        else{
            if($years==1){
                return "one year ago";
            }else{
                return "$years years ago";
            }
        }
    }

    protected function dateTimeToDay($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('l j F Y h:m:s A',$history_bus_date_tostring);
    }


    //$GET BY FUNCTIONS


    protected function isUser($id, $role){
        if($role == 'admin'){
            return $this->GetAdminByUserID($id);
        }
        if($role == 'student'){
            return $this->GetStudentByID($id);
        }
        if($role == 'institute'){
            return $this->GetInstituteByUserID($id);
        }
        if($role == 'company'){
            if(isset($_SESSION['subID'])){
                return $this->GetSubAccByID($id);
            }
            else{
                return $this->GetCompanyById($id);
            }
        }

    }



    protected function GetCvByUserID($id){
        $sql = "SELECT * FROM cv WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }


    protected function GetCategoryByID($id){
        $sql = "SELECT * FROM vacancyCategories WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetCategoriesMiniLoop(){
        $sql = "SELECT * FROM vacancyCategories order by RAND() limit 0,6";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetStudentEducationByUserID($id){
        $sql = "SELECT * FROM studentEducation WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetInstituteByUserID($id){
        $sql = "SELECT * FROM institute WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetInstituteByID($id){
        $sql = "SELECT * FROM institute WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetProgramByID($id){
        $sql = "SELECT * FROM program WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAllVacancyCategorysByCompanyID($id){
        $sql = "SELECT * FROM vacancyCategories WHERE companyID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAllVacancyCategories(){
        $sql = "SELECT * FROM vacancyCategories";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetAllVacancyByCompanyID($id){
        $sql = "SELECT * FROM vacancies WHERE companyID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }


    protected function GetApplicationByUserIDandVacancyID($vuid, $id){
        $sql = "SELECT * FROM applications WHERE vacancyUID=? AND userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$vuid, $id]);
        return $stmt->fetchAll();
    }

    protected function GetActiveApplicationByVacancyUID($vuid){
        $active = 1;
        $sql = "SELECT * FROM applications WHERE vacancyUID=? AND status=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$vuid, $active]);
        return $stmt->fetchAll();
    }



    protected function GetApplicationByCompanyID($id){
        $sql = "SELECT * FROM applications WHERE companyID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetApplicationByUserID($id){
        $sql = "SELECT * FROM applications WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }




    protected function GetVacancyByUniqueID($uniqueID){
        $sql = "SELECT * FROM vacancies WHERE uniqueID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$uniqueID]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }


    protected function GetCompanyById($id){
        $sql = "SELECT * FROM company WHERE user_id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetCompanyByUserID($id){
        $sql = "SELECT * FROM company WHERE user_id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAttachmentsByUserID($id){
        $sql = "SELECT * FROM attachments WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetSubCompanyById($id){
        $sql = "SELECT * FROM company_sub_accounts WHERE companyID=? ORDER BY role ASC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetSubAccByID($id){
        $sql = "SELECT * FROM company_sub_accounts WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetSubAccByCompanyAndUserID($id, $subID){
        $sql = "SELECT * FROM company_sub_accounts WHERE companyID=? AND id=? ORDER BY role ASC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id, $subID]);
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

    protected function GetStudentByNationalID($nid){
        $sql = "SELECT * FROM students WHERE nationalID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$nid]);
        return $stmt->fetchAll();
    }



    protected function GetUserByLoginID($loginID){
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$loginID]);
        return $stmt->fetchAll();
    }



    protected function loginCompanySubAcc($subID, $subCompanyID, $password){
        //login SubAcc
        $sql = "SELECT * FROM company_sub_accounts WHERE id=? AND companyID=? ";
        $stmt = $this->con()->prepare($sql);
        $res = $stmt->execute([$subID, $subCompanyID]);
        if ($res) {
            $record = $stmt->fetchAll();
            /* Check the number of rows that match the SELECT statement */
            if (count($record) > 0) {
                foreach ($record as $row) {
                    $passwords = $row["password"];
                    if (password_verify($password, $passwords)) {
                        $_SESSION['subID'] = $subID;
                        $_SESSION['subName'] = $row['name'];
                        $_SESSION['subEmail'] = $row['email'];
                        $_SESSION['subSurname'] = $row['surname'];
                        $_SESSION['subDepartment'] = $row['department'];
                        $_SESSION['subRole'] = $row['role'];
                        $_SESSION['avatar'] = $row['avatar'];
                        $_SESSION['sex'] = $row['sex'];

                        //redirect to subcompany profile
                        if($row['status'] != 1){
                            $_SESSION['type'] = 'd';
                            $_SESSION['err'] = 'account '. $row["name"] ." ". $row["surname"] .' is temporarily deactivated. Contact your administrator for more details';
                            unset($_SESSION['subID']);
                            unset($_SESSION['subName']);
                            unset($_SESSION['subSurname']);
                            unset($_SESSION['subDepartment']);
                            echo "<script type='text/javascript'>
                                window.location='../accounts.php';
                              </script>";
                        }
                        else {
                            //Sub Acc Logged-in
                            $_SESSION['type'] = 's';
                            $_SESSION['err'] = 'Welcome Back '. $row["name"] ." ". $row["surname"] .' ';
                            echo "<script type='text/javascript'>;
                          window.location='../dashboard.php';
                        </script>";

                        }
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
                $this->opps();
            }
        }
        else{
            $this->opps();
        }


    }

    protected function autoLogin($id, $loginID){
        //AUTO LOGIN FROM ACCOUNT CREATION
        $rowsUser = $this->GetUserByLoginID($loginID);


        if($rowsUser[0]['role'] == 'student'){

            $rowsStudent = $this->GetStudentByID($id);
            $_SESSION['name'] = $rowsStudent[0]['name'];
            $_SESSION['surname'] = $rowsStudent[0]['surname'];
            $_SESSION['sex'] = $rowsStudent[0]['sex'];
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
            $_SESSION['avatar'] = $rowsStudent[0]['avatar'];
            $_SESSION['sex'] = $rowsStudent[0]['sex'];

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
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Welcome Back!';
                echo "<script type='text/javascript'>
                        window.location='../company/index.php';
                      </script>";

            }
        }

        //TODO Update institute login to check for deactivated and active users
        elseif($rowsUser[0]['role'] == 'institute'){
            //redirrect to institute profile
            if($rowsUser[0]['regStatus'] < 4){
                //redirect to signupPage to finish registration
                $_SESSION['type'] = 'i';
                $_SESSION['err'] = 'Your account registration progress was successfully retrieved from last registration attempt';
                echo "<script type='text/javascript'>
                        window.location='../signup.php';
                      </script>";
            }
            else{
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Welcome Back!';
                echo "<script type='text/javascript'>
                        window.location='../institute/index.php';
                      </script>";
            }
        }

        //TODO Update admin login to check for deactivated and active users
        elseif ($rowsUser[0]['role'] == 'admin'){
            //redirect to admin profile
            //redirrect to institute profile
            $rowsStudent = $this->GetStudentByID($id);

            $_SESSION['role'] = $rowsUser[0]['role'];

            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Logged in as an Administrator';
            echo "<script type='text/javascript'>
                        window.location='../admin/index.php';
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
            $sql = "INSERT INTO students(user_id, name, surname, nationalID, email, phone, dob, sex, marital, avatar, homeAddress, postalAddress, nationality, religion, aboutSelf, attachmentStatus)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);

            if($stmt->execute([$user_id, $name, $surname, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $myNull])){
                //USER CREATED SUCCESSFULLY
                $autoLogin = new Usercontr();
                $autoLogin -> autologinSet($user_id, $loginID);
            }
            else{
                $this->opps();
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
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'ERROR: INVALID USER';
            echo "<script type='text/javascript'>
                        window.location='../signup.php';
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
                    $_SESSION['type'] = 'w';
                    $_SESSION['err'] = 'Account with same RegNumber already exist';
                    echo "<script type='text/javascript'>
                        window.location='../signup.php';
                      </script>";


                }
                else{
                    // echo "Account with same Login-ID already exist";
                    $_SESSION['type'] = 'w';
                    $_SESSION['err'] = 'Account with same Login-ID already exist';
                    echo "<script type='text/javascript'>
                        window.location='../signup.php';
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
                    $this->opps();
                }
            }
        }
        else{
            $this->opps();
        }
    }

}