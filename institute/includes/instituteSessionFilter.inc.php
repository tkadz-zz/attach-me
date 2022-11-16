<?php

function FilterSessionDestroy(){
    unset($_SESSION['type']);
    unset($_SESSION['err']);
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['surname']);
    unset($_SESSION['email']);
    unset($_SESSION['role']);
    unset($_SESSION['status']);

    echo "<script type='text/javascript'>;
            window.location='../unauthorized.php';
          </script>";
}


if (!isset($_SESSION['id'])) {
    FilterSessionDestroy();
}
if (!isset($_SESSION['role'])) {
    FilterSessionDestroy();
}
if ($_SESSION['role'] != 'institute') {
    FilterSessionDestroy();
}

