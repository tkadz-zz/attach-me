<?php


class AdminModel extends Dbh{


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
                return "One Minute Ago";
            }
            else{
                return "$minutes Minutes Ago";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "an Hour Ago";
            }else{
                return "$hours Hrs Ago";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "Yesterday";
            }else{
                return "$days Days Ago";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "a Week Ago";
            }else{
                return "$weeks Weeks Ago";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "a Month Ago";
            }else{
                return "$months Months Ago";
            }
        }
        //Years
        else{
            if($years==1){
                return "One Year Ago";
            }else{
                return "$years Years Ago";
            }
        }
    }

    protected function dateTimeToDay($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('l j F Y h:m:s A',$history_bus_date_tostring);
    }

    protected function deleteProgram($programID){
        $srows = $this->GetStudentEducationByProgramID($programID);
        if(count($srows) > 0){
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = ' Sorry we can not delete this program. It contains<span class="text-dark">('.count($srows).')</span> students assigned to it';
            echo '<script type="text/javascript">
                    history.back(-1);
                </script>';
        }
        else{
            $sql = "DELETE FROM program WHERE id=?";
            $stmt = $this->con()->prepare($sql);

            if($stmt->execute([$programID])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = ' Program Deleted Successfully';
                echo '<script type="text/javascript">
                    history.back(-1);
                </script>';
            }
            else{
                $this->opps();
            }
        }
    }

    protected function addProgram($name){
        $srows = $this->GetProgramByName($name);
        if(count($srows) > 0){
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = ' Program: <span class="text-dark">' . $name . '</span> Already Exist';
            echo '<script type="text/javascript">
                    history.back(-1);
                </script>';
        }
        else {
            $today = date('Y-m-d H:i:s');
            $status = 1;
            $sql = "INSERT INTO program(name, dateAdded, status) VALUES (?,?,?)";
            $stmt = $this->con()->prepare($sql);
            if ($stmt->execute([$name, $today, $status])) {
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Program <span class="text-dark">' . $name . '</span> Was Added Successfully';
                echo '<script type="text/javascript">
                    history.back(-1);
                </script>';
            } else {
                $this->opps();
            }
        }
    }

    protected function deleteCategory($id){
        $newCteg = 0;
        $sql1 = "UPDATE vacancies SET cartegory=? WHERE cartegory=?";
        $stmt1 = $this->con()->prepare($sql1);

        $sql2 = "DELETE FROM vacancyCategories WHERE id=?";
        $stmt2 = $this->con()->prepare($sql2);

        if($stmt1->execute([$newCteg, $id]) AND $stmt2->execute([$id])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = ' Category Deleted Successfully';
            echo '<script type="text/javascript">
                    history.back(-1);
                </script>';
        }
        else{
            $this->opps();
        }
    }

    protected function addCategory($name, $description){
        $srows = $this->GetCategoryByName($name);
        if(count($srows) > 0){
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = ' Category: <span class="text-dark">' . $name . '</span> Already Exist';
            echo '<script type="text/javascript">
                    history.back(-1);
                </script>';
        }
        else {
            $today = date('Y-m-d H:i:s');
            $active = 1;
            $sql = "INSERT INTO vacancyCategories(category, addedOn, comment, status) VALUES (?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            if ($stmt->execute([$name, $today, $description, $active])) {
                $_SESSION['type'] = 's';
                $_SESSION['err'] = ' Category: ' . $name . ' was Created Successfully';
                echo '<script type="text/javascript">
                    history.back(-1);
                </script>';
            } else {
                $this->opps();
            }
        }
    }

    protected function createFirstSubAcc($type, $accID){
        $blank = '';
        $department = 0;
        $name = 'First';
        $surname = 'Sub-Account';
        $today = date('Y-m-d H:i:s');
        $active = 1;
        $sex = 'PRIVATE';
        $role = 'admin';

        if($type == 'company'){
            $sql = "INSERT INTO company_sub_accounts(companyID, name, surname, sex, avatar, email, phone, password, department, description, dateAdded, status, role) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        }
        elseif($type == 'institute'){
            $sql = "INSERT INTO institute_sub_accounts(instID, name, surname, sex, avatar, email, phone, password, department, description, dateAdded, status, role) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        }
        else{
            $this->opps();
        }
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$accID, $name, $surname, $sex, $blank, $blank, $blank, $blank, $department, $blank, $today, $active, $role]);
    }

    protected function addAcc($loginID, $name, $type){
        $blank = '';
        $today = date('Y-m-d H:i:s');
        $regS = 5;
        $active = 0;
        $sql = "INSERT INTO users(loginID, password, role, joined, regStatus, status) VALUES (?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$loginID, $blank, $type, $today, $regS, $active])){
            $userRows = $this->GetUserByLoginID($loginID);
            $accID = $userRows[0]['id'];
            if($type == 'institute'){
                $sql1 = "INSERT INTO institute(userID, name, phone, email, website, address, avatar, dateJoined) VALUES (?,?,?,?,?,?,?,?)";
                $stmt1 = $this->con()->prepare($sql1);
                if($stmt1->execute([$accID, $name, $blank, $blank, $blank, $blank, $blank, $today])){
                    $this->createFirstSubAcc($type, $accID);
                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = $type. ' account: ' . $name . ' was Created Successfully';
                    echo "<script type='text/javascript'>
                        history.back(-1);
                    </script>";
                }
            }
            elseif ($type == 'company'){
                $sql1 = "INSERT INTO company(user_id, name, phone, email, website, avatar, address, bio) VALUES (?,?,?,?,?,?,?,?)";
                $stmt1 = $this->con()->prepare($sql1);
                if($stmt1->execute([$accID, $name, $blank, $blank, $blank, $blank, $blank, $blank])){
                    $this->createFirstSubAcc($type, $accID);
                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = $type. ' account: ' . $name . ' was Created Successfully';
                    echo "<script type='text/javascript'>
                        history.back(-1);
                    </script>";
                }
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


    protected function isUser($id, $role){
        if($role == 'admin'){
            return $this->GetAdminByUserID($id);
        }
        elseif ($role == 'company'){
            return $this->GetCompanyByUserID($id);
        }
        elseif ($role == 'institute'){
            return $this->GetInstituteByUserID($id);
        }
        elseif ($role == 'student'){
            return $this->GetStudentByUserID($id);
        }else{
            echo 'ERROR: ';
        }
    }



    protected function GetStudentEducationByProgramID($id){
        $sql = "SELECT * FROM studentEducation WHERE programID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    protected function GetUserByLoginID($loginID){
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$loginID]);
        return  $stmt->fetchAll();
    }

    protected function GetInstituteByUserID($id){
        $sql = "SELECT * FROM institute WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    protected function GetStudentByUserID($id){
        $sql = "SELECT * FROM students WHERE user_id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    protected function GetCompanyByUserID($id){
        $sql = "SELECT * FROM company WHERE user_id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    protected function GetAdminByUserID($id){
        $sql = "SELECT * FROM admin_sub_acc WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    protected function GetAttachmentReportByUserID($id){
        $sql = "SELECT * FROM attachmentReports WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetSupervisorsReportByUserID($id){
        $sql = "SELECT * FROM supervisorReports WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetLogbookByUserID($id){
        $sql = "SELECT * FROM logbooks WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetCvByUserID($id){
        $sql = "SELECT * FROM cv WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }


    protected function GetDeptById($id){
        $rows = $this->GetUserByID($id);
        if($rows[0]['role'] == 'company'){
            $sql = "SELECT * FROM companyDepartment WHERE id=?";
        }
        else{
            $sql = "SELECT * FROM instDepartment WHERE id=?";
        }
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }


    protected function GetSubAccByAccIDAndUserID($accID, $subID){
        $rows = $this->GetUserByID($accID);
        if($rows[0]['role'] == 'company'){
            $sql = "SELECT * FROM company_sub_accounts WHERE companyID=? AND id=?";
        }
        else{
            $sql = "SELECT * FROM institute_sub_accounts WHERE instID=? AND id=?";
        }
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$accID, $subID]);
        return  $stmt->fetchAll();
    }


    protected function GetSubAccByAccID($id){
        $rows = $this->GetUserByID($id);
        if($rows[0]['role'] == 'company'){
            $sql = "SELECT * FROM company_sub_accounts WHERE companyID=?";
        }
        else{
            $sql = "SELECT * FROM institute_sub_accounts WHERE instID=?";
        }
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    protected function GetAttachmentsByUserID($id){
        $sql = "SELECT * FROM attachments WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    protected function GetProgramByID($id){
        $sql = "SELECT * FROM program WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    protected function GetStudentEducationByUserID($id){
        $sql = "SELECT * FROM studentEducation WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    protected function GetUserByID($id){
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    protected function GetAllUsers(){
        $sql = "SELECT * FROM users ORDER BY role";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return  $stmt->fetchAll();
    }

    protected function GetAllPrograms(){
        $sql = "SELECT * FROM program";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return  $stmt->fetchAll();
    }



    protected function GetProgramByName($name){
        $sql = "SELECT * FROM program WHERE name=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$name]);
        return  $stmt->fetchAll();
    }

    protected function GetCategoryByName($name){
        $sql = "SELECT * FROM vacancyCategories WHERE category=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$name]);
        return  $stmt->fetchAll();
    }

    protected function GetAllCartegories(){
        $sql = "SELECT * FROM vacancyCategories";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return  $stmt->fetchAll();
    }

    protected function GetAllStudents(){
        $sql = "SELECT * FROM students";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return  $stmt->fetchAll();
    }

    protected function GetAllCompanies(){
        $sql = "SELECT * FROM company";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return  $stmt->fetchAll();
    }

    protected function GetAllInstitutes(){
        $sql = "SELECT * FROM institute";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return  $stmt->fetchAll();
    }

    protected function GetAllAdmin(){
        $sql = "SELECT * FROM admin_sub_acc";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return  $stmt->fetchAll();
    }
}