<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
?>


<div class="container mt-4 mb-4">
    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>


    <div id="--printableArea" class="card-box">
        <h4 class="mt-0 header-title"></h4>
        <p class="text-muted font-14 mb-3">
            Showing all attached students
        </p>
        <hr>
        <table id="datatable" class="table table-bordered dt-responsive nowrap">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Reg#</th>
                <th>Supervisor</th>
                <th>Contract Status</th>
                <th>More</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $n = new CompanyView();
            $n->viewAllCompanyAttachedStudents($_SESSION['id']);
            ?>
            </tbody>


        </table>
    </div>


</div>









<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
