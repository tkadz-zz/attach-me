<?php

class DBTableloopsView extends Users
{

    public function VacancyCategoryLoopView($id){
        $rows = $this->GetAllVacancyCategorysByCompanyID($id);

        ?>
        <option value="">-- Select Category --</option>
        <?php
        foreach ($rows as $row){
        ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['category'] ?></option>
        <?php
        }
    }

}