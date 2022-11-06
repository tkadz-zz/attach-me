<?php
include("autoloader.inc.php");
include 'subAccSessionFilter.inc.php';
include 'subAccAdminSessionFilter.inc.php';

if (isset($_POST['btn_post_vacancyQualification'])){

    $companyID = $_SESSION['id'];

    $qualification = $_POST['qualification'];
    $vacancyID = $_POST['vacancyID'];
    $dateAdded = date("Y-m-d h:i:s");

    if(strlen($qualification) < 1 ){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Qualification can not be empty';
        echo "<script type='text/javascript'>;
                  history.back(-1);
              </script>";
    }

    else{
        try {
            $n = new Usercontr();
            $n->postVacancyQualification($qualification, $vacancyID, $dateAdded);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();
        }
    }

}

else {
    echo "<script type='text/javascript'>;
             window.location='../unauthorized.php';
            </script>";
}
