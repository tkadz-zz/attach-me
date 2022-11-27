<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
?>


<h4 class="pt-3">Institute Profile</h4>
<br>
<div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<br>

<div class="row">
    <?php
    $cv = new Userview();
    $cv->viewInstituteProfile($_GET['userID']);
    ?>
</div>



<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
