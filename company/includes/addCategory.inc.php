<?php
include("autoloader.inc.php");
include "adminFilter.inc.php";

if(isset($_POST['btn-add-category'])) {
    $category_unset = $_POST['category'];
    $category = strtoupper($category_unset);
    if(strlen($category) < 4){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Category length not matching the required minimum value(4) ';
        echo "<script>
                window.location='../adminDashboard.php?addcategory';
            </script>";
    }else{

        try {
            $dateAdded = date("Y-m-d h:m:i");
            $s = new Usercontr();
            $s->addCategory($category, $dateAdded);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }
    }


}