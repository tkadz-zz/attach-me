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
    <a href="#!"  data-bs-toggle="modal" data-bs-target="#addDept" class="btn btn-outline-primary">New Department <span class="fa fa-plus"></span> </a>

    <div id="--printableArea" class="card-box">
        <h4 class="mt-0 header-title"></h4>
        <p class="text-muted font-14 mb-3">
            Showing all departments
        </p>
        <hr>
        <table id="datatable" class="table table-bordered dt-responsive nowrap">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Accounts</th>
                <th>Date Added</th>
                <th>More</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $n = new CompanyView();
            $n->viewCompanyDept($_SESSION['id']);
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

