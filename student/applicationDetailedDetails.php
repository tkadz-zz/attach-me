<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>




<h4 class="pt-3">Applied Vacancy Details</h4>
<br>
<div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<br>

<?php
$n = new StudentView();
$n->viewApplyForm($_GET['vuid']);
?>







<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
