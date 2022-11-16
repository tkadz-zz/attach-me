<?php
include("autoloader.inc.php");

if(!isset($_GET['userID']) || !isset($_POST['supervisor'])){
    echo "<script type='text/javascript'>history.back(-1)</script>";
}

$userID = $_GET['userID'];
$supervisorID = $_POST['supervisor'];

try {
    $s = new Usercontr();
    $s->setSupervisor($supervisorID, $userID);
} catch (TypeError $e) {
    echo "Error" . $e->getMessage();

}


