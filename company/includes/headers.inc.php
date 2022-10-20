<?php include("includes/autoloader.inc.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Attach-Me
        <?php
        if(isset($_SESSION['id'] )) {
            echo ' /' . $_SESSION['name'];
        }
        ?>
    </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../UniversalUsersDashboardStyles/vendors/feather/feather.css">
    <link rel="stylesheet" href="../UniversalUsersDashboardStyles/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../UniversalUsersDashboardStyles/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../UniversalUsersDashboardStyles/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../UniversalUsersDashboardStyles/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../UniversalUsersDashboardStyles/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../UniversalUsersDashboardStyles/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../UniversalUsersDashboardStyles/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../UniversalUsersDashboardStyles/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="shortcut icon"  href="../images/signin-header-image" />



</head>
<body>

<div class="container-fluid page-body-wrapper">
    <?php include('includes/loader.inc.php') ?>
