<?php
include("autoloader.inc.php");


if(isset($_POST['sub_login'])){
    $subID = $_POST["subID"];
    $subAccID = $_POST["subAccID"];
    $password = $_POST["password"];

    try {
        $login = new Usercontr();
        $login->loginSubAcc($subID, $subAccID, $password);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}
else{
    echo "<script type='text/javascript'>;
             window.location='../unauthorized.php';
            </script>";
}

