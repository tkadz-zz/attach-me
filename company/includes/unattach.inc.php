<?php
include("autoloader.inc.php");
include "subAccAdminSessionFilter.inc.php";

if(isset($_POST['btn_unattach'])){
    if($_SESSION['subRole'] != 'admin'){
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Only the admin can perform this action';
    }
    else{
        try {
            $userID = $_POST['userID'];
            $companyID = $_SESSION['id'];
            $n = new Usercontr();
            $n->unattachStudent($userID,$companyID);
        }
        catch (TypeError $e){
            echo 'Error: ' . $e->getMessage();
        }
    }
}

else{
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'No Command';
    echo "<script type='text/javascript'>;
                      history.back();
                    </script>";
}