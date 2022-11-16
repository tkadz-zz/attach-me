<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
?>


<style>
    .card-box {
        position: relative;
        color: #fff;
        padding: 20px 10px 40px;
        margin: 20px 0px;
    }
    .card-box:hover {
        text-decoration: none;
        color: #f1f1f1;
    }
    .card-box:hover .icon i {
        font-size: 100px;
        transition: 1s;
        -webkit-transition: 1s;
    }
    .card-box .inner {
        padding: 5px 10px 0 10px;
    }
    .card-box h3 {
        font-size: 27px;
        font-weight: bold;
        margin: 0 0 8px 0;
        white-space: nowrap;
        padding: 0;
        text-align: left;
    }
    .card-box p {
        font-size: 15px;
    }
    .card-box .icon {
        position: absolute;
        top: auto;
        bottom: 5px;
        right: 5px;
        z-index: 0;
        font-size: 72px;
        color: rgba(0, 0, 0, 0.15);
    }
    .card-box .card-box-footer {
        position: absolute;
        left: 0px;
        bottom: 0px;
        text-align: center;
        padding: 3px 0;
        color: rgba(255, 255, 255, 0.8);
        background: rgba(0, 0, 0, 0.1);
        width: 100%;
        text-decoration: none;
    }
    .card-box:hover .card-box-footer {
        background: rgba(0, 0, 0, 0.3);
    }
    .bg-blue {
        background-color: #00c0ef !important;
    }
    .bg-green {
        background-color: #00a65a !important;
    }
    .bg-orange {
        background-color: #f39c12 !important;
    }
    .bg-red {
        background-color: #d9534f !important;
    }
    .bg-purple {
        background-color: #aa35b2 !important;
    }
    .bg-lime {
        background-color: rgba(50, 56, 55, 0.98) !important;
    }

</style>

<div class="mt-4 mb-4">

    Dashboard

    <div class="row">

        <?php
        if($_SESSION['subRole'] == 'admin'){
            ?>
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                            $n = new InstituteView();
                            $res = $n->countAllInstituteStudents($_SESSION['id']);

                            ?>
                        </h3>
                        <p> All Students </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                    <a href="allStudents.php" class="card-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-blue">
                    <div class="inner">
                        <h3>
                            <?php

                            $n = new CompanyView();
                            //This method is used by company and institute
                            $res = $n->countCompanySUbAcc($_SESSION['id']);

                            ?>
                        </h3>
                        <p> Sub-Accounts </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="allSubAccounts.php" class="card-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-purple">
                    <div class="inner">
                        <h3>
                            <?php

                            $n = new CompanyView();
                            //This method is used by company and institute
                            $res = $n->countCompanyDepartments($_SESSION['id']);
                            ?>
                        </h3>
                        <p> Departments </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-building"></i>
                    </div>
                    <a href="departments.php" class="card-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>


            <?php
        }
        else{
            ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box bg-green">
                        <div class="inner">
                            <h3>
                                <?php
                                $n = new CompanyView();
                                $res = $n->countSUbAccSupervisingStudents($_SESSION['subID'], $_SESSION['id']);
                                ?>
                            </h3>
                            <p> My Students </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="myStudents.php" class="card-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
        <?php

        }
        ?>

    </div>





</div>






<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
