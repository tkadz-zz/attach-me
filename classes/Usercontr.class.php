<?php
class Usercontr extends Users{

    public function updateMainProfie($loginID, $name, $email, $phone, $address, $website, $userID)
    {
        parent::updateMainProfie($loginID, $name, $email, $phone, $address, $website, $userID);
    }

    public function setPassword($loginID, $password, $password_unprotected){
        parent::setPassword($loginID, $password, $password_unprotected);
    }

    public function resetSubAccPassword($subID, $companyID)
    {
        parent::resetSubAccPassword($subID, $companyID);
    }

    public function setSubAccPassword($loginID, $password, $confirmPassword){
        parent::setSubAccPassword($loginID, $password, $confirmPassword);
    }

    public function delDept($deptID, $companyID)
    {
        parent::delDept($deptID, $companyID);
    }

    public function addDept($name, $companyID){
        parent::addDept($name, $companyID);
    }

    public function delSubAcc($subID, $companyID)
    {
        parent::delSubAcc($subID, $companyID);
    }

    public function updateSubAcc($subRole, $subDept, $subStatus, $companyID, $subID)
    {
        parent::updateSubAcc($subRole, $subDept, $subStatus, $companyID, $subID);
    }

    public function addSubAcc($name, $surname, $sex, $dept, $userRole, $companyID)
    {
        parent::addSubAcc($name, $surname, $sex, $dept, $userRole, $companyID);
    }

    public function setSupervisor($supervisorID, $userID)
    {
        parent::setSupervisor($supervisorID, $userID);
    }


    public function uploadDocument($file_tmp, $file_destination, $file_name_new, $file_ext, $type, $id){
        parent::uploadDocument($file_tmp, $file_destination, $file_name_new, $file_ext, $type, $id);
    }

    public function deleteDocument($doc, $Dtype, $id)
    {
        parent::deleteDocument($doc, $Dtype, $id);
    }

    public function attachmentStatusFilter($id)
    {
        parent::attachmentStatusFilter($id);
    }


    public function underDev()
    {
        parent::underDev();
    }

    public function deleteApplication($vuid, $userID)
    {
        parent::deleteApplication($vuid, $userID);
    }


    public function ReadUnreadApplication($vuid, $id)
    {
        parent::ReadUnreadApplication($vuid, $id);
    }



    public function unattachStudent($userID, $companyID)
    {
        parent::unattachStudent($userID, $companyID);
    }

    public function attachStudent($companyID, $supervisorID, $subID, $today, $start, $end, $userID)
    {
        parent::attachStudent($companyID, $supervisorID, $subID, $today, $start, $end, $userID);
    }


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

    public function delVacancy($vuid,$companyID){
        parent::delVacancy($vuid,$companyID);
    }

    public function postVacancy($randomSTR, $title, $location, $expDate, $category, $body, $dateAdded, $postOnlineDate, $companyID, $subID)
    {
        parent::postVacancy($randomSTR, $title, $location, $expDate, $category, $body, $dateAdded, $postOnlineDate, $companyID, $subID);
    }

    public function subCompanyUpdatePassword($op, $cp, $main, $id){
        //This method is also used by institute
        parent::subCompanyUpdatePassword($op, $cp, $main, $id);
    }


    public function loginSubAcc($subID, $subAccID, $password){
        parent::loginSubAcc($subID, $subAccID, $password);
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
