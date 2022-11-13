<?php
include("autoloader.inc.php");
include "subAccAdminSessionFilter.inc.php";

$userID = $_POST['userID'];
$companyID = $_SESSION['id'];
$subID = $_SESSION['subID'];
$today = date('Y-m-d H:i:s');

if(isset($_POST['btn_attachToFinalize'])){

    if($_SESSION['subRole'] != 'admin'){
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Only the admin can perform this action';
    }
    else{
        $_SESSION['type'] = 's';
        $_SESSION['err'] = 'Choose start and end date to finalize attachment';
    }
    echo "<script type='text/javascript'>;
          window.location='../finiliseAttachment.php?userID=$userID';
        </script>";
}

elseif(isset($_POST['btn_attach'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    $supervisorID = $_POST['supervisor'];


    if($end <= $start){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Ending date must be greater than starting date';
        echo "<script type='text/javascript'>;
          history.back(-1);
        </script>";
    }
    else{
        try {
            $s = new Usercontr();
            $s->attachStudent($companyID, $supervisorID, $subID, $today, $start, $end, $userID);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }
    }
}
elseif (isset($_GET['abort'])){
    $userID = $_GET['userID'];
    $_SESSION['type'] = 's';
    $_SESSION['err'] = 'Attachment Successfully Aborted';
    echo "<script type='text/javascript'>;
          window.location='../studentProfile.php?userID=$userID';
        </script>";
}
else{
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'No Command';
    echo "<script type='text/javascript'>;
                      history.back();
                    </script>";
}