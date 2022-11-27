<?php
include("autoloader.inc.php");


if(isset($_POST['btn_add_Program'])){
    $name = $_POST["name"];

    try {
        $n = new AdminContr();
        $n->addProgram($name);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}

if(isset($_GET['delProgram'])){
    $programID = $_GET['programID'];

    try {
        $n = new AdminContr();
        $n->deleteProgram($programID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}