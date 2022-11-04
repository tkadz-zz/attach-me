<?php
include("autoloader.inc.php");
include "subAccAdminSessionFilter.inc.php";

$action = $_GET['action'];
$vuid = $_GET['vuid'];
$userID = $_GET['userID'];

if($action == 'markAsRead'){
    try {
        $s = new Usercontr();
        $s->markApplicationAsRead($vuid, $userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}

elseif($action == 'delete') {
    try {
        $s = new Usercontr();
        $s->deleteApplication($vuid, $userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}
else{
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'No Command';
    echo "<script type='text/javascript'>;
              history.back();
            </script>";
}