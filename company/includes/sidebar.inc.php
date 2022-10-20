

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="../index.php">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Home Page</span>
            </a>
        </li>
        <li class="nav-item nav-category">UI Elements</li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Dashboard</span>
                <i class="menu-arrow"></i>
            </a>
        </li>

        <li class="nav-item nav-category">Manage Vacancies</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-element" aria-expanded="false" aria-controls="form-elements">
                <i class="menu-icon mdi mdi-newspaper"></i>
                <span class="menu-title">Vacancies</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-element">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="vacancies.php">Overview</a></li>
                    <li class="nav-item"><a class="nav-link" href="postVacancy.php">Post Vacancies</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Vacancy replies</a></li>
                </ul>
            </div>
        </li>


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



        <li class="nav-item nav-category">help</li>
        <li class="nav-item">
            <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>

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
    </ul>
</nav>