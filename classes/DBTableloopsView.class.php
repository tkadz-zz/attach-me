<?php

class DBTableloopsView extends Users
{

    public function VacancyCategoryLoopView(){
        $rows = $this->GetAllVacancyCategories();

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