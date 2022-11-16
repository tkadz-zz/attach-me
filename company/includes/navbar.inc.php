<?php
if (isset($_GET['logout']) && ($_GET['logout'] == 'true')) {
    $newlogout = new Usercontr();
    $newlogout->log_out();

}

?>

<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="index.php">
                <img src="../images/signin-header-image" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.php">
                <img src="../images/signin-header-image" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text"><span class="text-black fw-bold"> <?php echo $_SESSION['name'] ?></span><?php
                    if(isset($_SESSION['subID'])){
                        echo "(". $_SESSION['subName'] ." ". $_SESSION['subSurname'] .")";
                    }
                    ?>
                    <?php
                    if(isset($_SESSION['subRole'])){
                        $subRNav = $_SESSION['subRole'];
                        if($subRNav == 'admin'){
                            $borderClass = 'danger';
                            $subRole = 'admin';
                        }
                        elseif ($subRNav == 'adminSupervisor'){
                            $borderClass = 'warning';
                            $subRole = 'coodinator';
                        }
                        elseif ($subRNav == 'supervisor'){
                            $borderClass = 'success';
                            $subRole = 'supervisor';
                        }
                        ?>
                        <span style="font-size: 10px;" class="badge badge-<?php echo $borderClass ?>"><?php  echo $subRole ?></span>
                        <?php
                    }
                    ?>
                </h1>
                <h6 class="welcome-sub-text" style="font-size: 15px"><?php echo  $_SESSION['email']  ?>
                </h6>

            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item d-none d-lg-block">
                <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
              <span class="input-group-addon input-group-prepend border-right">
                <span class="icon-calendar input-group-text calendar-icon"></span>
              </span>
                    <input type="text" class="form-control">
                </div>
            </li>
            <li class="nav-item">
                <form class="search-form" action="#">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
            </li>


            <?php
            //TODO insert mini_notifications.inc.php
            include 'mini_notifications.inc.php';
            ?>


            <?php
            //TODO insert mini_messages.inc.php
            include 'mini_messages.inc.php';
            ?>

            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                    if(isset($_SESSION['avatar'])){
                    if($_SESSION['avatar'] != ''){
                        ?>
                        <img class="img-xs rounded-circle" src="<?php echo $_SESSION['avatar'] ?>" alt=" image">
                        <?php
                    }
                    else{
                        if($_SESSION['sex'] == 'MALE'){
                            ?>
                            <img class="img-xs rounded-circle" src="../img/male.png">
                            <?php
                        }
                        elseif ($_SESSION['sex'] == 'FEMALE'){
                            ?>
                            <img class="img-xs rounded-circle" src="../img/female.png">
                            <?php
                        }
                        else{
                            ?>
                            <img class="img-xs rounded-circle" src="../img/user.png">
                            <?php
                        }

                    }
                    }
                    else{
                        ?>
                        <img class="img-xs rounded-circle" src="../img/companyEnterprise.png">
                    <?php
                    }
                    ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <?php
                        if(isset($_SESSION['avatar'])){
                        if($_SESSION['avatar'] != ''){
                            ?>
                            <img style="height: 100px" class="img-md rounded-circle" src="<?php echo $_SESSION['avatar'] ?>" alt=" image">
                            <?php
                        }
                        else{
                            if($_SESSION['sex'] == 'MALE'){
                                ?>
                                <img style="height: 100px" class="img-md rounded-circle" src="../img/male.png">
                                <?php
                            }
                            elseif ($_SESSION['sex'] == 'FEMALE'){
                                ?>
                                <img style="height: 100px" class="img-md rounded-circle" src="../img/female.png">
                                <?php
                            }
                            else{
                                ?>
                                <img style="height: 100px" class="img-md rounded-circle" src="../img/user.png">
                                <?php
                            }

                        }
                        }
                        else{
                            ?>
                            <img style="height: 100px" class="img-md rounded-circle" src="../img/companyEnterprise.png">
                        <?php
                        }
                        ?>

                        <?php
                        if(isset($_SESSION['subID'])){ ?>
                            <p class="mb-1 mt-3 font-weight-semibold"><b><?php echo $_SESSION['name'] ?></b> (<?php echo $_SESSION['subName'] .' '. $_SESSION['subSurname'] ?>)</p>
                        <p class="fw-light text-muted mb-0"><?php echo $_SESSION['subEmail'] ?></p>
                        <?php }
                        else{
                        ?>
                        <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['name'] ?></p>
                        <p class="fw-light text-muted mb-0"><?php echo $_SESSION['email'] ?></p>
                        <?php } ?>
                    </div>

                    <a class="dropdown-item" href="profile.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
                    <?php
                    if(isset($_SESSION['subID']))
                    {
                        ?>
                        <a onclick="return confirm('Switching Account will log you out, Continue?');" class="dropdown-item" href="includes/switchAccount.inc.php">
                            <i class="dropdown-item-icon mdi mdi-repeat text-primary me-2"></i>
                            <span class="menu-title">Switch Account</span>
                        </a>

                        <?php
                    }
                    ?>
                    <a class="dropdown-item" href="?logout=true"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                </div>
            </li>



        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- partial -->