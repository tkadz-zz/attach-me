<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
?>

<br>
<br>
<div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<br>
<br>


<?php
$userID = $_GET['userID'];
$n = new AdminView();
$n->viewUserProfile($userID);
?>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
