<?php
if(!isset($_SESSION['subID'])){
    $_SESSION['type'] = 'i';
    $_SESSION['err'] = 'Please log into your Sub-Account first to continue';
    echo "<script type='text/javascript'>
    window.location='accounts.php';
    </script>";
}