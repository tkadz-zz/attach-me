<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
include 'includes/subAccAdminSessionFilter.inc.php';
?>


<h4 class="pt-3"> Post Vacancy STEP 2/2</h4>
<br>



        <?php
        $cv = new CompanyView();
        $cv->viewVacancyFinal($_GET['vuid']);
        ?>



<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
