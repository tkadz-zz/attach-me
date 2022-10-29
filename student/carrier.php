<?php
include 'includes/emptyLayoutTop.inc.php';
?>
<?php
include 'includes/miniTab.inc.php';
?>

    <style>

        .form-control:focus {
            box-shadow: none;
            border-color: blue
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }

        .myhover{
            border-radius: 5%;
        }

        .myhover:hover{
            cursor: pointer;
            transition: all .3s ease-in-out;
            transform: scale(1.1);
            -webkit-box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.175) !important;
            box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important;
            border-radius: 5%;
        }

    </style>





<?php

$studentProfile = new StudentView();
$studentProfile->StudentViewCarrier($_SESSION['id']);

?>







<?php
include 'includes/emptyLayoutBottom.inc.php';
?>