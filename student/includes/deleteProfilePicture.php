<?php
include("autoloader.inc.php");


    $id = $_SESSION['id'];

    try {
        $s = new Usercontr();
        $s->deleteProfilePicture($id);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
    


