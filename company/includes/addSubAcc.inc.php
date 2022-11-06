<?php
include("autoloader.inc.php");


if(isset($_POST['btn_addUser'])){

    $userRole= $_POST['subRole'];
    $dept = $_POST["dept"];
    $name = strtoupper($_POST["name"]);
    $surname = strtoupper($_POST["surname"]);
    $sex = strtoupper($_POST["sex"]);
    $companyID = $_SESSION['id'];

    try {
        $n = new Usercontr();
        $n->addSubAcc($name, $surname, $sex, $dept, $userRole, $companyID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}
if(isset($_POST['btn_addDept'])){
    $name = $_POST["name"];
    $companyID = $_SESSION['id'];

    try {
        $n = new Usercontr();
        $n->addDept($name, $companyID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}



?>
