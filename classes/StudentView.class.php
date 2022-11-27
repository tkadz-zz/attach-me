<?php

class StudentView extends Users
{


    public function viewIsDocumentAvailable($type, $id){
        if($type == 'cv'){
            $Dtype = 'Curriculum Vitae';
            $docRows = $this->GetCvByUserID($id);
        }
        elseif($type == 'attRep'){
            $Dtype = 'Attachment Report';
            $docRows = $this->GetAttachmentReportByUserID($id);
        }
        elseif($type == 'assRep'){
            $Dtype = 'Assessment Report';
            $docRows = $this->GetSupervisorsReportByUserID($id);
        }
        elseif($type == 'logb'){
            $Dtype = 'Logbook';
            $docRows = $this->GetLogbookByUserID($id);
        }
        else{
            echo "<script type='text/javascript'>history.back(-1)</script>";
        }

        if($docRows == NULL){
            ?>
            No <?php echo $Dtype ?> uploaded yet
            <?php
        }
        else{
            ?>
            <label><?php echo $Dtype ?> Available</label>
            <br>
            <br>
            <div -id="divDis" class="animated--grow-in fadeout bg-white rounded -shadow-sm alert alert-info">
                <div class="closebtn"></div>
                <span class="text-dark">
                    <span class="animated--grow-in fadeout fa fa-file text-dark"></span>
                    <a href="<?php echo $docRows[0]['file'] ?>">Download <?php echo $Dtype ?></a>
                </span>
                <hr>
                <span class="text-dark"><strong>Uploaded: </strong><span><?php echo $this->timeAgo($docRows[0]['dateAdded']) ?> on <?php echo $this->dayDate($docRows[0]['dateAdded']) ?> </span></span>

                <a style="float: right; color: firebrick; font-size:15px" onclick="return confirm('Are you sure you want to proceed removing this qualification?')" href="includes/deleteDocument.inc.php?document=<?php echo $type ?>&userID=<?php echo $id ?>" class="closebtn" data-bs-dismiss="toast" aria-label="Close">
                    <span class="fa fa-trash"></span>
                </a>
            </div>
            <?php
        }

    }


    public function viewUploadDocument($id){
        $doc = $_GET['document'] ;

        if($doc == 'cv'){
            $type = 'cv';
            $Dtype = 'Curriculum Vitae';
        }
        elseif($doc == 'attRep'){
            $type = 'attachmentReport';
            $Dtype = 'Attachment Report';
        }
        elseif($doc == 'assRep'){
            $type = 'assessmentReport';
            $Dtype = 'Assessment Report';
        }
        elseif($doc == 'logb'){
            $type = 'logbook';
            $Dtype = 'Logbook';
        }
        else{
            echo "<script type='text/javascript'>history.back(-1)</script>";
        }
        ?>

        <div class="container">
            <br>
            <h4>Upload <?php echo $Dtype ?></h4>
        </div>


        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">
                <div class="col-md-8">
                    <form method="POST" action="includes/uploadDocument.inc.php?document=<?php echo $doc ?>&userID=<?php echo $id ?>" enctype="multipart/form-data">
                        <div>
                            <label class="card-description">Choose <?php echo $Dtype ?> file to upload</label>
                            <div class="pb-2">
                                <input class="form-control" type="file" name="docFile" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload <span class="fa fa-upload"></span></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <?php
                    $this->viewIsDocumentAvailable($doc, $id);
                    ?>
                </div>


            </div>
        </div>



        <?php
    }



