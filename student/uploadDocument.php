<?php
include 'includes/emptyLayoutTop.inc.php';
?>
<?php
include 'includes/miniTab.inc.php';
?>

<?php
if(!isset($_GET['document'])){
    echo "<script type='text/javascript'>
            history.back(-1)
           </script>";
}
?>

    <br>
    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
    <br>
    <br>

<?php

try {
    $n = new StudentView();
    $n->viewUploadDocument($_SESSION['id']);
}catch (TypeError $e){
    echo 'Errot: ' . $e->getMessage();
}
?>










<?php
include 'includes/emptyLayoutBottom.inc.php';
?>