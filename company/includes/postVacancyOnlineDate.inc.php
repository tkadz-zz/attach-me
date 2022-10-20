<?php
include("autoloader.inc.php");
include 'subAccSessionFilter.inc.php';
include 'subAccAdminSessionFilter.inc.php';

if (isset($_POST['btn_post_online_date'])){


    $vuid = $_GET['vuid'];
    $onlineDate = $_POST['onlineDate'];

    try {
        $n = new Usercontr();
        $n->postVacancyOnlineDate($vuid, $onlineDate);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }


}
elseif(isset($_POST['btn_finish'])){
    $vuid = $_GET['vuid'];
    try {
        $n = new Usercontr();
        $n->finishPostingVacancy($vuid);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}

else {
    echo "<script type='text/javascript'>;
             window.location='../unauthorized.php';
            </script>";
}
