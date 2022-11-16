<?php
include("autoloader.inc.php");

$companyID = $_SESSION['id'];

if(isset($_POST['btn_addUser'])){

    $userRole= $_POST['subRole'];
    $dept = $_POST["dept"];
    $name = strtoupper($_POST["name"]);
    $surname = strtoupper($_POST["surname"]);
    $sex = strtoupper($_POST["sex"]);

    try {
        $n = new Usercontr();
        $n->addSubAcc($name, $surname, $sex, $dept, $userRole, $companyID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}


if(isset($_POST['btn_update_subAcc'])){
    $subID = $_POST['subID'];
    $subRole = $_POST['subRole'];
    $subDept = $_POST['subDept'];
    $subStatus = $_POST['subStatus'];
    try {
        $n = new Usercontr();
        $n->updateSubAcc($subRole, $subDept, $subStatus, $companyID, $subID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

if(isset($_GET['delSubAcc'])){
    $subID = $_GET["subID"];

    try {
        $n = new Usercontr();
        $n->delSubAcc($subID, $companyID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

if(isset($_POST['btn_addDept'])){
    $name = $_POST["name"];

    try {
        $n = new Usercontr();
        $n->addDept($name, $companyID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}


if(isset($_GET['delDept'])){
    $deptID = $_GET["deptID"];
    $companyID = $_SESSION['id'];

    try {
        $n = new Usercontr();
        $n->delDept($deptID, $companyID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}





?>
