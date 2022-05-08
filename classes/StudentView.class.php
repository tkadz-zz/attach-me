<?php

class StudentView extends Users
{

    public function StudentViewCarrier($id){
        $userRow = $this->GetUser($id);
        $studentRow = $this->GetStudentByID($id);
        ?>

        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_rocket.svg">
                        <span class="font-weight-bold"><?php echo $studentRow[0]['name'] .' '. $studentRow[0]['surname']   ?></span>
                        <span class="text-black-50"><?php echo $studentRow[0]['email'] ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">My Carrier</h4>

                        </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels text-decoration-underline">Institute</label>
                                    <p>My school</p>
                                    <p><a href="#!">{Schoolname} Resorces <span class="fa fa-external-link"></span></a></p>
                                </div>
                            </div>
                        <hr>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels text-decoration-underline">Program/Course</label>
                                    <p>My own proram</p>
                                </div>
                            </div>
                        <hr>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels text-decoration-underline">Company Attached</label>
                                    <p>My company</p>
                                </div>
                            </div>
                        <hr>


                        <div class="row">
                            <div class="col-md-5">
                                <div class="card -text-white text-center -bg-gradient-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Curriculum Vitae</div>
                                    <div class="card-body">
                                        <h6 class="badge-danger rounded">Unavailable <span class="fa fa-exclamation"></span></h6>
                                        <p class="-card-text text-center"><a class="mdi mdi-upload text-decoration-none" href="#!"> Upload</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="card -text-white text-center -bg-gradient-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Attachment Report</div>
                                    <div class="card-body">
                                        <h6 class="badge-success rounded">Uploaded <span class="fa fa-check"></h6>
                                        <p class="-card-text text-center"><a class="mdi mdi-eye-outline text-decoration-none" href="#!"> View</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="card -text-white text-center -bg-gradient-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Assesment Report</div>
                                    <div class="card-body">
                                        <h6 class="badge-danger rounded">Unavailable <span class="fa fa-exclamation"></span></h6>
                                        <p class="-card-text text-center"><a class="mdi mdi-upload text-decoration-none" href="#!"> Upload</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="card -text-white text-center -bg-gradient-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Logbook Report</div>
                                    <div class="card-body">
                                        <h6 class="badge-success rounded">Uploaded <span class="fa fa-check"></h6>
                                        <p class="-card-text text-center"><a class="mdi mdi-eye text-decoration-none" href="#!"> View</a> | <a class="mdi mdi-update" href="#!"> Update</a> </p>
                                    </div>
                                </div>
                            </div>

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
                    <h4 class="card-title">Attachment Details</h4>
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
                    <a href="cv.php" class="dropdown-item">
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
            ?>


            <div class="nav-item dropdown -d-none -d-lg-block">
                <span class="badge badge-primary text-black" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Attached @ ...<a href="#!">company name <span class="fa fa-arrow-right"></span></a> </span>

                <div class="">
                    <br>
                    <p class="mb-0 font-weight-medium float-left text-decoration-underline">
                        More options will appear below once you get attachment.
                    </p>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Logbook </p>
                            <p class="fw-light small-text mb-0">Upload and update your logbook</p>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Attachment Report/s</p>
                            <p class="fw-light small-text mb-0">your attachment report/s</p>
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
                    <a href="#!" class="dropdown-item preview-item">
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



    public function StudentViewProfile($id){
        $userRow = $this ->GetUser($id);
        $studentRow = $this->GetStudentByID($id);
        ?>

        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $studentRow[0]['name'] .' '. $studentRow[0]['surname']   ?></span>
                        <span class="text-black-50"><?php echo $studentRow[0]['email'] ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>

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
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $studentRow[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $studentRow[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone" type="text" class="form-control" placeholder="enter phone number" value="<?php echo $studentRow[0]['phone'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Address Line 1</label>
                                    <input name="homeAddress" type="text" class="form-control" placeholder="enter address line 1" value="<?php echo $studentRow[0]['homeAddress'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Address Line 2</label>
                                    <input name="postalAddress" type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $studentRow[0]['postalAddress'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">State</label>
                                    <input name="country" type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $studentRow[0]['nationality'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Email ID</label>
                                    <input name="email" type="text" class="form-control" placeholder="enter email id" value="<?php echo $studentRow[0]['email'] ?>">
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
                                    <label class="labels">Date Of Birth</label>
                                    <input name="dob" type="date" class="form-control" value="<?php echo $studentRow[0]['dob'] ?>" placeholder="DOB" min="<?php echo $DOBMin ?>" max="<?php echo $DOBMax ?>"></div>
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













    public function accountOverview($id){
        //Student Dashboard Account Overview
        $userRow = $this ->GetUser($id);
        $studentRow = $this->GetStudentByID($id);

        ?>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profile Details | <a style="font-size: 13px" href="profile.php"><span class="fa fa-pencil">update</span></a></h4>
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
                                    <?php echo $studentRow[0]['phone'] ?>
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
                    <a href="#!" class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Vacancies</p>
                            <p class="fw-light small-text mb-0">View and apply to available vacancies</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="cv.php" class="dropdown-item preview-item">
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
                    <a class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Logbook </p>
                            <p class="fw-light small-text mb-0">Upload and update your logbook</p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Attachment Report/s</p>
                            <p class="fw-light small-text mb-0">your attachment report/s</p>
                        </div>
                    </a>
                    <a href="cv.php" class="dropdown-item preview-item">
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark"><span class="mdi mdi-book-open-page-variant"></span> Curriculum Vitae</p>
                            <p class="fw-light small-text mb-0">Keep your CV up-to-date</p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
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