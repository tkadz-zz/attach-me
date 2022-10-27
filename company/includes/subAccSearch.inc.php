<?php
include 'autoloader.inc.php';

if(isset($_POST['btn-search'])){
    $search = $_POST['search'];
    $_SESSION['search'] = $search;

    $_SESSION['type'] = 's';
    $_SESSION['err'] = 'Here are the results we found';
    echo "<script type='text/javascript'>;
              window.location='../accounts.php?search';
            </script>";
}