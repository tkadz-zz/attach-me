<?php

class Userview extends Users
{


    public function attachmentHistory($id){
        $rows = $this->GetAttachmentHistoryByUserID($id);
        $studentRows = $this->GetStudentByID($id);
        if(count($rows) > 0){
            $s=0;
            foreach ($rows as $row){
                $s++;
                $companyRows = $this->GetCompanyByUserID($row['companyID']);

            ?>
                <div class="col-md-12 -card pb-4"><span class="badge badge-success"><?php echo $s ?></span>
                    <div class="card border border-success border-2" style="font-size: 13px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div -class="alert alert-info text-dark" role="alert">
                                        <b class="">COMPANY NAME: </b> <a href="companyProfile.php?userID=<?php echo $row['companyID'] ?>"><?php echo $companyRows[0]['name'] ?></a>
                                        <hr>
                                        <b class="">FROM: </b> <?php echo $this->dayDate($row['started']) ?> <b class="">TO: </b> <?php echo $this->dayDate($row['ended']) ?>
                                        <hr>
                                        <b class="">DISMISSED ON: </b> <?php echo $this->dayDate($row['ended']) ?> (<?php echo $this->timeAgo($row['ended']) ?>)
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div -class="alert alert-info text-dark" role="alert">
                                        <b class="">LOGBOOK: </b>
                                        <?php
                                        if($row['logbook'] != ''){
                                            ?>
                                            <a href="<?php echo $row['logbook'] ?>">Download <span class="fa fa-download"></span></a>
                                            <?php
                                        }
                                        else{
                                            echo 'Not Available';
                                        }
                                        ?>
                                        <hr>
                                        <b class="">ATTACHMENT REPORT: </b>
                                        <?php
                                        if($row['attachmentReport'] != ''){
                                            ?>
                                            <a href="<?php echo $row['attachmentReport'] ?>">Download <span class="fa fa-download"></span></a>
                                            <?php
                                        }
                                        else{
                                            echo 'Not Available';
                                        }
                                        ?>
                                        <hr>
                                        <b class="">ASSESSMENT REPORT: </b>
                                        <?php
                                        if($row['supervisorReport'] != ''){
                                            ?>
                                            <a href="<?php echo $row['supervisorReport'] ?>">Download <span class="fa fa-download"></span></a>
                                            <?php
                                        }
                                        else{
                                            echo 'Not Available';
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
        }
        else{
            //no data found
            ?>
                <div class="col-md-12 pb-4">
                    <div class="card border border-warning" style="font-size: 13px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-dark">
                                        <span></span>No attachment records found<br><br>
                                    </div>
                                    <div>Student
                                        <?php
                                        if($studentRows != NULL){
                                            echo $studentRows[0]['name'] .' '. $studentRows[0]['surname'];
                                        }
                                        ?> has not been attached/dismissed at any company yet.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
        }
    }

    public function viewCompanyInstituteProfile($id){
        if($_SESSION['role'] == 'company'){
            $userRole = $this->GetCompanyByUserID($id);
            $nm = 'Company';
        }
        if($_SESSION['role'] == 'institute'){
            $userRole = $this->GetInstituteByUserID($id);
            $nm = 'Institute';
        }
        $row = $this->GetUser($id);
        ?>
        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <span class="font-weight-bold"><?php echo $userRole[0]['name']  ?></span>
                        <span class="text-black-50"><?php echo $userRole[0]['email'] ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header"><?php echo $nm ?>'s Profile</h4>

                        </div>
                        <form method="post" action="includes/<?php echo $nm ?>ProfileUpdate.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6 pb-2">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="Company LoginID" value="<?php echo $row[0]['loginID']  ?>" required minlength="6">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6 pb-2">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="Company Name..." value="<?php echo $userRole[0]['name'] ?>" required minlength="3">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 pb-2">
                                    <label class="labels">Email</label>
                                    <input name="email" type="email" class="form-control" placeholder="enter company email address" value="<?php echo $userRole[0]['email'] ?>">
                                </div>
                                <div class="col-md-12 pb-2">
                                    <label class="labels">Phone Number</label>
                                    <input name="phone" type="text" class="form-control" placeholder="enter company's phone number" value="<?php echo $userRole[0]['phone'] ?>">
                                </div>
                                <div class="col-md-12 pb-2">
                                    <label class="labels">Address</label>
                                    <input name="address" type="text" class="form-control" placeholder="enter company address" value="<?php echo $userRole[0]['address'] ?>">
                                </div>
                                <div class="col-md-12 pb-2">
                                    <label class="labels">Website Address</label>
                                    <input name="website" type="url" class="form-control" placeholder="https://domain.something" value="<?php echo $userRole[0]['website'] ?>">
                                </div>
                            </div>


                            <div class="mt-5 text-center">
                                <button name="btn_updateProfile_CI" class="btn btn-primary" type="submit">Save Profile</button>
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
                        <a href="password.php?main=acc" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change <?php echo $nm ?> Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }


    public function viewCompanyProfile($id){
        $companyRows = $this->GetCompanyByUserID($id);
        if(count($companyRows) > 0){
            ?>
            <div class="col-md-12">
                <div class="card border border-dark border-3">
                    <div class="card-body">
                        <h4 class="card-title card-header"><?php echo $companyRows[0]['name'] ?></h4>
                        <div>
                            <p class="card-description">The following are the details of <?php echo $companyRows[0]['name'] ?></p>
                        </div>
                        <div class="row">
                            <div class="col-md-4" style="font-size: 15px">
                                <li><span>Email</span> : <span><a href="mail:<?php echo $companyRows[0]['email'] ?>"><?php echo $companyRows[0]['email'] ?></a></span></li>
                                <li><span>Website</span> : <span><a target="_blank" href="<?php echo $companyRows[0]['website'] ?>"><?php echo $companyRows[0]['website'] ?></a></span></li>
                                <li><span>Phone</span> : <span><a href="tel:<?php echo $companyRows[0]['phone'] ?>"><?php echo $companyRows[0]['phone'] ?></a></span></li>
                                <li><span>Address</span> : <span><?php echo $companyRows[0]['address'] ?></span></li>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        else{
            ?>
            <div class="container px-0">
                <div class="pp-gallery">
                    <div class="-card-columns">
                        <div class="alert alert-warning text-dark" role="alert">
                            <span class="mdi mdi-information-outline"></span> Institute Account Not Found <br><br>
                            Something went wrong
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    public function viewInstituteProfile($id){
        $instituteRows = $this->GetInstituteByUserID($id);
        if(count($instituteRows) > 0){
        ?>
        <div class="col-md-12">
            <div class="card border border-dark border-3">
                <div class="card-body">
                    <h4 class="card-title card-header"><?php echo $instituteRows[0]['name'] ?></h4>
                    <div>
                        <p class="card-description">The following are the details of <?php echo $instituteRows[0]['name'] ?></p>
                    </div>
                    <div class="row">
                        <div class="col-md-4" style="font-size: 15px">
                            <li><span>Email</span> : <span><a href="mail:<?php echo $instituteRows[0]['email'] ?>"><?php echo $instituteRows[0]['email'] ?></a></span></li>
                            <li><span>Website</span> : <span><a target="_blank" href="<?php echo $instituteRows[0]['website'] ?>"><?php echo $instituteRows[0]['website'] ?></a></span></li>
                            <li><span>Phone</span> : <span><a href="tel:<?php echo $instituteRows[0]['phone'] ?>"><?php echo $instituteRows[0]['phone'] ?></a></span></li>
                            <li><span>Address</span> : <span><?php echo $instituteRows[0]['address'] ?></span></li>
                            <br>
                        </div>
                        <div class="col-md-4" style="font-size: 15px">
                            <?php
                            if($_SESSION['role'] == 'student'){
                                ?>
                                    <label>Report WRL problems: </label><br>
                                <a href="#!" onclick="return alert('This section is still inder maintenance')" class="btn btn-outline-warning btn-sm">Report <span class="fa fa-send"></span></a>
                                <hr>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!--
            <div class="col-md-6">
                <div class="-card -border -border-dark border-3">
                    <div class="card-body">
                        <h4 class="card-title card-header"><?php echo $instituteRows[0]['name'] ?>'s Resources</h4>
                        <div>
                            <p class="card-description">Documents that may help you</p>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="font-size: 15px">
                                <span><span class="fa fa-file"></span> : <span><a href="mail:<?php echo 'fileLocation' ?>"><?php echo 'file name here' ?> <span class="fa fa-download"></span></a></span></span>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->
        <?php
        }
        else{
            ?>
            <div class="container px-0">
                <div class="pp-gallery">
                    <div class="-card-columns">
                        <div class="alert alert-warning text-dark" role="alert">
                            <span class="mdi mdi-information-outline"></span> Institute Account Not Found <br><br>
                            Something went wrong
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    public function subUserViewProfile($id){
        $userRole = $this->isUser($id, $_SESSION['role']);
        ?>
        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                        <?php

                        $n = new StudentView();
                        $n->sexProfileImageView($id, $userRole[0]['sex']);

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
                        <form method="post" action="includes/subAccProfileUpdate.inc.php" >
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
                                    <label class="labels">Mobile Number (<span>07** *** ***</span>) </label>
                                    <input name="phone" type="number" max="0799999999" min="0700000000" class="form-control" placeholder="enter phone number" value="<?php echo $userRole[0]['phone'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Email ID</label>
                                    <input name="email" type="email" class="form-control" placeholder="enter email" value="<?php echo $userRole[0]['email'] ?>">
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="labels">Sex</label>
                                    <select name="sex" class="form-control">
                                        <?php
                                        $extraV = new ExtraViews();
                                        $extraV->studentGender($_SESSION['subID']);
                                        ?>
                                    </select>
                                </div>
                                <div class="mt-5 text-center">
                                    <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>Additional Settings</span>
                    </div>
                    <hr>
                    <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                    <?php
                    if($_SESSION['subRole'] == 'admin'){
                        if($_SESSION['role'] == 'company'){
                            $nm = 'Company';
                        }
                        if($_SESSION['role'] == 'institute'){
                            $nm = 'Institute';
                        }
                        ?>
                        <hr>
                        <a href="profile<?php echo $nm ?>.php" class="btn btn-outline-primary align-items-center"> <span class="fa fa-building"></span> <?php echo $nm ?> Profile Details <span class="fa fa-arrow-right"></span></a>
                        <?php
                    }
                    ?>
                    <br>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    public function ShowInstitutes(){

        $rows = $this->GetAllInstitutes();
        $s = 0;

        foreach ($rows as $row){
            $s++;
            ?>
            <option value="<?php echo $row['userID'] ?>"><?php echo $s .'. '. $row['name'] ?></option>
            <?php
        }
    }

    public function ShowPrograms(){
        $rows = parent::ShowPrograms();
        $s = 0;
        foreach ($rows as $row){
            $s++;

            ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $s .'. '. $row['name'] ?></option>
            <?php
        }
    }


}