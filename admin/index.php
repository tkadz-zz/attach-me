<?php
include("../includes/autoloader.inc.php");

if(!isset($_SESSION['id'])){
  $_SESSION['id'] = NULL;
}

if($_SESSION["id"] == "" || $_SESSION["id"] == NULL){
  echo "<script type='text/javascript'>
    window.location='../signin.php';
    </script>";
}

else{


  if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    echo "<script type='text/javascript'>
      window.location='dashboard.php';
      </script>";
  }
  else{
    echo "<script type='text/javascript'>
      window.location='../unauthorized.php';
      </script>";
  }


}


?>
