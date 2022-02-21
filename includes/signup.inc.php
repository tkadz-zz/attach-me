<?php
include("autoloader.inc.php");

$nameRaw = $_POST["name"];
$name = strtoupper($nameRaw);

$surnameRaw = $_POST["surname"];
$surname = strtoupper($surnameRaw);

$reNumberRaw = $_POST["loginID"];
$loginID = strtoupper($reNumberRaw);

$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if($password != $confirmPassword){
    $message = "type=d&err=Password did not match";
  echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
}

elseif(strlen($loginID) < 1){
    $message = "type=d&err=RegNumber is empty";
    echo "<script type='text/javascript'>;
             window.location='../signup.php?$message';
            </script>";
}

elseif(strlen($name) < 1){
    $message = "type=d&err=Name is empty";
  echo "<script type='text/javascript'>;
             window.location='../signup.php?$message';
            </script>";
}

elseif(strlen($surname) < 1){
    $message = "type=d&err=Surname is empty";
  echo "<script type='text/javascript'>;
             window.location='../signup.php?$message';
            </script>";
}

elseif (strlen($password) < 8 || strlen($confirmPassword) < 8){
    $message = "type=d&err=Password Too Short";
  echo "<script type='text/javascript'>;
             window.location='../signup.php?$message';
            </script>";
}


else{


    $password = password_hash($confirmPassword, PASSWORD_BCRYPT);

    $joined = date("Y-m-d h:m:i");
    $reg_status = 1;
    $active_status = 1;
    $user_role = "student";


    try {
      $sign_up_now = new Usercontr();
      $sign_up_now->createStudentAccount($name, $surname, $loginID, $password, $user_role, $active_status, $reg_status, $joined);
    } catch (TypeError $e) {
      echo "Error" . $e->getMessage();

    }



}


 ?>
