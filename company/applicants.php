<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
include 'includes/subAccAdminSessionFilter.inc.php';
?>

<h4 class="pt-3">Vacancy Applicants</h4>
<br>
<div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<br>

<div id="--printableArea" class="card-box">
    <h4 class="mt-0 header-title"></h4>
    <p class="text-muted font-14 mb-3">
        All Vacancy Applications
    </p>
    <hr>
    <table id="datatable" class="table table-bordered dt-responsive nowrap">

        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Reg-Number</th>
            <th>Institute</th>
            <th>Program</th>
            <th>More</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $n = new CompanyView();
        $n->viewApplicantsTable($_GET['vuid']);
        ?>
        </tbody>


    </table>
</div>



<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
