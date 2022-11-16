<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
?>

<div class="container mt-4 mb-4">
    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
    <br>
    <br>
    <a href="#!"  data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-outline-primary">Create New Account <span class="fa fa-user-plus"></span> </a>
    <div id="--printableArea" class="card-box">
        <h4 class="mt-0 header-title"></h4>
        <p class="text-muted font-14 mb-3">
            Showing all User Accounts
        </p>
        <hr>
        <table id="datatable" class="table table-bordered dt-responsive nowrap">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Account Type</th>
                <th>More</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $n = new AdminView();
            $n->ViewAllUsers();
            ?>
            </tbody>


        </table>
    </div>


</div>




<!-- Add SubAcc Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $_SESSION['name'] ?>'s New Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="includes/account.inc.php">
                <div class="modal-body">
                    <div class="form-row row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4" class="col-form-label">LoginID</label>
                            <input name="loginID" type="text" class="form-control" placeholder="LoginID..." required>
                        </div>
                    </div>
                    <div class="form-row row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4" class="col-form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Account Name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4" class="col-form-label">Type</label>
                            <select class="form-control form-select" name="type" required>
                                <option value="">-- SELECT ACCOUNT TYPE --</option>
                                <option value="institute">INSTITUTE</option>
                                <option value="company">COMPANY</option>
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
                    <button name="btn_addUser" type="submit"  class="btn btn-primary">Create <span class="fa fa-check"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>






<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
