<?php
include("autoloader.inc.php");


if(isset($_POST['sub_login'])){
    $subID = $_POST["subID"];
    $subCompanyID = $_POST["subCompanyID"];
    $password = $_POST["password"];

    try {
        $login = new Usercontr();
        $login->loginCompanySubAcc($subID, $subCompanyID, $password);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}
else{
    echo "<script type='text/javascript'>;
             window.location='../unauthorized.php';
            </script>";
}

