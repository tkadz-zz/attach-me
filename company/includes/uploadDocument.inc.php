<?php
include("autoloader.inc.php");
include "companySessionFilter.inc.php";

if(!isset($_GET['document'])){
    echo "<script type='text/javascript'>history.back(-1)</script>";
}

$type = $_GET['document'];
$id = $_GET['userID'];




try {
    $imgFile = $_FILES['docFile'];

    //File properties
    $file_name  =   $imgFile['name'];
    $file_tmp   =   $imgFile['tmp_name'];
    $file_size  =   $imgFile['size'];
    $file_error =   $imgFile['error'];



    $allowed    = array('doc','docx','pdf', 'odt');

    //Work out file extension
    $file_ext   =   explode('.',$file_name);
    $file_ext   = strtolower(end($file_ext));

    if(in_array($file_ext,$allowed)){
        if($file_error === 0){
            if($file_size <= 5242880){
                $file_name_new  = uniqid('',true).'.'.$file_ext;

                if($type == 'cv'){
                    $Dtype = 'Curriculum Vitae';
                    $file_destination   ='../../cv/'.$file_name_new;
                }
                elseif($type == 'attRep'){
                    $Dtype = 'Attachment Report';
                    $file_destination   ='../../attachmentReports/'.$file_name_new;
                }
                elseif($type == 'assRep'){
                    $Dtype = 'Assessment Report';
                    $file_destination   ='../../assessmentReports/'.$file_name_new;
                }
                elseif($type == 'logb'){
                    $Dtype = 'Logbook';
                    $file_destination   ='../../logbooks/'.$file_name_new;
                }
                else{
                    echo "<script type='text/javascript'>history.back(-1)</script>";
                }


                try {
                    $dateAdded = date("Y-m-d h:i:s");
                    $s = new Usercontr();
                    $s->uploadDocument($file_tmp, $file_destination, $file_name_new, $file_ext, $type, $id);
                } catch (TypeError $e) {
                    echo "Error" . $e->getMessage();

                }

            }
            else{
                //Art Image too big
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'file should be 5MB or less in size';
                echo "<script>
                    history.back(-1);
                </script>";
            }
            // Initialise these two variables: $file_tmp, $file_destination, $file_name_new
        }
        else{
            //file not uploaded
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'file Format Not Supported';
            echo "<script>
                history.back(-1);
            </script>";
        }
    }
    else{
        //file extension error
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'File Should be either <span class="text-dark">DOC</span>, <span class="text-dark">DOCX</span> or <span class="text-dark">PDF</span> File Format. Your attempted file is <span class="text-dark text-uppercase">'.$file_ext.'</span> File Format';
        echo "<script>
                history.back(-1);
            </script>";
    }
} catch (TypeError $e) {
    echo "Error" . $e->getMessage();
}

