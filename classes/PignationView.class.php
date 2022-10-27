<?php

class PignationView extends Users
{

    public function subAccLoop($recodsPerPage, $query){
        ?>
        <?php
        $records_per_page=$recodsPerPage;
        $paginate = new Pignation();
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate->subAccLoop($newquery);
        $paginate->paginglink($query,$records_per_page);
        ?>
        <?php
    }

    public function vacancyLoop($recodsPerPage, $query){
        ?>
        <?php
        $records_per_page=$recodsPerPage;
        $paginate = new Pignation();
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate->vacancyLoop($newquery);
        $paginate->paginglink($query,$records_per_page);
        ?>
        <?php
    }


}