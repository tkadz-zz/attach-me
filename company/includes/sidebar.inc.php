

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="../index.php">
                <i class="fa fa-globe menu-icon"></i>
                <span class="menu-title">Home Page</span>
            </a>
        </li>
        <li class="nav-item nav-category">Quick Tools</li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Dashboard</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="searchStudent.php">
                <i class="menu-icon mdi mdi-magnify"></i>
                <span class="menu-title">Find Student</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <?php
        if(isset($_SESSION['subRole']) AND  $_SESSION['subRole'] == 'admin'){
        ?>
        <li class="nav-item">
            <a class="nav-link" href="departments.php">
                <i style="font-size: 15px" class="menu-icon fa fa-building"></i>
                <span class="menu-title">Departments</span>
                <i class="menu-arrow"></i>
            </a>
        </li>

        <li class="nav-item nav-category">Vacancies</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-element" aria-expanded="false" aria-controls="form-elements">
                <i style="font-size: 15px" class="menu-icon fa fa-send"></i>
                <span class="menu-title">Vacancies</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-element">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="allVacancies.php">All Vacancies</a></li>
                    <li class="nav-item"><a class="nav-link" href="postVacancy.php">Post Vacancies</a></li>
                </ul>
            </div>
        </li>


        <li class="nav-item nav-category">Sub Accounts</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elementt" aria-expanded="false" aria-controls="form-elements">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">Sub-Accounts</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elementt">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="allSubAccounts.php">All Sub-Accounts</a></li>
                </ul>
            </div>
        </li>
            <?php
        }
        ?>


        <li class="nav-item nav-category">Profile and Security</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Manage Profile</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="password.php">Password</a></li>
                </ul>
            </div>
        </li>



        <li class="nav-item nav-category">More</li>

        <?php
        if(isset($_SESSION['subID']))
        {
        ?>
        <li class="nav-item">
            <a onclick="return confirm('Switching Account will log you out, Continue?');" class="nav-link" href="includes/switchAccount.inc.php">
                <i class="menu-icon mdi mdi-repeat"></i>
                <span class="menu-title">Switch Account</span>
            </a>
        </li>

        <?php
        }
        ?>

        <li class="nav-item">
            <a onclick="return confirm('Your are about to be logged out!');" class="nav-link" href="?logout=true">
                <i class="menu-icon mdi mdi-power"></i>
                <span class="menu-title">Sign Out</span>
            </a>
        </li>

        <li class="nav-item nav-category">help</li>
        <li class="nav-item">
            <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>