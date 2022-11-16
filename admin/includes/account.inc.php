<?php
include("autoloader.inc.php");


if(isset($_POST['btn_addUser'])){

    $loginID = $_POST["loginID"];
    $name = strtoupper($_POST["name"]);
    $type = $_POST["type"];

    try {
        $n = new AdminContr();
        $n->addAcc($loginID, $name, $type);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}






?>
