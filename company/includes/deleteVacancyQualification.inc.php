<?php
include("autoloader.inc.php");
include 'subAccSessionFilter.inc.php';
include 'subAccAdminSessionFilter.inc.php';

if (isset($_GET['vuid']) && isset($_GET['id'])){


    $vuid = $_GET['vuid'];
    $id = $_GET['id'];

    try {
        $n = new Usercontr();
        $n->deletePostVacancyQualification($vuid, $id);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }


}

else {
    echo "<script type='text/javascript'>;
             window.location='../unauthorized.php';
            </script>";
}
