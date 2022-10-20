<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog -modal-full -modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="includes/addCategory.inc.php">
                <div class="modal-body">

                    <div class="form-group col-md-8">
                        <label for="inputEmail4" class="col-form-label">Category Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Name of the new category" pattern=".{4,20}" required title="5 to 20 characters">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4" -class="col-form-label">Short Category Description</label>
                            <textarea name="description" placeholder="short category description..." style="height: 150px" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button name="btn_addCategory" type="submit"  class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>