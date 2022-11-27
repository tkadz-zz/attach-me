<?php
include("autoloader.inc.php");
include "instituteSessionFilter.inc.php";
include "subAccAdminSessionFilter.inc.php";

if(isset($_POST['btn_updateProfile_CI'])){
    $userID = $_SESSION['id'];

    $loginID = $_POST['loginID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $website = $_POST['website'];

    try {
        $n = new Usercontr();
        $n->updateMainProfie($loginID, $name, $email, $phone, $address, $website, $userID);
    }catch (TypeError $e){
        echo 'Error: ' . $e->getMessage();
    }

}