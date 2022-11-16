<?php

class InstituteView extends Users
{


    public function studentProfile($id){
        $userRows = $this->GetUser($id);
        if($userRows == NULL){
            //user account missing due to id
            ?>
            <div class="container px-0">
                <div class="pp-gallery">
                    <div class="-card-columns">
                        <div class="alert alert-warning text-dark" role="alert">
                            <span class="mdi mdi-information-outline"></span> No Accounts found. <br><br>
                            User account appears to be missing
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        elseif ($userRows != NULL AND $userRows[0]['role'] != 'student'){
            //prevent access to accounts other than student
            ?>
            <div class="container px-0">
                <div class="pp-gallery">
                    <div class="-card-columns">
                        <div class="alert alert-warning text-dark" role="alert">
                            <span class="mdi mdi-information-outline"></span> Student Account Not Found. <br><br>
                            Student account appears to be missing
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        //two abouve conditions passed
        else{
            $studentEducationRows = $this->GetStudentEducationByUserID($id);
            if($studentEducationRows[0]['schoolID'] != $_SESSION['id']){
                ?>
                <div class="container px-0">
                    <div class="pp-gallery">
                        <div class="-card-columns">
                            <div class="alert alert-warning text-dark" role="alert">
                                <span class="mdi mdi-information-outline"></span> Student Account Access Prohibited. <br><br>
                                This student is not from this institute. Viewing their profile is prohibited.
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }else{
                $studentRows = $this->GetStudentByID($userRows[0]['id']);
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
                                        <li><span>Institute</span> : <span><a href="instituteProfile.php?userID=<?php echo 'SET' ?>"><?php echo $instituteRow[0]['name'] ?></a></span></li>
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

                                    <div class="col-md-12 pt-3 shadow-sm">
                                        <div class="card-description">
                                            <p class="card-description">Current Supervisor:
                                                <?php
                                                if($this->GetSubAccByID($studentEducationRows[0]['supervisorID']) != NULL){
                                                    $supervisorRows = $this->GetSubAccByID($studentEducationRows[0]['supervisorID']);
                                                    ?>
                                                    <a href="subAccProfile.php?subID=<?php echo $supervisorRows[0]['id']?>"><?php echo $supervisorRows[0]['name'] .' '. $supervisorRows[0]['surname'];  ?> <span class="fa fa-arrow-circle-right"></span></a>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <span class="badge badge-danger">Not Assigned</span>
                                                    <?php
                                                }
                                                ?>
                                            </p>
                                            <?php
                                            if($_SESSION['subRole'] == 'admin' || $_SESSION['subRole'] == 'adminSupervisor'){
                                                ?>
                                                <button onclick="myFunction()" type="button" class="btn btn-secondary col-md-12"> <span class="fa fa-chevron-circle-down">Assign New Supervisor</span></button>
                                                <div style="display: none" id="myDIV" class="shadow-sm p-3 rounded">
                                                    <form method="POST" action="includes/updateSupervisor.inc.php?userID=<?php echo $id ?>">
                                                        <select name="supervisor" class="form-control form-select" required>
                                                            <option value="">-- SELECT NEW SUPERVISOR --</option>
                                                            <?php
                                                            $n = new CompanyView();
                                                            $n->companySupervisorOptionLoop($id, $_SESSION['id']);
                                                            ?>
                                                            <option value="0">Un-Assign Supervisor</option>
                                                        </select>
                                                        <br>
                                                        <input name="btn_set_supervisor" type="submit" value="update" class="btn btn-primary btn-sm rounded">
                                                    </form>
                                                </div>
                                                <script>
                                                    function myFunction() {
                                                        var x = document.getElementById("myDIV");
                                                        if (x.style.display === "none") {
                                                            x.style.display = "block";
                                                        } else {
                                                            x.style.display = "none";
                                                        }
                                                    }
                                                </script>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }


    public function viewAllStudents($id){
        $studentEducationRows = $this->GetStudentsEducationByInstID($id);
        $s = 0;

        foreach ($studentEducationRows as $studentEducationRow){
            $s++;
            $studentRows = $this->GetStudentByID($studentEducationRow['userID']);
            $userRows = $this->GetUser($studentEducationRow['userID']);

            if($studentRows[0]['attachmentStatus'] == 1){
                $borderClass = 'success';
                $attStat = 'Attached';
            }
            else{
                $borderClass = 'danger';
                $attStat = 'Not Attached ';
            }
            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <td><a href="studentProfile.php?userID=<?php echo $studentRows[0]['user_id'] ?>"><?php echo $studentRows[0]['name'] ?></a></td>
                <td><a href="studentProfile.php?userID=<?php echo $studentRows[0]['user_id'] ?>"><?php echo $studentRows[0]['surname'] ?></a></td>
                <td><?php echo $userRows[0]['loginID'] ?></td>
                <td class="alert alert-<?php echo $borderClass ?>"><span class="badge badge-<?php echo $borderClass ?>"><?php echo $attStat?></span></td>

                <td>
                    <div class="-dropdown" style="z-index: 9999">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div style="z-index: 9999" class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                            <h6 class="dropdown-header">More</h6>
                            <a class="dropdown-item" href="studentProfile.php?userID=<?php echo $studentRows[0]['user_id'] ?>"><span class="fa fa-pencil"></span> View Profile </a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
        }
    }


    public function countAllInstituteUnattachedStudents($id){
        $studentEducationRows = $this->GetStudentsEducationByInstID($id);
        $s = 0;
        foreach ($studentEducationRows as $studentEducationRow){
            $studentRows = $this->GetStudentByID($studentEducationRow['userID']);
            if($studentRows[0]['attachmentStatus'] == 1){
                $s++;
            }
        }

        echo count($studentEducationRows) - $s;
    }


    public function countAllInstituteAttachedStudents($id){
        $studentEducationRows = $this->GetStudentsEducationByInstID($id);
        $s = 0;
        foreach ($studentEducationRows as $studentEducationRow){
            $studentRows = $this->GetStudentByID($studentEducationRow['userID']);
                if($studentRows[0]['attachmentStatus'] == 1){
                    $s++;
                }
        }
        echo $s;
    }

    public function countAllInstituteStudents($id){
        $studentEducationRows = $this->GetStudentsEducationByInstID($id);
        $n = new Usercontr();
        $n->myCount($studentEducationRows);
    }

}