<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
?>


<h4 class="pt-3">Vacancies</h4>



<br>
<div class="row">
    <div class="col-md-4">

        <div class="card">
            <ul class="list-group list-group-flush">
                <a class="text-decoration-none" href="vacancyCategories.php"><li class="list-group-item"><span class="fa fa-eye"></span> All Categories <span class="fa fa-arrow-circle-right"></span></li></a>

                <a class="text-decoration-none" href="allVacancies.php"><li class="list-group-item"><span class="fa fa-eye"></span> View All Vacancies <span class="fa fa-arrow-circle-right"></span></li></a>
                <a class="text-decoration-none" href="postVacancy.php"><li class="list-group-item"><span class="fa fa-plus"></span> Post New Vacancies <span class="fa fa-arrow-circle-right"></span></li></a>
                <a class="text-decoration-none" href="#!"><li class="list-group-item">Vacancy Replies <span class="fa fa-arrow-circle-right"></span></li></a>
            </ul>
        </div>
    </div>

    <?php
    if(isset($_GET['newVacancy'])){

        $postv = new CompanyView();
        $postv->newCategory($_SESSION['id']);

    }
    ?>

    <?php
    if(isset($_GET['newVacancy'])){

        $postv = new CompanyView();
        $postv->PostVacancyView($_SESSION['id']);

    }
    ?>

</div>







<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
