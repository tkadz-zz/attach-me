<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';



?>
<br>
<div class="">
    <h6><?php echo $_SESSION['name'] ?>'s Sub-Accounts</h6>
</div>
<hr>
<style>
    form {
        width: 50%;
    }

    .hide {
        display: none;
    }

    .show {
        display: block;
    }
</style>




<?php
$accountView = new SubAccountsIndexMenu();
$accountView->subAccountsLoop($_SESSION['id']);

?>










<?php
include 'includes/emptyLayoutBottom.inc.php';
?>