    public function viewAppliedVacancies($id){
        $rows = $this->GetApplicationByUserID($id);
        $s = 0;
        foreach ($rows as $row){
            $s++;
            $vacancyRows = $this->GetVacancyByUniqueID($row['vacancyUID']);
            $vCateg = $this->GetCategoryByID($vacancyRows[0]['cartegory']);

            if($vacancyRows[0]['expiryDate'] >= date('Y-m-d')){
                $borderClass = 'success';
            }
            else{
                $borderClass = 'danger';
            }
            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <td><a href="applicationDetailedDetails.php?vuid=<?php echo $vacancyRows[0]['uniqueID'] ?>"><?php echo $vacancyRows[0]['title'] ?></a></td>
                <td><?php echo $vCateg[0]['category'] ?></td>
                <td><?php echo $this->dayDate($vacancyRows[0]['dateOnline']);?></td>
                <td class="alert alert-<?php echo $borderClass ?>"><?php echo $this->dayDate($vacancyRows[0]['expiryDate']) ?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                            <h6 class="dropdown-header">More</h6>
                            <a class="dropdown-item" href="applicationDetailedDetails.php?vuid=<?php echo $vacancyRows[0]['uniqueID'] ?>"><span class="fa fa-eye"></span> View Vacancy </a>
                            <a class="dropdown-item" href="includes/applicantOptions.inc.php?action=share&userID=<?php echo $id ?>&vuid=<?php echo $vacancyRows[0]['uniqueID']  ?>"><span class="fa fa-share"></span> Share</a>
                            <a onclick="return confirm('This vacancy application will be deleted. Proceed?')" class="dropdown-item" href="includes/applicantOptions.inc.php?action=delete&userID=<?php echo $id ?>&vuid=<?php echo $vacancyRows[0]['uniqueID']  ?>"><span class="fa fa-trash"></span> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
        }
    }

