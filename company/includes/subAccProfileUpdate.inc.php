<?php

include("autoloader.inc.php");



if (isset($_POST['btn_updateProfile'])) {
    $name = strtoupper($_POST["name"]);
    $surname = strtoupper($_POST["surname"]);
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $sex = strtoupper($_POST["sex"]);



    try {
        $prof = new Usercontr();
        $prof->subAccUpdateProfile($name,$surname,$phone,$email,$sex,$_SESSION['subID']);

    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}



?>