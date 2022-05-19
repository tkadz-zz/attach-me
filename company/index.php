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


  if(isset($_SESSION['role']) && $_SESSION['role'] == 'company'){

    if(!isset($_SESSION['subID'])){
      $_SESSION['type'] = 's';
      $_SESSION['err'] = 'Select one your Sub-Account Below to continue';
      echo "<script type='text/javascript'>
    window.location='accounts.php';
    </script>";
    }

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
