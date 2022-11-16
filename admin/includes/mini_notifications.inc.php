<li class="nav-item dropdown">
    <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="icon-bell"></i>
        <span class="count"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">


        <?php
        $miniNoty = new MiniNotifications();
        $miniNoty->viewMiniNotyLoop($_SESSION['id']);
        ?>

    </div>
</li>