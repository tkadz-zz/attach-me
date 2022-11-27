<?php

class AdminView extends AdminModel
{

    public function viewSubAccProfile($accID, $subID){
        $subAccRows = $this->GetSubAccByAccIDAndUserID($accID, $subID);
        $deptRows = $this->GetDeptById($subAccRows[0]['department']);
        if($subAccRows[0]['role'] == 'admin'){
            $borderClass = 'danger';
            $subRole = 'admin';
        }
        elseif ($subAccRows[0]['role'] == 'adminSupervisor'){
            $borderClass = 'warning';
            $subRole = 'coodinator';
        }
        elseif ($subAccRows[0]['role'] == 'supervisor'){
            $borderClass = 'success';
            $subRole = 'supervisor';
        }

        if($subAccRows[0]['status'] == 1){
            $status = 'Active';
            $statusBadge = 'success';
        }
        else{
            $status = 'Not Active';
            $statusBadge = 'danger';
        }

        ?>
        <div class="col-md-12">
            <div class="card border border-<?php echo $borderClass ?> border-3">
                <div class="card-body">
                    <h4 class="card-title card-header"><?php echo $subAccRows[0]['name'] .' '. $subAccRows[0]['surname'] ?> <span class="badge badge-<?php echo $borderClass ?> border rounded <?php echo $borderClass ?>"><?php echo $subRole ?></span> </h4>

                    <div class="row">
                        <div class="col-md-4">
                            <span>Details</span>
                            <ul>
                                <?php
                                $addDetRow = $this->GetCompanyByUserID($accID);
                                ?>
                                <li><span>Sex</span> : <span><?php echo $subAccRows[0]['sex'] ?></span></li>
                                <li><span>Email</span> : <span><a href="mail:<?php echo $subAccRows[0]['email'] ?>"><?php echo $subAccRows[0]['email'] ?></a></span></li>
                                <li><span>Phone</span> : <span><a href="tel:<?php echo $subAccRows[0]['phone'] ?>"><?php echo $subAccRows[0]['phone'] ?></a></span></li>
                                <li><span>Joined</span> : <span><?php echo $this->dateToDay($subAccRows[0]['dateAdded'] ) ?></span></li>
                                <li><span>Bio</span> : <br><span><?php echo $subAccRows[0]['description'] ?></span></li>
                            </ul>
                        </div>


                        <div class="col-md-4">
                            <form method="POST" action="includes/addSubAcc.inc.php">
                                <span style="font-size: 13px">Account Type</span> : <span class="badge badge-<?php echo $borderClass ?> border rounded <?php echo $borderClass ?>"><?php echo $subRole ?></span>
                                <br>
                                <div class="pt-2">
                                </div>
                                <br>
                                <span style="font-size: 13px">Department </span> : <span class="badge badge-secondary text-dark">
                                <?php
                                if ($subAccRows[0]['department'] != 0) {
                                    echo $deptRows[0]['department'];
                                }
                                ?>
                                </span>
                                <br>
                                <div class="pt-2">

                                </div>
                                <br>
                                <span style="font-size: 13px">Account Status </span> : <span class="badge badge-<?php echo $statusBadge ?>"><?php echo $status ?></span>
                                <br>
                                <div class="pt-2">
                                    <select name="subStatus" class="form-control form-select">
                                        <option value="<?php echo $subAccRows[0]['status']  ?>"><?php echo $status ?> (current)</option>
                                        <?php
                                        if($subAccRows[0]['status'] == 1){
                                            ?>
                                            <option value="0">DeActivate</option>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <option value="1">Activate</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <input type="text" name="subID" value="<?php echo $subID ?>" hidden>
                                <br>
                                <div class="pb-3">
                                    <button type="submit" name="btn_update_subAcc" class="btn btn-primary btn-sm">Update</button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-4">
                            <label>Advanced Options</label>
                            <br>
                            <br>
                            <a href="includes/resetSubAccPassword.inc.php?subID=<?php echo $subID ?>" class="btn btn-outline-info">Reset Password <span class="mdi mdi-lock-open"></span></a>
                            <br>
                            <br>
                            <a onclick="return confirm('This Account will be deleted permanently. Proceed?')" href="includes/addSubAcc.inc.php?delSubAcc&subID=<?php echo $subID ?>" class="btn btn-outline-danger">Delete This Account <span class="mdi mdi-trash-can"></span></a>

                        </div>
                        <hr>
                        <?php
                        if($subAccRows[0]['role'] != 'admin'){
                            ?>
                            <p class="text-muted font-14 mb-3">
                                Students under <?php echo $subAccRows[0]['name'] .' '. $subAccRows[0]['surname'] ?>'s Supervision
                            </p>
                            <div class="col-md-12">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap">

                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Reg#</th>
                                        <?php
                                        if($_SESSION['role'] == 'company'){
                                            ?>
                                            <th>Contract Status</th>
                                            <?php
                                        }
                                        ?>
                                        <th>More</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    $n = new CompanyView();
                                    $n->viewAllMyCompanyAttachedStudents($companyID, $subID);
                                    ?>
                                    </tbody>


                                </table>
                            </div>
                            <?php
                        }
                        ?>

                    </div>

                </div>
            </div>
        </div>
        <?php
    }

    public function viewAdmin($id){
        echo 'still under view';
    }

    public function viewCompany($id){
        $cv = new Userview();
        $cv->viewCompanyProfile($_GET['userID']);
        ?>

                <?php
                $n = new AdminView();
                $n->subAccLoop($id);
                ?>
        <?php
    }

    public function viewInstitute($id){
        $cv = new Userview();
        $cv->viewInstituteProfile($_GET['userID']);
        ?>

                <?php
                $n = new AdminView();
                $n->subAccLoop($id);
                ?>
        <?php
    }

    public function viewStudent($id){
        $studentRows = $this->GetStudentByUserID($id);
        $userRows = $this->GetUserByID($id);
        $studentEducationRows = $this->GetStudentEducationByUserID($id);

        if($studentRows[0]['attachmentStatus'] == '1'){
            $borderClass = 'success';
            $msg = 'Attached';
        }
        else{
            $borderClass = 'danger';
            $msg = 'Not Attached';
        }
        ?>
        <div class="col-md-12">
            <div class="card border border-<?php echo $borderClass ?> border-3">
                <div class="card-body">
                    <h4 class="card-title card-header"><?php echo $studentRows[0]['name'] .' '. $studentRows[0]['surname'] ?><span style="font-size: 13px">(<?php echo $userRows[0]['loginID'] ?>)</span><span class="badge badge-<?php echo $borderClass ?> border rounded <?php echo $borderClass ?>"><?php echo $msg ?></span> </h4>
                    <a href="attachmentHistory.php?userID=<?php echo $id ?>" -style="float: right" class="btn btn-outline-success btn-sm">attachment history <span class="fa fa-chevron-right"></span> </a>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <span>Personal</span>
                            <ul>
                                <li><span>National ID</span> : <span><?php echo $studentRows[0]['nationalID'] ?></span></li>
                                <li><span>Email</span> : <span><a href="mail:<?php echo $studentRows[0]['email'] ?>"><?php echo $studentRows[0]['email'] ?></a></span></li>
                                <li><span>Phone</span> : <span><a href="tel:<?php echo $studentRows[0]['phone'] ?>"><?php echo $studentRows[0]['phone'] ?></a></span></li>
                                <li><span>Address</span> : <span><?php echo $studentRows[0]['homeAddress'] ?></span></li>
                                <li><span>Sex</span> : <span><?php echo $studentRows[0]['sex'] ?></span></li>
                                <li><span>DOB</span> : <span><?php echo $this->dayDate($studentRows[0]['dob']) ?></span></li>
                                <li><span>Marital</span> : <span><?php echo $studentRows[0]['marital'] ?></span></li>
                                <li><span>Religion</span> : <span><?php echo $studentRows[0]['religion'] ?></span></li>
                                <li><span>Bio</span> : <br><span><?php echo $studentRows[0]['aboutSelf'] ?></span></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <span>Education</span>
                            <ul>
                                <?php
                                $instituteRow = $this->GetInstituteByUserID($studentEducationRows[0]['schoolID']);
                                $programRows = $this->GetProgramByID($studentEducationRows[0]['programID']);
                                ?>
                                <li><span>Institute</span> : <span><a href="instituteProfile.php?userID=<?php echo $studentEducationRows[0]['schoolID'] ?>"><?php echo $instituteRow[0]['name'] ?></a></span></li>
                                <li><span>Program</span> : <span><?php echo $studentEducationRows[0]['programType'] ?>'s in <?php echo $programRows[0]['name'] ?></span></li>
                                <li><span>Course</span> : <span><?php echo $this->dayDate($studentEducationRows[0]['initial_year']) ?> to <?php echo $this->dayDate($studentEducationRows[0]['final_year']) ?></span></li>
                            </ul>
                            <?php
                            if($studentRows[0]['attachmentStatus'] == 1){
                                $attchementRows = $this->GetAttachmentsByUserID($id);
                                $companyRows = $this->GetCompanyByUserID($attchementRows[0]['companyID']);
                                ?>
                                <span>Company</span>
                                <ul>
                                    <?php
                                    $attachmentRows = 0 //TODO: Set attchemnt variables
                                    ?>
                                    <li><span>Name</span> : <span><a href="companyProfile.php?userID=<?php echo $attchementRows[0]['companyID']  ?>"><?php echo $companyRows[0]['name'] ?></a></span></li>
                                    <li><span>Duration</span> : <span>From <?php echo $this->dayDate($attchementRows[0]['dateStart']) ?> to <?php echo $this->dayDate($attchementRows[0]['dateEnd']) ?></span></li>
                                    <li><span>Contract Status</span> : <span>
                                                        <?php
                                                        if($attchementRows[0]['dateEnd'] >= date('Y-m-d')){
                                                            $borderClass = 'success';
                                                            $attStat = 'valid';
                                                        }
                                                        else{
                                                            $borderClass = 'danger';
                                                            $attStat = 'expired ' .$this->timeAgo($attchementRows[0]['dateEnd']);
                                                        }
                                                        ?>
                                                        <td class="alert alert-<?php echo $borderClass ?>"><span class="badge badge-<?php echo $borderClass ?>"><?php echo $attStat?></span></td>
                                                    </span>
                                    </li>
                                    <?php

                                    ?>
                                </ul>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <span>Documents</span>
                            <?php
                            //Get Reports Variables
                            $cvRows = $this->GetCvByUserID($id);
                            $attachmentReportRows = $this->GetAttachmentReportByUserID($id);
                            $supervisorReportRows = $this->GetSupervisorsReportByUserID($id);
                            $logbookRows = $this->GetLogbookByUserID($id);
                            ?>
                            <br>
                            <br>
                            <div class="row" id="documents">
                                <div class="col-md-6" id="cv">
                                                <span href="#!">
                                                    <div class="-card myhover -text-white text-center -bg-gradient-dark mb-3">
                                                        <div class="card-header">Curriculum Vitae</div>
                                                        <div class="card-body">

                                                            <?php
                                                            if($cvRows == NULL){
                                                                ?>
                                                                <div class="-dropdown">
                                                                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Manage
                                                                    </button>
                                                                    <div style="font-size: 12px" class="dropdown-menu border border-danger" aria-labelledby="dropdownMenuIconButton6">
                                                                        <h6 class="dropdown-header badge badge-danger">Unavailable</h6>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <div class="-dropdown">
                                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Manage
                                                                    </button>
                                                                    <div style="font-size: 12px" class="dropdown-menu border border-success" aria-labelledby="dropdownMenuIconButton6">
                                                                        <h6 class="dropdown-header badge badge-success">Available</h6>
                                                                        <a class="dropdown-item" href="<?php echo $cvRows[0]['file'] ?>" target="_blank"><span class="fa fa-download"></span> Download </a>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                </span>
                                </div>

                                <?php
                                if($studentRows[0]['attachmentStatus'] == 1) {
                                    ?>

                                    <div class="col-md-6" id="attachmentReport">
                                        <span none" href="#!">
                                        <div class="-card myhover -text-white text-center -bg-gradient-dark -mb-3">
                                            <div class="card-header">Attachment Report</div>
                                            <div class="card-body">
                                                <?php
                                                if($attachmentReportRows == NULL){
                                                    ?>
                                                    <div class="-dropdown">
                                                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Manage
                                                        </button>
                                                        <div style="font-size: 12px" class="dropdown-menu border border-danger" aria-labelledby="dropdownMenuIconButton6">
                                                            <h6 class="dropdown-header badge badge-danger">Unavailable</h6>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>

                                                    <div class="-dropdown">
                                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Manage
                                                        </button>
                                                        <div style="font-size: 12px" class="dropdown-menu border border-success" aria-labelledby="dropdownMenuIconButton6">
                                                            <h6 class="dropdown-header badge badge-success">Available</h6>
                                                            <a class="dropdown-item" href="<?php echo $attachmentReportRows[0]['file'] ?>" target="_blank"><span class="fa fa-download"></span> Download </a>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        </span>
                                    </div>

                                    <div class="col-md-6" id="assessmentReport">
                                                    <span s href="#!">
                                                        <div class="-card myhover -text-white text-center -bg-gradient-dark mb-3">
                                                            <div class="card-header">Assessment Report</div>
                                                            <div class="card-body">
                                                                <?php
                                                                if($supervisorReportRows == NULL){
                                                                    ?>
                                                                    <div class="-dropdown">
                                                                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            Manage
                                                                        </button>
                                                                        <div style="font-size: 13px" class="dropdown-menu border border-danger" aria-labelledby="dropdownMenuIconButton6">
                                                                            <h6 class="dropdown-header text-danger">Unavailable</h6>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>

                                                                    <div class="-dropdown">
                                                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            Manage
                                                                        </button>
                                                                        <div style="font-size: 13px" class="dropdown-menu border border-success" aria-labelledby="dropdownMenuIconButton6">
                                                                            <h6 class="dropdown-header badge badge-success">Available</h6>
                                                                            <a class="dropdown-item" href="<?php echo $supervisorReportRows[0]['file'] ?>" target="_blank"><span class="fa fa-download"></span> Download </a>
                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </span>
                                    </div>

                                    <div class="col-md-6" id="logbook">
                                                    <span style="text-decoration: none" href="#!">
                                                        <div class="-card myhover -text-white text-center -bg-gradient-dark mb-3" style="max-width: 18rem;">
                                                            <div class="card-header">Logbook Report</div>
                                                            <div class="card-body">
                                                                <?php

                                                                if($logbookRows == NULL){
                                                                    ?>
                                                                    <div class="-dropdown">
                                                                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            Manage
                                                                        </button>
                                                                        <div style="font-size: 13px" class="dropdown-menu border border-danger" aria-labelledby="dropdownMenuIconButton6">
                                                                            <h6 class="dropdown-header badge badge-danger">Unavailable</h6>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>

                                                                    <div class="-dropdown">
                                                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            Manage
                                                                        </button>
                                                                        <div style="font-size: 13px" class="dropdown-menu border border-success" aria-labelledby="dropdownMenuIconButton6">
                                                                            <h6 class="dropdown-header badge badge-success">Available</h6>
                                                                            <a class="dropdown-item" href="<?php echo $logbookRows[0]['file'] ?>" target="_blank"><span class="fa fa-download"></span> Download </a>
                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </span>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function viewUserProfile($userID){
        $userRows = $this->GetUserByID($userID);

        if($userRows[0]['role'] == 'admin'){
            $this->viewAdmin($userID);
        }
        elseif ($userRows[0]['role'] == 'company'){
            $this->viewCompany($userID);
        }
        elseif ($userRows[0]['role'] == 'institute'){
            $this->viewInstitute($userID);
        }
        elseif ($userRows[0]['role'] == 'student'){
            $this->viewStudent($userID);
        }
        else{
            echo 'Role not defined';
        }

    }


    public function subAccLoop($id){
        $subAccRows = $this->GetSubAccByAccID($id);
        $s = 0;
        ?>
        <br>
        <br>
        <div id="--printableArea" class="card-box">
        <h4 class="mt-0 header-title"></h4>
        <p class="text-muted font-14 mb-3">
            Showing all Sub-Accounts
        </p>
        <hr>
        <table id="datatable" class="table table-bordered dt-responsive nowrap">

        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Department</th>
            <th>Acc Type</th>
            <th>More</th>
        </tr>
        </thead>

        <tbody>
        <?php

        foreach ($subAccRows as $subAccRow){
            $s++;
            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <td><a href="subAccProfile.php?accID=<?php echo $id ?>&subID=<?php echo $subAccRow['id'] ?>"><?php echo $subAccRow['name'] ?></a></td>
                <td><a href="subAccProfile.php?accID=<?php echo $id ?>&subID=<?php echo $subAccRow['id'] ?>"><?php echo $subAccRow['surname'] ?></a></td>
                <td>
                    <?php
                    if($subAccRow['department'] == 0 || $subAccRow['department'] == ''  ){
                        echo '';
                    }
                    else {
                        $deptRows = $this->GetDeptById($subAccRow['department']);
                        echo $deptRows[0]['department'];
                    }
                    ?>
                </td>
                <td><?php
                    if($subAccRow['role'] == 'admin'){
                        ?>
                        <span class="badge badge-danger"> Admin </span>
                        <?php
                    }
                    if($subAccRow['role'] == 'adminSupervisor'){
                        ?>
                        <span class="badge badge-warning"> Coordinator </span>
                        <?php
                    }
                    if($subAccRow['role'] == 'supervisor'){
                        ?>
                        <span class="badge badge-success"> Supervisor </span>
                        <?php
                    }
                    ?></td>

                <td>
                    <div class="-dropdown" style="z-index: 9999">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div style="z-index: 9999" class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                            <h6 class="dropdown-header">More</h6>
                            <a class="dropdown-item" href="subAccProfile.php?accID=<?php echo $id ?>&subID=<?php echo $subAccRow['id'] ?>"><span class="fa fa-pencil"></span> View Profile </a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        </table>
        </div>
        <?php
    }


    public function viewAllCategories(){
        $rows = $this->GetAllCartegories();
        $s = 0;
        foreach ($rows as $row){
            $s++;
            if($row['status'] == 1){
                $borderClass = 'success';
                $active = 'active';
            }
            else{
                $borderClass = 'danger';
                $active = 'active';
            }

            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <td><?php echo $row['category'] ?></td>
                <td><span class="badge badge-<?php echo $borderClass ?>"><?php echo $active ?></span></td>
                <td>
                    <div class="-dropdown" style="z-index: 9999">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div style="z-index: 9999" class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                            <h6 class="dropdown-header">More</h6>
                            <a class="dropdown-item" href="#!"><span class="fa fa-pencil"></span> Edit </a>
                            <a onclick="return confirm('This Category will be deleted. Proceed?')" class="dropdown-item" href="includes/category.inc.php?delCateg&categID=<?php echo $row['id'] ?>"><span class="fa fa-trash"></span> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
        }
    }

    public function viewAllPrograms(){
        $rows = $this->GetAllPrograms();
        $s = 0;
        foreach ($rows as $row){
            $s++;
            if($row['status'] == 1){
                $borderClass = 'success';
                $active = 'active';
            }
            else{
                $borderClass = 'danger';
                $active = 'active';
            }
            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <td><?php echo $row['name'] ?></td>
                <td><span class="badge badge-<?php echo $borderClass ?>"><?php echo $active ?></span></td>
                <td>
                    <div class="-dropdown" style="z-index: 9999">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div style="z-index: 9999" class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                            <h6 class="dropdown-header">More</h6>
                            <a class="dropdown-item" href="#!"><span class="fa fa-pencil"></span> Edit </a>
                            <a onclick="return confirm('This Program will be deleted. Proceed?')" class="dropdown-item" href="includes/program.inc.php?delProgram&programID=<?php echo $row['id'] ?>"><span class="fa fa-trash"></span> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
        }
    }

    public function ViewAllUsers(){
        $rows = $this->GetAllUsers();
        $s=0;
        foreach ($rows as $row){
            $s++;
            $userRows = $this->isUser($row['id'], $row['role']);

            if($row['role'] == 'admin'){
                $borderClass = 'danger';
            }
            elseif ($row['role'] == 'student'){
                $borderClass = 'success';
            }
            elseif ($row['role'] == 'institute'){
                $borderClass = 'primary';
            }
            elseif ($row['role'] == 'company'){
                $borderClass = 'warning';
            }

            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <td><a href="userProfile.php?userID=<?php echo $row['id'] ?>">
                        <?php
                        echo $userRows[0]['name'];
                        if($row['role'] == 'student'){
                            echo ' '. $userRows[0]['surname'];
                        }
                        ?></a>
                </td>
                <td><span class="badge badge-<?php echo $borderClass ?>"><?php echo $row['role'] ?></span></td>
                <td><a href="userProfile.php?userID=<?php echo $row['id'] ?>"><span class="fa fa-pencil"></span></a></td>
            </tr>
            <?php
        }
    }

    public function myCount($ress){
        $s = 0;
        foreach ($ress as $res){
            $s++;
        }
        if($s >= 100){
            echo '99+';
        }
        else{
            echo $s;
        }
    }

    public function countAllUsers(){
        $userRows = $this->GetAllUsers();
        $n = new Usercontr();
        $n->myCount($userRows);
    }

    public function countAllPrograms(){
        $userRows = $this->GetAllPrograms();
        $n = new Usercontr();
        $n->myCount($userRows);
    }

    public function countAllStudents(){
        $userRows = $this->GetAllStudents();
        $n = new Usercontr();
        $n->myCount($userRows);
    }

    public function countAllCartegories(){
        $userRows = $this->GetAllCartegories();
        $n = new Usercontr();
        $n->myCount($userRows);
    }

    public function countAllCompanies(){
        $userRows = $this->GetAllCompanies();
        $n = new Usercontr();
        $n->myCount($userRows);
    }

    public function countAllInstitutes(){
        $userRows = $this->GetAllInstitutes();
        $n = new Usercontr();
        $n->myCount($userRows);
    }

    public function countAllAdmin(){
        $userRows = $this->GetAllAdmin();
        $n = new Usercontr();
        $n->myCount($userRows);
    }

}