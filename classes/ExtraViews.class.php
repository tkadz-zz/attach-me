<?php

class ExtraViews extends Users
{


    //FOR STUDENT GENDER SELECTION
    public function studentGender($id){
        ?>
        <option value="<?php echo $_SESSION['sex'] ?>"> <?php echo $_SESSION['sex']  ?> </option>
        <?php
        if($_SESSION['sex'] == 'MALE'){
          ?>
            <option value="FEMALE"> FEMALE </option>
            <option value="PRIVATE"> KEEP PRIVATE  </option>
            <?php
        }

        if($_SESSION['sex'] == 'FEMALE'){
            ?>
            <option value="MALE"> MALE </option>
            <option value="PRIVATE"> KEEP PRIVATE  </option>
            <?php
        }

        else{
            ?>
            <option value="MALE"> MALE </option>
            <option value="FEMALE"> FEMALE </option>
            <?php
        }

    }




}