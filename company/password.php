<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
?>





<?php

$studentProfile = new CompanyView();
$studentProfile->SubCompanyViewChangePassword($_SESSION['subID']);

?>







<?php
include 'includes/emptyLayoutBottom.inc.php';
?>