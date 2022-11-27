<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
include "includes/subAccAdminSessionFilter.inc.php";
?>


<br>
<div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<br>

<div class="row">
    <?php
    $cv = new Userview();
    $cv->viewCompanyInstituteProfile($_SESSION['id']);
    ?>
</div>



<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
