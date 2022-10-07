<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
include 'includes/subAccAdminSessionFilter.inc.php';
?>


<h4 class="pt-3">New Vacancy</h4>
<br>


    <div class="row">
        <?php
        $cv = new CompanyView();
        $cv->PostVacancyView();
        ?>
    </div>



<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
