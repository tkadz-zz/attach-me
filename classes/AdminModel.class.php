<?php


class AdminModel extends Dbh{


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
        $active = 1;
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

    protected function GetAllUsers(){
        $sql = "SELECT * FROM users ORDER BY role";
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