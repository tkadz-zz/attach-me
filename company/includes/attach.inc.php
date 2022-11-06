<?php
include("autoloader.inc.php");
include "subAccAdminSessionFilter.inc.php";

$userID = $_POST['userID'];
$companyID = $_SESSION['id'];
$subID = $_SESSION['subID'];
$today = date('Y-m-d H:i:s');

if(isset($_POST['btn_attachToFinalize'])){
    $_SESSION['type'] = 's';
    $_SESSION['err'] = 'Choose start and end date to finalize attachment';
    echo "<script type='text/javascript'>;
          window.location='../finiliseAttachment.php?userID=$userID';
        </script>";
}

elseif(isset($_POST['btn_attach'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];

    try {
        $s = new Usercontr();
        $s->attachStudent($companyID, $subID, $today, $start, $end, $userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

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