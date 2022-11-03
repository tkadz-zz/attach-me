<?php
class Usercontr extends Users{




    public function studentSearch($nID){
        return $this->GetStudentByNationalID($nID);
    }

    public function myCount($ress){
        $s = 0;
        foreach ($ress as $res){
            $s++;
        }
        if($s >= 100){
            echo '99+';
        }
        else{
            echo $s;
        }
    }

    public function GetApplicationByUserID($id)
    {
        return parent::GetApplicationByUserID($id);
    }

    public function vacancyApply($vuid, $id)
    {
        parent::vacancyApply($vuid, $id);
    }

    public function subAccUpdateProfile($name, $surname, $phone, $email, $sex, $id)
    {
        parent::subAccUpdateProfile($name, $surname, $phone, $email, $sex, $id);
    }

    public function deleteProfilePicture($id)
    {
        parent::deleteProfilePicture($id);
    }

    public function updateProfileImage($file_tmp, $file_destination, $file_name_new, $file_ext, $id){
        parent::updateProfileImage($file_tmp, $file_destination, $file_name_new, $file_ext, $id);
    }

    public function addCategory($category, $description, $dateAdded, $companyID, $subID)
    {
        parent::addCategory($category, $description, $dateAdded, $companyID, $subID);
    }

    public function finishPostingVacancy($vuid)
    {
        parent::finishPostingVacancy($vuid);
    }

    public function dateToDay($mydate)
    {
        return parent::dateToDay($mydate);
    }

    public function postVacancyOnlineDate($vuid, $onlineDate)
    {
        parent::postVacancyOnlineDate($vuid, $onlineDate);
    }

    public function deletePostVacancyQualification($vuid, $id)
    {
        parent::deletePostVacancyQualification($vuid, $id);
    }

    public function postVacancyQualification($qualification, $vacancyID, $dateAdded)
    {
        parent::postVacancyQualification($qualification, $vacancyID, $dateAdded);
    }

    public function postVacancy($randomSTR, $title, $location, $expDate, $category, $body, $dateAdded, $postOnlineDate, $companyID, $subID)
    {
        parent::postVacancy($randomSTR, $title, $location, $expDate, $category, $body, $dateAdded, $postOnlineDate, $companyID, $subID);
    }

    public function subCompanyUpdatePassword($op, $cp, $id){
        parent::subCompanyUpdatePassword($op, $cp, $id);
    }

    public function loginCompanySubAcc($subID, $subCompanyID, $password){
        parent::loginCompanySubAcc($subID, $subCompanyID, $password);
    }

    public function passwordreserttoken($email)
    {
        parent::passwordreserttoken($email);
    }

    public function forgotpassword($email){
        parent::forgotpassword($email);
    }

    public function createStudentAccount($name, $surname, $loginID, $password, $user_role, $active_status, $reg_status, $joined){
        $this->setStudentAccount($name, $surname, $loginID, $password, $user_role, $active_status, $reg_status, $joined);
    }

    public function createIndexUserRow($loginID, $name, $surname){
        $this->setIndexUserRow($loginID, $name, $surname);
    }
	
	public function autologinSet($id, $loginID){
		$this->autoLogin($id, $loginID);
	}

    public function autologinUsers($id, $loginID){
        parent::autoLoginUsers($id, $loginID);
    }

    public function UpdateRegStatus($regStatus, $id)
    {
        parent::UpdateRegStatus($regStatus, $id);
    }

    public function Stage4($id){
        parent::Stage4($id);
    }

    public function Stage3($institute, $program, $programType, $dateStart, $dateEnd, $id){
        parent::Stage3($institute, $program, $programType, $dateStart, $dateEnd, $id);
    }

    public function Stage2($nid, $DOB, $marital, $gender, $phone, $email, $country, $religion, $about, $id){
        parent::Stage2($nid, $DOB, $marital, $gender, $phone, $email, $country, $religion, $about, $id);
    }

    public function SigninUser($loginID, $password){
        parent::SigninUser($loginID, $password);
    }

    public function log_out(){
        // Destroy and unset active session
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['surname']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        unset($_SESSION['status']);
        echo "<script type='text/javascript'>
      window.location='index.php';
      </script>";
        return true;
    }

}
