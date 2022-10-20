<?php
include("autoloader.inc.php");


if (isset($_POST['btn_updatePassword'])){
    $op = $_POST['op'];
    $np = $_POST['np'];
    $cp = $_POST['cp'];

    if($np != $cp){
        echo "<script type='text/javascript'>;
                  window.location='../password.php?type=w&err=New Password and Old Password Did Not Match';
              </script>";
    }
    else{
        try {
            $prof = new Usercontr();
            $prof->subCompanyUpdatePassword($op, $cp, $_SESSION['subID']);
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
