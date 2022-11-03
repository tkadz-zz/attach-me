<?php
include 'autoloader.inc.php';

if(isset($_POST['btn-search'])){
    $search = $_POST['search'];
    $_SESSION['search'] = $search;

    echo "<script type='text/javascript'>;
              window.location='../searchStudent.php?search';
            </script>";
}