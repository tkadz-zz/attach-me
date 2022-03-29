<?php


 function MyReturn($type, $err){

    session_start();
    $_SESSION['type'] = $type;
    $_SESSION['err'] = $err;

     echo $_SESSION['type'];
     echo $_SESSION['err'];

     unset($_SESSION['type']);
     unset($_SESSION['err']);

}


$type = 's';
$err = 'This is an error message';
MyReturn($type, $err);

