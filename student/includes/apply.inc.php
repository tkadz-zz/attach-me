<?php
include "autoloader.inc.php";
include "studentSessionFilter.inc.php";

$vuid = $_GET['vuid'];
$id = $_SESSION['id'];

try {
    $n = new Usercontr();
    $n->vacancyApply($vuid, $id);
}
catch (TypeError $e){
    echo "Error" . $e->getMessage();
}



