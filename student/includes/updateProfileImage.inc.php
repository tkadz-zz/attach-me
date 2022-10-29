<?php
include("autoloader.inc.php");

if(isset($_POST['btn_ProfilePic'])) {

    $id = $_SESSION['id'];
    $imgFile = $_FILES['profilePic'];
    
    //File properties
    $file_name  =   $imgFile['name'];
    $file_tmp   =   $imgFile['tmp_name'];
    $file_size  =   $imgFile['size'];
    $file_error =   $imgFile['error'];



    $allowed    = array('jpg','jpeg','png');

    //Work out file extension
    $file_ext   =   explode('.',$file_name);
    $file_ext   = strtolower(end($file_ext));

    if(in_array($file_ext,$allowed)){
        if($file_error === 0){
            if($file_size <= 5242880){
                $file_name_new  = uniqid('',true).'.'.$file_ext;
                $file_destination   ='../../profileImages/'.$file_name_new;

                try {
                    $dateAdded = date("Y-m-d h:m:i");
                    $s = new Usercontr();
                    $s->updateProfileImage($file_tmp, $file_destination, $file_name_new, $file_ext, $id);
                } catch (TypeError $e) {
                    echo "Error" . $e->getMessage();

                }

            }
            else{
                //Art Image too big
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Image should be 5MB or less in size';
                echo "<script>
                    history.back(-1);
                </script>";
            }
            // Initialise these two variables: $file_tmp, $file_destination, $file_name_new
        }
        else{
            //file not uploaded
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Image Format Not Supported';
            echo "<script>
                history.back(-1);
            </script>";
        }
    }
    else{
        //file extension error
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Image Should be either <span class="text-dark">JPG</span>, <span class="text-dark">JPEG</span> or <span class="text-dark">PNG</span> File Format. Your attempted file is <span class="text-dark text-uppercase">'.$file_ext.'</span> File Format';
        echo "<script>
                history.back(-1);
            </script>";
    }
    
    


    


}