<?php
include("autoloader.inc.php");
include "subAccAdminSessionFilter.inc.php";

if(isset($_POST['btn_addCategory'])) {

    $category = strtoupper($_POST['name']);
    $description = $_POST['description'];
    $companyID = $_SESSION['id'];
    $subID = $_SESSION['subID'];
    $dateAdded = date("Y-m-d h:i:s");

    if(strlen($category) < 4){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Category length not matching the required minimum value(4) ';
        echo "<script>
                history.back(-1);
            </script>";
    }else{

        try {
            $s = new Usercontr();
            $s->addCategory($category, $description, $dateAdded, $companyID, $subID);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

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