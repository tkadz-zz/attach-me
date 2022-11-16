<?php
include("autoloader.inc.php");
include("subAccSessionFilter.inc.php");
include("subAccAdminSessionFilter.inc.php");


if(isset($_GET['subID'])) {
    $subID = $_GET['subID'];
    $companyID = $_SESSION['id'];


    try {
        $prof = new Usercontr();
        $prof->resetSubAccPassword($subID, $companyID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}



?>