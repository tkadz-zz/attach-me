<?php
include("autoloader.inc.php");
include "studentSessionFilter.inc.php";

if(!isset($_GET['document'])){
    echo "<script type='text/javascript'>history.back(-1)</script>";
}

$doc = $_GET['document'];
$id = $_SESSION['id'];

if($doc == 'cv'){
    $Dtype = 'Curriculum Vitae';
}
elseif($doc == 'attRep'){
    $Dtype = 'Attachment Report';
}
elseif($doc == 'assRep'){
    $Dtype = 'Assessment Report';
}
elseif($doc == 'logb'){
    $Dtype = 'Logbook';
}
else{
    echo "<script type='text/javascript'>history.back(-1)</script>";
}


try {
    $s = new Usercontr();
    $s->deleteDocument($doc, $Dtype, $id);
} catch (TypeError $e) {
    echo "Error" . $e->getMessage();
}

