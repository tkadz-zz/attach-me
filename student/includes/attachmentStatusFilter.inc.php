<?php

try {
    $n = new Usercontr();
    $n->attachmentStatusFilter($_SESSION['id']);
}catch (TypeError $e){
    echo 'Error:' . $e->getMessage();
}