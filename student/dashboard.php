<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>

<div class="mt-4 mb-4">
<div class="row">
<?php
$d = new StudentView();

$d->accountOverview($_SESSION['id']);

$d->aattachmentStatus($_SESSION['id']);

?>
</div>
</div>






<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
