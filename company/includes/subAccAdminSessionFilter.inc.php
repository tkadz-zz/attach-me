<?php
if($_SESSION['subRole'] != 'admin'){
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'You are not authorised to access contents of this page';
    echo "<script type='text/javascript'>
        history.back();
    </script>";
}