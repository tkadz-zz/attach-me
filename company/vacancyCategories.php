<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
include 'includes/subAccAdminSessionFilter.inc.php';
?>



<h4 class="pt-3">All Vacancies</h4>
<div class="container mt-4 mb-4">
    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>

    <div class="btn btn-outline-success btn-sm rounded text-decoration-none" data-size="large"><a data-bs-toggle="modal" data-bs-target="#addCategoryModal" href="" class="fb-xfbml-parse-ignore"><span class="fa fa-plus"></span> Add New Category</a></div>
    <?php include_once 'modals.php' ?>

    <div id="--printableArea" class="card-box">
        <h4 class="mt-0 header-title"></h4>
        <p class="text-muted font-14 mb-3">
            All Posted Vacancies
        </p>
        <hr>
        <table id="datatable" class="table table-bordered dt-responsive nowrap">

            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Added By</th>
                <th>Date Added</th>
                <th>More</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $n = new CompanyView();
            $n->viewAllCompanyVacancyCategoriesLoopTable($_SESSION['id']);
            ?>
            </tbody>


        </table>
    </div>


</div>









<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
