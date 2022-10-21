<?php

class PignationView extends Users
{

    public function pigLoopImage($recodsPerPage, $query){
        ?>
        <?php
        $records_per_page=$recodsPerPage;
        $paginate = new Pignation();
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate->dataview($newquery);
        $paginate->paginglink($query,$records_per_page);
        ?>
        <?php
    }


    public function adminpigLoopImage($recodsPerPage, $query){
        ?>
        <?php
        $records_per_page=$recodsPerPage;
        $paginate = new Pignation();
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate->admindataview($newquery);
        $paginate->paginglink($query,$records_per_page);
        ?>
        <?php
    }


}