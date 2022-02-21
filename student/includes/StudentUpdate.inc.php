<?php

include("autoloader.inc.php");



if (isset($_POST['btn_updateProfile'])) {
    $name = strtoupper($_POST["name"]);
    $surname = strtoupper($_POST["surname"]);
    $phone = $_POST["phone"];
    $homeAddress = $_POST["homeAddress"];
    $postalAddress = $_POST["postalAddress"];
    $country = strtoupper($_POST["country"]);
    $email = $_POST["email"];
    $sex = strtoupper($_POST["sex"]);
    $dob = $_POST["dob"];

    try {
        $prof = new StudentUpdate();
        $prof->studentUpdateProfile($name,$surname,$phone,$homeAddress,$postalAddress,$country,$email,$sex,$dob,$_SESSION['id']);

    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
} else {
    echo 'Action Forbiden';
}

?>