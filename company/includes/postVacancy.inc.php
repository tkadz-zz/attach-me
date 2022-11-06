<?php
include("autoloader.inc.php");
include 'subAccSessionFilter.inc.php';
include 'subAccAdminSessionFilter.inc.php';

if (isset($_POST['btn_post_vacancy'])){

    $companyID = $_SESSION['id'];
    $subID = $_SESSION['subID'];

    $title = $_POST['Vtitle'];
    $location = $_POST['Vlocation'];
    $expDate = $_POST['VexpDate'];
    $category = $_POST['Vcategory'];
    $body = $_POST['Vbody'];
    $postOnlineDate = $_POST['postOnlineDate'];
    $randomSTR = $_POST['randomSTR'];
    $dateAdded = date("Y-m-d h:i:s");

    if(strlen($title) < 1 ){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Title can not be empty';
        echo "<script type='text/javascript'>;
                  history.back(-1);
              </script>";
    }
    elseif (strlen($location) < 1 ){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Location can not be empty';
        echo "<script type='text/javascript'>;
                  history.back(-1);
              </script>";
    }
    elseif (strlen($expDate) < 1 ){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Exp-Date can not be empty';
        echo "<script type='text/javascript'>;
                  history.back(-1);
              </script>";
    }
    elseif (strlen($category) < 1 ){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Category can not be empty';
        echo "<script type='text/javascript'>;
                  history.back(-1);
              </script>";
    }
    elseif (strlen($body) < 15 ){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'vacancy body is too short, please add some more details';
        echo "<script type='text/javascript'>;
                  history.back(-1);
              </script>";
    }

    else{
        try {
            $n = new Usercontr();
            $n->postVacancy($randomSTR, $title, $location, $expDate, $category, $body, $dateAdded, $postOnlineDate, $companyID, $subID);
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
