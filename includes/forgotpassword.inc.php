<?php
include("autoloader.inc.php");

if(isset($_POST['btn-recover-password'])) {
    $email = $_POST["email"];

    if($email == NULL){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Email address can not be empty';
        echo "<script type='text/javascript'>;
                      window.location='../forgotpassword.php';
                    </script>";
    }

    else {
        try {
            $login = new Usercontr();
            $login->forgotpassword($email);

        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();
        }
    }
}
else{
    echo "<script type='text/javascript'>;
             window.location='../unauthorized.php';
            </script>";
}