<?php

class CompanyView extends Users
{

    public function companyViewProfile($id){
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
                    <br>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    public function viewAllCompanyVacancyCategoriesLoopTable($id){
        $rows = $this->GetAllVacancyCategorysByCompanyID($id);
        $s = 0;

        foreach ($rows as $row){
            $s++;
            $subRows = $this->GetSubAccByCompanyAndUserID($id, $row['subID']);
            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <td><?php echo $row['category'] ?></td>
                <td><?php echo $subRows[0]['name'] .' '. $subRows[0]['surname'] ?></td>
                <td><?php echo $this->dateToDay($rows[0]['addedOn']) ?></td>
                <td><a href=""><span class="fa fa-pencil"></span> </a></td>
            </tr>
            <?php
        }
    }

    public function viewAllCompanyVacancyLoopTable($id){
        $rows = $this->GetAllVacancyByCompanyID($id);
        $s = 0;

        foreach ($rows as $row){
            $s++;
            $vCateg = $this->GetCategoryByID($row['cartegory']);

            if($row['expiryDate'] > date('Y-m-d')){
                $borderClass = 'success';
            }
            else{
                $borderClass = 'danger';
            }
            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $vCateg[0]['category'] ?></td>
                <td><?php echo $this->dayDate($row['datePosted']) ?></td>
                <td><?php echo $this->dayDate($row['dateOnline']) ?></td>
                <td class="alert alert-<?php echo $borderClass ?>"><?php echo $this->dayDate($row['expiryDate']) ?></td>
                <td><a href="vacancySummery.php?vuid=<?php echo $row['uniqueID'] ?>"><span class="fa fa-pencil"></span> </a></td>
            </tr>
            <?php
        }
    }

    public function viewVacancySummery($vuid){
        $rows = $this->GetVacancyByUniqueID($vuid);
        $categoryRows = $this->GetCategoryByID($rows[0]['cartegory']);
        if($rows[0]['expiryDate'] > date('Y-m-d')){
            $borderClass = 'success';
            $msg = 'Not Expired';
        }
        else{
            $borderClass = 'danger';
            $msg = 'Expired';
        }

        ?>
        <div class="col-md-12">
            <div class="card border border-<?php echo $borderClass ?> border-3">
                <div class="card-body">
                    <h4 class="card-title card-header">Vacancy Detailed Summery <span class="badge badge-<?php echo $borderClass ?> border rounded <?php echo $borderClass ?>"><?php echo $msg ?></span> </h4>
                    <p class="card-description">
                        The following are the vacancy details
                        <?php
                        if($rows[0]['expiryDate'] > date('Y-m-d')){
                        ?>
                    <div class="btn btn-outline-success btn-sm rounded text-decoration-none" data-href="postVacancyFinal.php?vuid=<?php echo $vuid ?>" data-layout="button" data-size="large"><a href="postVacancyFinal.php?vuid=<?php echo $vuid ?>" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Edit <span class="fa fa-pencil"></span> </a></div>
                    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-href="http://localhost/AttachMe/student/vacancy.php?vuid=<?php echo $vuid ?>" data-layout="button" data-size="large"><a target="_blank" href="http://localhost/AttachMe/student/vacancy.php?vuid=<?php echo $vuid ?>" class="fb-xfbml-parse-ignore">Share <span class="fa fa-share"></span> </a></div>
                    <?php
                    }
                    ?>

                    <div onclick="return confirm('You are about to delete this Vacancy. Proceed?')" class="btn btn-outline-danger btn-sm rounded text-decoration-none" data-href="http://localhost/AttachMe/student/vacancy.php?vuid=<?php echo $vuid ?>" data-layout="button" data-size="large"><a target="_blank" href="http://localhost/AttachMe/student/vacancy.php?vuid=<?php echo $vuid ?>" class="fb-xfbml-parse-ignore"><span class="fa fa-trash"></span> Delete </a></div>
                    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-href="allVacancies.php" data-layout="button" data-size="large"><a href="allVacancies.php" class="fb-xfbml-parse-ignore">Home <span class="fa fa-home"></span> </a></div>
                    </p>

                    <ul>
                        <?php
                        $addDetRow = $this->GetCompanyById($_SESSION['id']);
                        ?>
                        <li>Company Name: <?php echo $_SESSION['name'] ?></li>
                        <li>Company Mail: <?php echo $_SESSION['email'] ?></li>
                        <li>Company Cell: <?php echo $addDetRow[0]['phone'] ?></li>
                        <li>Company Address: <?php echo $addDetRow[0]['address'] ?></li>
                    </ul>
                    <hr>
                    <ul>
                        <?php
                        $addDetRow = $this->GetCompanyById($_SESSION['id']);
                        ?>
                        <li>Vacancy Title: <?php echo $rows[0]['title'] ?></li>
                        <li>Vacancy Category: <?php echo $categoryRows[0]['category'] ?></li>
                        <br>
                        <li><span class="fa fa-circle-o text-primary"></span> Posted On: <?php echo $this->dateToDay($rows[0]['datePosted']) ?> (<?php echo $this->timeAgo($rows[0]['datePosted']) ?>)</li>
                        <li><span class="fa fa-circle-o text-success"></span> Online Date: <?php echo $this->dateToDay($rows[0]['dateOnline']) ?></li>
                        <li><span class="fa fa-circle-o text-danger"></span> Expiry Date: <?php echo $this->dateToDay($rows[0]['expiryDate'])?></li>
                        <br>
                        <li><u>Description</u>: <br><?php echo $rows[0]['body'] ?></li>
                        <br>
                        <li>Qualifications:<br>
                            <?php
                            $this->viewQualificationsloopNoDelete($vuid);
                            ?>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <?php
    }

    public function viewQualificationsloopNoDelete($id){
        $rows = $this->getQualificationsByVacancyID($id);
        if($rows != NULL){
            foreach ($rows as $row){
                ?>
                <div -id="divDis" -class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-info">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <span class="text-dark">
                        <span class="animated--grow-in fadeout fa fa-arrow-circle-right text-dark"></span> <?php echo $row['qualification'] ?>
                    </span>
                </div>
                <?php
            }
        }
    }

    public function viewQualificationsloop($id){
        $rows = $this->getQualificationsByVacancyID($id);
        if($rows != NULL){
            foreach ($rows as $row){
                ?>
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-info">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <span class="text-dark">
                        <span class="animated--grow-in fadeout fa fa-arrow-circle-right text-dark"></span> <?php echo $row['qualification'] ?>
                    </span>
                    <a style="float: right; color: firebrick; font-size:15px" onclick="return confirm('Are you sure you want to proceed removing this qualification?')" href="includes/deleteVacancyQualification.inc.php?id=<?php echo $row['id'] ?>&vuid=<?php echo $id ?>" class="closebtn" data-bs-dismiss="toast" aria-label="Close">
                        <span class="fa fa-trash"></span>
                    </a>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
                <div class="closebtn">
                    <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                </div>
                <span class="text-dark">
                    <span class="animated--grow-in fadeout fa fa-info-circle text-dark"></span> Added Qualifications will appear here
                </span>
            </div>
            <?php
        }

    }

    public function viewVacancyFinal($uniqueID){
        $rows = $this->GetVacancyByUniqueID($uniqueID);
        ?>
        <div class="row">
            <div class="col-md-6 p-3 -grid-margin -stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title card-header">Qualifications</h4>
                        <p class="card-description">
                            Provide qualifications needed for this vacancy
                        </p>
                        <div>
                            <form class="forms-sample" method="POST" action="includes/postQualification.inc.php">
                                <div class="input-group col-xs-12">
                                    <input type="text" name="qualification" class="form-control" placeholder="e.g 5 O'level passes including Maths and English">
                                    <input type="text" name="vacancyID" value="<?php echo $_GET['vuid'] ?>" hidden>
                                    <span class="input-group-append">
                                  <input class="btn btn-outline-success btn-sm rounded" name="btn_post_vacancyQualification" type="submit" value="Add">
                                </span>
                                </div>
                            </form>
                        </div>
                        <span class="sidebar-dark text-primary"><hr></span>


                        <div>
                            <?php
                            $this->viewQualificationsloop($_GET['vuid']);
                            ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4 p-3 -grid-margin -stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title card-header">Vacancy Post Date</h4>
                        <?php
                        if($rows[0]['dateOnline'] != '')
                        {

                            ?>
                            <div class="card-description">
                                <p class="card-description">Vacancy set to become online on : <?php echo $this->dateToDay($rows[0]['dateOnline']) ?> </p>


                                <button onclick="myFunction()" type="button" class="btn btn-secondary"> <span class="fa fa-chevron-circle-down">Update online date</span></button>
                                <div style="display: none" id="myDIV" class="shadow-sm p-3 rounded">
                                    <form method="POST" action="includes/postVacancyOnlineDate.inc.php?vuid=<?php echo $uniqueID ?>">
                                        <input class="form-control" value="<?php echo $rows[0]['dateOnline'] ?>" min="<?php echo date('Y-m-d') ?>" max="<?php echo $rows[0]['expiryDate'] ?>" name="onlineDate" type="date" required>
                                        <br>
                                        <input name="btn_post_online_date" type="submit" value="update" class="btn btn-primary btn-sm rounded">
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

                            </div>
                            <?php
                        }
                        else{
                            ?>
                            <div class="card-description">
                                <p class="card-description">The vacancy will become online on the provied date</p>
                                <div class="shadow-sm p-3 rounded">
                                    <form method="POST" action="includes/postVacancyOnlineDate.inc.php?vuid=<?php echo $uniqueID ?>">
                                        <input class="form-control" name="onlineDate" type="date" min="<?php echo date('Y-m-d') ?>" max="<?php echo $rows[0]['expiryDate'] ?>" required>
                                        <br>
                                        <input name="btn_post_online_date" type="submit" value="set" class="btn btn-primary btn-sm rounded">
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-2 p-3 -grid-margin -stretch-card">
                <div class="card">
                    <div class="card-body">
                        <span class="card-description">Press finish to finilise</span>
                        <hr>
                        <form method="POST" action="includes/postVacancyOnlineDate.inc.php?vuid=<?php echo $uniqueID ?>">
                            <button name="btn_finish" type="submit" class="btn btn-primary ">FINISH <span class="fa fa-chevron-circle-right"></span> </button>
                        </form>
                    </div>
                </div>
            </div>



        </div>
        <?php
    }

    public function PostVacancyView(){
        $str=rand();
        $result = md5($str);
        ?>

        <div class="col-md-8 -pt-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Post a new Vacancy <span style="font-size: 10px" class="h6">(<i><?php echo $result ?></i>)</span></h4>
                    <p class="card-description">
                        Provide the required details below for a new vacancy
                    </p>
                    <form class="forms-sample" method="POST" action="includes/postVacancy.inc.php">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Vacancy Title</label>
                            <input name="Vtitle" type="text" class="form-control" id="exampleInputUsername1" placeholder="Vacancy Title..." required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputUsername1">Vacancy Location</label>
                                    <input name="Vlocation" type="text" class="form-control" id="exampleInputUsername1" placeholder="Vacancy Location..."required>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputUsername1">Vacancy Expiry Date</label>
                                    <input name="VexpDate" type="date" class="form-control" id="exampleInputUsername1" placeholder="Vacancy Expiry Date..." min="<?php echo date('Y-m-d', strtotime("+1 day")) ?>" required>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Vacancy Category</label>
                            <select name="Vcategory" class="js-example-basic-single w-100 form-control" required>
                                <?php
                                //for active vacancy status=1
                                $status=1;
                                $vacCateg = new DBTableloopsView();
                                $vacCateg->VacancyCategoryLoopView($_SESSION['id']);
                                ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="exampleInputConfirmPassword1">Vacancy Body</label>
                            <textarea name="Vbody" minlength="15" class="form-control" style="height: 200px" placeholder="What is this Vacant about..." required></textarea>
                        </div>

                        <div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="postOnlineDate" id="optionsRadios2" value="<?php echo date('Y-m-d') ?>" checked>
                                    Post Now
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="postOnlineDate" id="optionsRadios1" value="">
                                    Post on specific date(post date will be set on the next step)
                                </label>
                            </div>
                        </div>

                        <input type="text" name="randomSTR" hidden value="<?php echo $result ?>">

                        <button name="btn_post_vacancy" type="submit" class="btn btn-primary me-2">Step 1/2 <span class="fa fa-chevron-circle-right"></span> </button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Additional Details</h4>
                    <p class="card-description">
                        The following details are auto-filled for you
                    </p>

                    <ul>
                        <?php
                        $addDetRow = $this->GetCompanyById($_SESSION['id']);
                        ?>
                        <li>Company Name: <?php echo $_SESSION['name'] ?></li>
                        <li>Company Mail: <?php echo $_SESSION['email'] ?></li>
                        <li>Company Cell: <?php echo $addDetRow[0]['phone'] ?></li>
                        <li>Company Address: <?php echo $addDetRow[0]['address'] ?></li>
                    </ul>

                </div>
            </div>
        </div>

        <?php
    }

    public function SubCompanyViewChangePassword($id){
        ?>
        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row">
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/companyUpdate.inc.php" >
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

}