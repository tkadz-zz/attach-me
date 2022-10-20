<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';

if(isset($_SESSION['subID'])){
        echo "<script type='text/javascript'>;
                      history.back();
                    </script>";
}

?>
<br>
<div class="card-title card-header">
    <h6><?php echo $_SESSION['name'] ?>'s Sub-Accounts</h6>
</div>
<br>
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