    public function viewApplyForm($vuid){
        $rows = $this->GetVacancyByUniqueID($vuid);
        $categoryRows = $this->GetCategoryByID($rows[0]['cartegory']);
        if($rows[0]['expiryDate'] >= date('Y-m-d')){
            $borderClass = 'success';
            $msg = 'Due: ' . $this->dateToDay($rows[0]['expiryDate']);
        }
        else{
            $borderClass = 'danger';
            $msg = 'Expired';
        }
        ?>
        <div class="col-md-12 rounded shadow-sm bg-white border border-<?php echo $borderClass ?>">
            <div -class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Vacancy Detailed Summery <span class="badge badge-<?php echo $borderClass ?> border rounded <?php echo $borderClass ?>"><?php echo $msg ?></span> </h4>
                    <div>
                        <p class="card-description">The following are the vacancy details</p>
                        <div>
                            <ul class="mylst">
                                <?php
                                if($rows[0]['expiryDate'] >= date('Y-m-d')){
                                    ?>
                                    <span><a data-toggle="tooltip" data-placement="right" title="Add to Bookmarks" href="vacancy.php?vuid=<?php echo $vuid ?>" class="fb-xfbml-parse-ignore btn btn-outline-danger btn-sm rounded"><span class="fa fa-bookmark"></span> </a></span>
                                    <span><a data-toggle="tooltip" data-placement="right" title="Share with friends and family" href="vacancy.php?vuid=<?php echo $vuid ?>" class="fb-xfbml-parse-ignore btn btn-outline-success btn-sm rounded"><span class="fa fa-share"></span> </a></span>

                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <span class="text-decoration-underline h6">Company Details</span>
                                <br>
                                <br>
                                <ul>
                                    <?php
                                    $companyRows = $this->GetCompanyById($rows[0]['companyID']);
                                    ?>
                                    <div class="shadow-sm card-body">
                                        <?php
                                        if($companyRows[0]['avatar'] == ''){
                                            ?>
                                            <img class="card-img-top rounded-circle" style="width: 80px" src="../img/companyEnterprise.png" alt="Card image cap">
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <img class="card-img-top rounded-circle" style="width: 80px" src="<?php echo $companyRows[0]['avatar'] ?>" alt="Card image cap">
                                            <?php
                                        }
                                        ?>
                                        <span class="h6 p2"><?php echo $companyRows[0]['name'] ?></span>

                                        <br>
                                        <br>
                                        <span><span class="fa fa-envelope"></span> <a target="_blank" href="mailto:<?php echo $companyRows[0]['email'] ?>"><?php echo $companyRows[0]['email'] ?></a></span><br>
                                        <span><span class="fa fa-phone"></span> <a href="tel:<?php echo $companyRows[0]['phone'] ?>"><?php echo $companyRows[0]['phone'] ?></a></span><br>
                                        <span><span class="fa fa-location-arrow"></span> <?php echo $companyRows[0]['address'] ?></span><br>
                                        <span><span class="fa fa-globe"></span> <a target="_top" href="<?php echo $companyRows[0]['website'] ?>"></a><?php echo $companyRows[0]['website'] ?></span><br>

                                    </div>
                                </ul>
                            </div>


                            <div class="col-md-6  border-start">
                                <div class="shadow-sm card-body">
                                    <span class="text-decoration-underline h6">Vacancy Details</span>
                                    <br>
                                    <br>
                                    <div style="font-size: 13px">
                                        <span class="text-decoration-underline" style="font-size: 13px"><b>Title</b></span>: <?php echo $rows[0]['title'] ?><br>
                                        <span class="text-decoration-underline" style="font-size: 13px"><b>Category</b></span>: <a class="badge badge-primary text-decoration-none" data-toggle="tooltip" data-placement="right" title="View All <?php echo $categoryRows[0]['category'] ?> Vacancies" href="vacancies.php?filter=<?php echo $categoryRows[0]['category'] ?>&fid=<?php echo $categoryRows[0]['id'] ?>"><?php echo $categoryRows[0]['category'] ?></a>
                                        <br>
                                        <span class="text-decoration-underline" style="font-size: 13px"><b>Posted</b></span>: <?php echo $this->dateToDay($rows[0]['dateOnline']) ?><br>
                                        <span class="text-decoration-underline" style="font-size: 13px"><b>Due</b></span>: <span class="text-<?php echo $borderClass ?>">
                                        <?php
                                        $today = date('Y-m-d');
                                        if($rows[0]['expiryDate'] == $today){
                                            echo 'Today';
                                        }
                                        else {
                                            echo $this->dateToDay($rows[0]['expiryDate']);
                                        }

                                        ?></span><br>
                                        <br>
                                        <span class="text-decoration-underline" style="font-size: 14px"><b>Body</b></span><br>
                                        <span style="font-size: 13px"><?php echo $rows[0]['body'] ?></span>
                                    </div>
                                    <br>

                                    <span class="text-decoration-underline" style="font-size: 14px"><b>Qualifications</b></span><br>
                                    <span style="font-size: 13px"><?php
                                        $n = new CompanyView();
                                        $n->viewQualificationsloopNoDelete($vuid);
                                        ?>
                                </span>

                                    <div>
                                        <hr>
                                        <?php

                                        $applicationRows = $this->GetApplicationByVacancyIDAndUserID($vuid, $_SESSION['id']);
                                        $studentRows = $this->GetStudentByID($_SESSION['id']);

                                        if($studentRows[0]['attachmentStatus'] == 1){
                                            ?>
                                            <div class="container px-0">
                                                <div class="pp-gallery">
                                                    <div class="-card-columns">
                                                        <div class="alert alert-info text-dark" role="alert">
                                                            <span class="mdi mdi-information-outline"></span> You are Already Attached <br><br>
                                                            You can share this vacancy with your friends and family
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        else{
                                            if($rows[0]['expiryDate'] >= date('Y-m-d')){
                                                if($applicationRows == NULL){
                                                    ?>
                                                    <a onclick="return confirm('By Proceeding, Your acknowledge that your details will be sent to the employer. Proceed?')" href="includes/apply.inc.php?vuid=<?php echo $vuid ?>" class="btn btn-success btn-lg"><span class="fa fa-envelope"></span> Apply</a>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <div class="card-body shadow-lg">
                                                        <a  class="btn btn-warning btn-sm"><span class=""></span>Applied</a>
                                                        <div>
                                                            <span class="text-decoration-underline" style="font-size: 13px"><b>Applied On</b></span>: <span style="font-size: 12px"><?php echo $this->dateToDay($applicationRows[0]['dateAdded']) ?></span><br>
                                                            <span class="text-decoration-underline" style="font-size: 13px"><b>Read Status</b></span>: <span style="font-size: 12px">
                                                            <?php
                                                            if($applicationRows[0]['readStatus'] == 0){
                                                                ?>
                                                                <span class="badge badge-danger">No</span>
                                                                <?php
                                                            }
                                                            else{
                                                                echo '<span class="badge badge-success">Yes</span> '. $this->timeAgo($applicationRows[0]['dateRead']) .'( ' . $this->dateToDay($applicationRows[0]['dateRead']).')';
                                                            }
                                                            ?>
                                                        </span><br>
                                                            <br>
                                                            <span class="text-decoration-underline" style="font-size: 13px"><b>Reply Status</b></span>: <span class="badge badge-danger" style="font-size: 12px">
                                                                This section is still under construction
                                                            </span><br>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }

                                            else{
                                                ?>
                                                <a class="btn btn-danger btn-lg"><span class=""></span>Expired <?php echo $this->timeAgo($rows[0]['expiryDate']) ?></a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    public function categoryShortLoopsOption(){
        $rows = $this->GetCategoriesMiniLoop();
        foreach ($rows as $row){
            if(isset($_GET['filter']) AND $_GET['filter'] == $row['category']){
                $color = 'info';
            }
            else{
                $color = 'primary';
            }
            ?>
            <option data-toggle="tooltip" data-placement="right"  value="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></option>
            <?php
        }
    }

    public function categoryShortLoops(){
        $rows = $this->GetCategoriesMiniLoop();
        foreach ($rows as $row){
            if(isset($_GET['filter']) AND $_GET['filter'] == $row['category']){
                $color = 'info';
            }
            else{
                $color = 'primary';
            }
            ?>
            <a data-toggle="tooltip" data-placement="right" title="View All <?php echo $row['category'] ?> Vacancies" class="btn btn-outline-<?php echo $color ?>  pp-filter-button" href="?filter=<?php echo $row['category'] ?>&fid=<?php echo $row['id'] ?>" data-filter="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></a>
            <?php
        }
    }

    public function StudentViewCarrier($id){
        $userRow = $this->GetUser($id);
        $studentRow = $this->GetStudentByID($id);
        $studentEducationRows = $this->GetStudentEducationByUserID($id);
        $instituteRow = $this->GetInstituteByUserID($studentEducationRows[0]['schoolID']);
        $programRows = $this->GetProgramByID($studentEducationRows[0]['programID']);
        $cvRows = $this->GetCvByUserID($id);
        $attachmentReportRows = $this->GetAttachmentReportByUserID($id);
        $supervisorReportRows = $this->GetSupervisorsReportByUserID($id);
        $logbookRows = $this->GetLogbookByUserID($id);
        ?>

        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <?php
                        $this->sexProfileImageView($id, $studentRow[0]['sex']);
                        ?>
                        <br>
                        <span class="font-weight-bold"><?php echo $studentRow[0]['name'] .' '. $studentRow[0]['surname']   ?></span>
                        <span class="text-black-50"><?php echo $studentRow[0]['email'] ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">

                        <div class="row">
                            <div class="col-md-12 shadow-sm">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right card-header">My Carrier</h4>
                                </div>
                                <div class="mt-2">
                                    <div class="col-md-6">
                                        <label class="labels text-decoration-underline">Institute:</label>
                                        <p><a href="instituteProfile.php?userID=<?php echo $instituteRow[0]['userID'] ?>"><?php echo $instituteRow[0]['name'] ?> Resorces <span class="fa fa-external-link"></span></a></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-2">
                                    <div class="col-md-6">
                                        <label class="labels text-decoration-underline">Program/Course:</label>
                                        <p><?php echo $studentEducationRows[0]['programType'] ?>'s in <?php echo $programRows[0]['name'] ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-2">
                                    <div class="col-md-12">
                                        <label class="labels text-decoration-underline">Company Attached:</label><br>
                                        <?php
                                        if($studentRow[0]['attachmentStatus'] != 1) {
                                            ?>
                                            <p class="badge badge-warning text-dark">Not Attached Yet</p>
                                            <?php
                                        }
                                        else{
                                            $attachmentRows = $this->GetAttachmentsByUserID($id);
                                            $companyRows = $this->GetCompanyById($attachmentRows[0]['companyID']);
                                            ?>
                                            <ul>
                                                <li><span>Name</span> : <span><a href="companyProfile.php?userID=<?php echo $attachmentRows[0]['companyID']  ?>"><?php echo $companyRows[0]['name'] ?></a></span></li>
                                                <li><span>Duration</span> : <span>From <?php echo $this->dayDate($attachmentRows[0]['dateStart']) ?> to <?php echo $this->dayDate($attachmentRows[0]['dateEnd']) ?></span></li>
                                            </ul>
                                            <?php
                                        }
                                        ?>
                                        <br>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <hr>
                        <br>


                        <div class="row" id="documents">
                            <span class="card-header -pb-4">My Documents</span>
                            <hr>

                            <div class="col-md-6" id="cv">
                                <span style="text-decoration: none" href="#!">
                                <div class="-card myhover -text-white text-center -bg-gradient-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Curriculum Vitae</div>
                                    <div class="card-body">

                                        <?php
                                        if($cvRows == NULL){
                                            ?>
                                            <div class="-dropdown">
                                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Curriculum Vitae
                                                </button>
                                                <div style="font-size: 13px" class="dropdown-menu border border-danger" aria-labelledby="dropdownMenuIconButton6">
                                                    <h6 class="dropdown-header badge badge-danger">Unavailable</h6>
                                                    <a class="dropdown-item" href="uploadDocument.php?document=cv"><span class="fa fa-upload"></span> Upload </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        else{
                                            ?>

                                            <div class="-dropdown">
                                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Curriculum Vitae
                                                </button>
                                                <div style="font-size: 13px" class="dropdown-menu border border-success" aria-labelledby="dropdownMenuIconButton6">
                                                    <h6 class="dropdown-header badge badge-success">Available</h6>
                                                    <a class="dropdown-item" href="<?php echo $cvRows[0]['file'] ?>" target="_blank"><span class="fa fa-download"></span> Download </a>
                                                    <a class="dropdown-item" href="uploadDocument.php?document=cv"><span class="fa fa-upload"></span> Update </a>
                                                    <a onclick="return confirm('This CV will be deleted. Proceed?')" class="dropdown-item" href="includes/deleteDocument.inc.php?document=cv"><span class="fa fa-trash"></span> Delete</a>
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
                            if($studentRow[0]['attachmentStatus'] == 1) {
                                ?>

                                <div class="col-md-6" id="attachmentReport">
                                <span style="text-decoration: none" href="#!">
                                <div class="-card myhover -text-white text-center -bg-gradient-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Attachment Report</div>
                                    <div class="card-body">
                                        <?php
                                        if($attachmentReportRows == NULL){
                                            ?>
                                            <div class="-dropdown">
                                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Attachment Report
                                                </button>
                                                <div style="font-size: 13px" class="dropdown-menu border border-danger" aria-labelledby="dropdownMenuIconButton6">
                                                    <h6 class="dropdown-header badge badge-danger">Unavailable</h6>
                                                    <a class="dropdown-item" href="uploadDocument.php?document=attRep"><span class="fa fa-upload"></span> Upload </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        else{
                                            ?>

                                            <div class="-dropdown">
                                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Attachment Report
                                                </button>
                                                <div style="font-size: 13px" class="dropdown-menu border border-success" aria-labelledby="dropdownMenuIconButton6">
                                                    <h6 class="dropdown-header badge badge-success">Available</h6>
                                                    <a class="dropdown-item" href="<?php echo $attachmentReportRows[0]['file'] ?>" target="_blank"><span class="fa fa-download"></span> Download </a>
                                                    <a class="dropdown-item" href="uploadDocument.php?document=attRep"><span class="fa fa-upload"></span> Update </a>
                                                    <a onclick="return confirm('This CV will be deleted. Proceed?')" class="dropdown-item" href="includes/deleteDocument.inc.php?document=attRep"><span class="fa fa-trash"></span> Delete</a>
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
                                <span style="text-decoration: none" href="#!">
                                <div class="-card myhover -text-white text-center -bg-gradient-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Assessment Report</div>
                                    <div class="card-body">
                                        <?php
                                        if($supervisorReportRows == NULL){
                                            ?>
                                            <div class="-dropdown">
                                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Assessment Report
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
                                                    Assessment Report
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
                                                    Logbook Report
                                                </button>
                                                <div style="font-size: 13px" class="dropdown-menu border border-danger" aria-labelledby="dropdownMenuIconButton6">
                                                    <h6 class="dropdown-header badge badge-danger">Unavailable</h6>
                                                    <a class="dropdown-item" href="uploadDocument.php?document=logb"><span class="fa fa-upload"></span> Upload </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        else{
                                            ?>

                                            <div class="-dropdown">
                                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Logbook Report
                                                </button>
                                                <div style="font-size: 13px" class="dropdown-menu border border-success" aria-labelledby="dropdownMenuIconButton6">
                                                    <h6 class="dropdown-header badge badge-success">Available</h6>
                                                    <a class="dropdown-item" href="<?php echo $logbookRows[0]['file'] ?>" target="_blank"><span class="fa fa-download"></span> Download </a>
                                                    <a class="dropdown-item" href="uploadDocument.php?document=logb"><span class="fa fa-upload"></span> Update </a>
                                                    <a onclick="return confirm('This CV will be deleted. Proceed?')" class="dropdown-item" href="includes/deleteDocument.inc.php?document=logb"><span class="fa fa-trash"></span> Delete</a>
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



                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    public function StudentViewChangePassword($id){
        $userRow = $this->GetUser($id);
        $studentRow = $this->GetStudentByID($id);
        ?>
        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row">
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/StudentUpdate.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Current Password</label>
                                    <input name="op" type="password" class="form-control" placeholder="Current Password" required>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">New Password</label>
                                    <input id="password" name="np" type="password" class="form-control" placeholder="New Password" onkeyup='check();' minlength="8" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Confirm New Password</label>
                                    <input id="confirmPassword" name="cp" type="password" class="form-control" placeholder="Confirm New Password" onkeyup='check();' minlength="8" required>
                                </div>
                            </div>

                            <script>
                                var check = function() {
                                    if (document.getElementById('password').value ==
                                        document.getElementById('confirmPassword').value) {
                                        document.getElementById('message').style.color = 'green';
                                        document.getElementById("save-btn").disabled = false;
                                        document.getElementById('message').innerHTML = '<div id="divDis" class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-success"><span class="fa fa-check-circle"></span>Password matched</div>';
                                    }
                                    else {
                                        document.getElementById('message').style.color = 'red';
                                        document.getElementById("save-btn").disabled = true;
                                        document.getElementById('message').innerHTML = '<div class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-danger"><span class="fa fa-exclamation-circle"></span>New Password not matching Confirm Password</div>';
                                    }


                                }
                            </script>

                            <div>

                                <span id='message'></span>

                            </div>


                            <div class="mt-5 text-center">
                                <button id="save-btn" name="btn_updatePassword" class="btn btn-primary" type="submit">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="profile.php" class="btn btn-dark align-items-center"> <span class="fa fa-user-edit"></span> Update Profile <span class="fa fa-arrow-right"></span></a>
                        <br>
                        <br>
                        <a href="#!" class="btn btn-warning align-items-center"> <span class="fa fa-exclamation-circle"></span> Deactivate Account</a>
                        <br>
                        <br>
                        <a href="#!" class="btn btn-danger align-items-center"> <span class="fa fa-exclamation-triangle"></span> Permanently Delete Account</a>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }

    public function aattachmentStatus($id)
    {
        $userRow = $this->GetUser($id);
        $studentRow = $this->GetStudentByID($id);
        ?>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Attachment Details</h4>
                    <p class="card-description">
                        <?php
                        $var = new StudentView();
                        $var->miniAttachmentDashboard($_SESSION['id']);
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }

    public function miniAttachmentDashboard($id){
        $userRow = $this->GetUser($id);
        $studentRow = $this->GetStudentByID($id);

        if($studentRow[0]['attachmentStatus'] != 1)
        {
            ?>
            <div class="nav-item dropdown -d-none -d-lg-block">
                <span class="badge badge-warning text-black" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Not Attached yet</span>

                <div class="">
                    <br>
                    <p class="mb-0 font-weight-medium float-left text-decoration-underline">
                        More options will appear below once you get attachment.
                    </p>

                    <div class="dropdown-divider"></div>
                    <a href="vacancies.php" class="dropdown-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Vacancies</p>
                            <p class="fw-light small-text mb-0">View and apply to available vacancies</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="cv.php" class="dropdown-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Curriculum Vitae</p>
                            <p class="fw-light small-text mb-0">Keep your CV up-to-date</p>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>
                </div>
            </div>
            <?php
        }
        else{
            $attachmentRows = $this->GetAttachmentsByUserID($id);
            $companyRows = $this->GetCompanyById($attachmentRows[0]['companyID']);
            ?>


            <div class="nav-item dropdown -d-none -d-lg-block">
                <span class="badge badge-primary text-black" -id="messageDropdown" -data-bs-toggle="dropdown" -aria-expanded="false"> Attached @ ...<a href="companyProfile.php?userID=<?php echo $attachmentRows[0]['companyID'] ?>"><?php echo $companyRows[0]['name'] ?> <span class="fa fa-arrow-right"></span></a> </span>

                <div class="">
                    <br>
                    <p class="mb-0 font-weight-medium float-left text-decoration-underline">
                        More options will appear below once you get attachment.
                    </p>

                    <div class="dropdown-divider"></div>
                    <a href="uploadDocument.php?document=logb" class="dropdown-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Logbook </p>
                            <p class="fw-light small-text mb-0">Upload and update your logbook</p>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="uploadDocument.php?document=attRep" class="dropdown-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Attachment Report/s</p>
                            <p class="fw-light small-text mb-0">your attachment report/s</p>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="uploadDocument.php?document=cv" class="dropdown-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Curriculum Vitae</p>
                            <p class="fw-light small-text mb-0">Keep your CV up-to-date</p>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="carrier.php" class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">More ...<span class="mdi mdi-chevron-double-right"></span> </p>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>
                </div>
            </div>

            <?php
        }
    }

    public function sexProfileImageView($id, $sex){
        $userRows = $this->isUser($id, $_SESSION['role']);

        if(!isset($_GET['setProfileImage'])){
            if($userRows[0]['avatar'] == ''){
                if($sex == 'MALE'){
                    ?>
                    <img class="rounded-circle mt-5" width="150px" src="../img/male.png">
                    <?php
                }
                elseif ($sex == 'FEMALE'){
                    ?>
                    <img class="rounded-circle mt-5" width="150px" src="../img/female.png">
                    <?php
                }
                else{
                    ?>
                    <img class="rounded-circle mt-5" width="150px" src="../img/user.png">
                    <?php
                }
            }
            else{
                ?>
                <img class="rounded-circle mt-5" width="150px" height="150px" src="<?php echo $userRows[0]['avatar'] ?>">
                <?php
            }
            ?>
            <div class="shadow-sm myhover">
                <a class="p-2" data-toggle="tooltip" data-placement="right" title="Update Profile Picture" href="?setProfileImage"><span class="fa fa-camera"></span></a>
                <a class="p-2 text-danger"onclick="return confirm('Are you sure you want to remove this picture?')"  data-toggle="tooltip" data-placement="right" title="Delete Profile Picture" href="includes/deleteProfilePicture.php"><span class="fa fa-trash"></span></a>
            </div>
            <?php
        }

        else{
            ?>
            <div class="animated--grow-in text-dark fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-success">
                <span class="animated--grow-in fadeout fa fa-info-circle"></span> Update Image Below
            </div>
            <form method="POST" action="includes/updateProfileImage.inc.php" enctype="multipart/form-data">
                <div>
                    <input type="file" name="profilePic" class="form-control" required>
                </div>
                <br>
                <div>
                    <a  onclick="history.back(-1)" class="btn btn-sm btn-outline-warning">Cancel <span class="fa fa-times"></span></a>
                    <button name="btn_ProfilePic" type="submit" class="btn btn-outline-primary"><span class="fa fa-camera"></span> Updload</button>
                </div>
            </form>
            <hr>
            <?php
        }
    }

    public function StudentViewProfile($id){
        $userRow = $this ->GetUser($id);
        $userRole = $this->isUser($id, $_SESSION['role']);
        ?>

        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                        <?php

                        $this->sexProfileImageView($id, $userRole[0]['sex']);

                        ?>

                        <span class="font-weight-bold"><?php echo $userRole[0]['name'] .' '. $userRole[0]['surname']   ?></span>
                        <span class="text-black-50"><?php echo $userRole[0]['email'] ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/StudentUpdate.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Reg-Number</label>
                                    <input name="regNumber" type="text" class="form-control" placeholder="first name" value="<?php echo $userRow[0]['loginID']  ?>" disabled>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRole[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRole[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone" type="text" class="form-control" placeholder="enter phone number" value="<?php echo $userRole[0]['phone'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Address Line 1</label>
                                    <input name="homeAddress" type="text" class="form-control" placeholder="enter address line 1" value="<?php echo $userRole[0]['homeAddress'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Address Line 2</label>
                                    <input name="postalAddress" type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $userRole[0]['postalAddress'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">State</label>
                                    <input name="country" type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $userRole[0]['nationality'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Email ID</label>
                                    <input name="email" type="text" class="form-control" placeholder="enter email id" value="<?php echo $userRole[0]['email'] ?>">
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="labels">Sex</label>
                                    <select name="sex" class="form-control">
                                        <?php
                                        $extraV = new ExtraViews();
                                        $extraV -> studentGender($_SESSION['id']);
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <?php
                                    $Date = date("Y-m-d");

                                    //71 YEARS MAXIMUM AGE

                                    $DOBMin =  date('Y-m-d', strtotime($Date. ' - 26206 days'));



                                    //15 YEARS OLD MINIMUM AGE

                                    $DOBMax =  date('Y-m-d', strtotime($Date. ' - 6117 days'));

                                    //ACCOUNT IS NOW CREATED
                                    ?>
                                    <label class="labels">Date Of Birth <b>(<?php echo $this->dateToDayMDY($userRole[0]['dob']) ?>)</b></label>
                                    <input name="dob" type="date" class="form-control" value="<?php echo $userRole[0]['dob'] ?>" placeholder="DOB" min="<?php echo $DOBMin ?>" max="<?php echo $DOBMax ?>"></div>
                            </div>
                            <div class="mt-5 text-center">
                                <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }













    public function accountOverview($id){
        //Student Dashboard Account Overview
        $userRow = $this ->GetUser($id);
        $studentRow = $this->GetStudentByID($id);

        ?>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Profile Details | <a style="font-size: 13px" href="profile.php"><span class="fa fa-pencil">update</span></a></h4>
                    <p class="card-description">
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <address>
                                <p class="fw-bold">Full Name</p>
                                <p>
                                    <?php echo $studentRow[0]['name'] .' '. $studentRow[0]['surname'] ?>
                                </p>
                                <hr>
                                <p class="fw-bold">Reg-Number</p>
                                <p>
                                    <?php echo $userRow[0]['loginID'] ?>
                                </p>
                                <hr>
                            </address>
                        </div>
                        <div class="col-md-6">
                            <address class="text-primary">
                                <p class="fw-bold">
                                    E-mail
                                </p>
                                <p class="mb-2">
                                    <?php echo $studentRow[0]['email'] ?>
                                </p>
                                <hr>
                                <p class="fw-bold">
                                    Phone
                                </p>
                                <p>
                                    <?php echo $studentRow[0]['phone'] ?>
                                </p>
                                <hr>
                                <p class="fw-bold">
                                    DOB
                                </p>
                                <p>
                                    <?php echo $this->dateToDay($studentRow[0]['dob']);  ?>
                                </p>

                            </address>

                        </div>
                    </div>
                </div>
            </div>
        </div>





        <?php
    }

    public function attachmentStatus($id){
        $userRow = $this ->GetUser($id);
        $studentRow = $this->GetStudentByID($id);
        ?>


        <?php
        if($studentRow[0]['attachmentStatus'] != 1)
        {
            ?>
            <li class="nav-item dropdown d-none d-lg-block">
                <a class="border border-warning nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Not Attached yet</a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                    <a href="#!" class="dropdown-item py-3 border border-bottom-dark " >
                        <p class="mb-0 font-weight-medium float-left">
                            More options will appear below once you get attachment
                        </p>
                    </a>
                    <a href="vacancies.php" class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Vacancies</p>
                            <p class="fw-light small-text mb-0">View and apply to available vacancies</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="uploadDocument.php?document=cv" class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Curriculum Vitae</p>
                            <p class="fw-light small-text mb-0">Keep your CV up-to-date</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
            <?php
        }

        else{
            ?>
            <li class="nav-item dropdown d-none d-lg-block">
                <a class="border border-success nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split text-primary" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Attached</a>
                <div class="border border-success dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                <span style="color: black" class="dropdown-item py-3 disabled" >
                    <p class="mb-0 font-weight-medium float-left">Work Related Learning Management</p>
                </span>
                    <div class="dropdown-divider"></div>
                    <a href="uploadDocument.php?document=logb"  class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Logbook </p>
                            <p class="fw-light small-text mb-0">Upload and update your logbook</p>
                        </div>
                    </a>
                    <a href="uploadDocument.php?document=attRep" class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Attachment Report/s</p>
                            <p class="fw-light small-text mb-0">your attachment report/s</p>
                        </div>
                    </a>
                    <a href="uploadDocument.php?document=cv" class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Curriculum Vitae</p>
                            <p class="fw-light small-text mb-0">Keep your CV up-to-date</p>
                        </div>
                    </a>
                    <a href="carrier.php" class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">More ...<span class="mdi mdi-chevron-double-right"></span> </p>
                        </div>
                    </a>
                </div>
            </li>
            <?php
        }
        ?>
        <?php
    }



}

?>