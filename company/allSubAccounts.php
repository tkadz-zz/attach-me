<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
?>


<div class="container mt-4 mb-4">
    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<br>
<br>
    <a href="#!"  data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-outline-primary">New Sub-Account <span class="fa fa-user-plus"></span> </a>
    <a href="departments.php" class="btn btn-outline-primary">Department <span class="fa fa-list"></span> </a>

    <div id="--printableArea" class="card-box">
        <h4 class="mt-0 header-title"></h4>
        <p class="text-muted font-14 mb-3">
            Showing all attached students
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
            $n = new CompanyView();
            $n->viewAllCompanySubAcc($_SESSION['id']);
            ?>
            </tbody>


        </table>
    </div>


</div>









<?php
include 'includes/emptyLayoutBottom.inc.php';
?>


<!-- Add Department Modal -->
<div class="modal fade" id="addDept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog --modal-full --modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $_SESSION['name'] ?>'s New Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="includes/addSubAcc.inc.php">
                <div class="modal-body">
                    <div class="form-row row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4" class="col-form-label">Department Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Department Name..." required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button name="btn_addDept" type="submit"  class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Add SubAcc Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $_SESSION['name'] ?>'s New Sub-Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="includes/addSubAcc.inc.php">
                <div class="modal-body">
                    <div class="form-row row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4" class="col-form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="User First Name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label  class="col-form-label">Surname</label>
                            <input name="surname" type="text" class="form-control" placeholder="User Surname" value="" -pattern=".{5,12}" required -title="5 to 12 characters" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4" class="col-form-label">Account Type</label>
                            <select class="form-control form-select" name="sex" required>
                                <option value="">-- SELECT GENDER --</option>
                                <option value="MALE">Male</option>
                                <option value="FEMALE">Female</option>
                                <option value="PRIVATE">Not Sure</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="col-form-label">Department</label>
                            <select class="form-control form-select" name="dept" required>
                                <option value="">-- SELECT DEPARTMENT  --</option>
                                <?php
                                $n = new CompanyView();
                                $n->ViewCompanyDeptLoop($_SESSION['id']);
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="col-form-label">Account Type</label>
                            <select class="form-control form-select" name="subRole" required>
                                <option value="">-- SELECT USER ROLE --</option>
                                    <option value="admin">Admin Account</option>
                                    <option value="adminSupervisor">Supervisor(Admin) Account</option>
                                    <option value="supervisor">Supervisor Account</option>
                            </select>
                        </div>
                    </div>


                    <div class="container px-0">
                        <div class="pp-gallery">
                            <div class="-card-columns">
                                <div class="alert alert-info text-dark" role="alert">
                                    <span class="fa fa-lock"></span> Password will be set on the user's first login attempt
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button name="btn_addUser" type="submit"  class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
