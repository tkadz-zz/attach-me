<?php
include("autoloader.inc.php");


if(isset($_POST['btn_addCateg'])){
    $name = $_POST["name"];
    $description = $_POST["description"];

    try {
        $n = new AdminContr();
        $n->addCategory($name, $description);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}

if(isset($_GET['delCateg'])){
    $categID = $_GET['categID'];

    try {
        $n = new AdminContr();
        $n->deleteCategory($categID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}