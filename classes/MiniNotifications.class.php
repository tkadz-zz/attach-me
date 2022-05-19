<?php

class MiniNotifications extends Users
{

    //View notifications from dropdown menu and loop them here
    public function viewMiniNotyLoop($id){
        $rows = $this -> getallactivenotifications($id);
        $c = count($rows);
        ?>

        <a class="dropdown-item py-3">
            <p class="mb-0 font-weight-medium float-left">You have <?php echo $c ?> unread Notifications </p>
            <span class="badge badge-pill badge-primary float-right">View all</span>
        </a>
        <div class="dropdown-divider"></div>

        <?php

        foreach ($rows as $row){
            $rowdate = $row['dateReceived'];
        ?>
            <!-- Notification Type Decision -->
            <?php
            if($row['notyType'] == 1){
                ?>
                <span class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <span class="card-body rounded shadow-sm btn-danger">A</span>
                    </div>
                    <div class="preview-item-content flex-grow py-2">
                        <p class="preview-subject ellipsis font-weight-medium text-dark">Administrator Alert<br>(<span class="" style="font-size: 10px"><?php echo $rowdate ?></span>) </>
                        <p class="fw-light small-text mb-0"> mini notification body...
                            <a href="#!" style="padding: 2px" class="text-decoration-none btn btn-primary fa fa-eye"></a> |
                            <a href="#!" style="padding: 2px"class="text-decoration-none btn btn-success fa fa-check"></a> |
                            <a href="#!" style="padding: 2px"class="text-decoration-none btn btn-danger fa fa-trash"></a>
                        </p>
                    </div>
                </span>
                <?php
            }

            if($row['notyType'] == 2){
                ?>
                <span class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <span class="card-body rounded shadow-sm btn-success"><span class="fa fa-briefcase"></span></span>
                    </div>
                    <div class="preview-item-content flex-grow py-2">
                        <p class="preview-subject ellipsis font-weight-medium text-dark">Work Related Learning<br>(<span class="" style="font-size: 10px"><?php echo $rowdate ?></span>) </p>
                        <p class="fw-light small-text mb-0"> mini notification body... <a class="mdi mdi-page-previous-outline"></a></p>
                    </div>
                </span>
                <?php
            }


            if($row['notyType'] == 3){
                ?>
                <span class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <span class="card-body rounded shadow-sm btn-primary"><span class="fa fa-envelope"></span></span>
                    </div>
                    <div class="preview-item-content flex-grow py-2">
                        <p class="preview-subject ellipsis font-weight-medium text-dark">New Message<br>(<span class="" style="font-size: 10px"><?php echo $rowdate ?></span>) </p>
                        <p class="fw-light small-text mb-0"> mini notification body... <a class="mdi mdi-page-previous-outline"></a></p>
                    </div>
                </span>
                <?php
            }


            if($row['notyType'] == 4){
                ?>
                <span class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <span class="card-body rounded shadow-sm btn-warning"><span class="fa fa-gears"></span></span>
                    </div>
                    <div class="preview-item-content flex-grow py-2">
                        <p class="preview-subject ellipsis font-weight-medium text-dark">System Alert<br>(<span class="" style="font-size: 10px"><?php echo $rowdate ?></span>) </p>
                        <p class="fw-light small-text mb-0"> mini notification body... <a class="mdi mdi-page-previous-outline"></a></p>
                    </div>
                </span>
                <?php
            }


            if($row['notyType'] == 5){
                ?>
                <span class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <span class="card-body rounded shadow-sm btn-dark"><span class="fa fa-building"></span></span>
                    </div>
                    <div class="preview-item-content flex-grow py-2">
                        <p class="preview-subject ellipsis font-weight-medium text-dark">Institute Alert<br>(<span class="" style="font-size: 10px"><?php echo $rowdate ?></span>) </p>
                        <p class="fw-light small-text mb-0"> mini notification body... <a class="mdi mdi-page-previous-outline"></a></p>
                    </div>
                </span>
                <?php
            }


            if($row['notyType'] == 6){
                ?>
                <span class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <span class="card-body rounded shadow-sm btn-secondary"><span style="font-size: 20px" class="mdi mdi-medical-bag text-primary"></span></span>
                    </div>
                    <div class="preview-item-content flex-grow py-2">
                        <p class="preview-subject ellipsis font-weight-medium text-dark">Student Welfare Alert<br>(<span class="" style="font-size: 10px"><?php echo $rowdate ?></span>) </p>
                        <p class="fw-light small-text mb-0"> mini notification body... <a class="mdi mdi-page-previous-outline"></a></p>
                    </div>
                </span>
                <?php
            }

            ?>




        <?php
        }
    }

}