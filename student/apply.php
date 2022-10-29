<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>




<h4 class="pt-3">Vacancy Application</h4>
<br>
<div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
<br>
<br>





<?php
if(isset($_GET['vuid'])) {
    $n = new StudentView();
    $n->viewApplyForm($_GET['vuid']);
}
else{
    ?>
    <div class="container px-0">
        <div class="pp-gallery">
            <div class="-card-columns">
                <div class="alert alert-info text-dark" role="alert">
                    <span class="mdi mdi-information-outline"></span>Sorry! we could not find any data related to the link provided. Make sure you have the correct link address
                </div>
            </div>
        </div>
    </div>
<?php
}
?>



<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
