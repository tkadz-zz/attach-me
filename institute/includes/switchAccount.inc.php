<?php
session_start();
if(isset($_SESSION['subID'])) {


    $_SESSION['type'] = 'i';
    $_SESSION['err'] = 'Logged out of  '. $_SESSION["subName"] ." ". $_SESSION["subSurname"] .'s account';

    unset($_SESSION['subID']);
    unset($_SESSION['subRole']);
    unset($_SESSION['subName']);
    unset($_SESSION['subSurname']);
    unset($_SESSION['subDepartment']);
    unset($_SESSION['avatar']);


    echo "<script type='text/javascript'>
        window.location='../accounts.php';
      </script>";
}
else{
    $_SESSION['type'] = 'i';
    $_SESSION['err'] = 'Switching Account';
    echo "<script type='text/javascript'>
        window.location='../accounts.php';
      </script>";
}

