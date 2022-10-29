<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
include 'includes/subAccAdminSessionFilter.inc.php';
?>
<style>
    .mylst {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .mylst li{
        float: left;
        padding: 2px;
    }
</style>

<h4 class="pt-3">Vacancy Summery</h4>
<br>
<div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<br>

<div class="row">
    <?php
    $cv = new CompanyView();
    $cv->viewVacancySummery($_GET['vuid']);
    ?>
</div>



<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
