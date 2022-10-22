  <?php

  class Userview extends Users
  {




      public function ShowInstitutes(){

          $rows = parent::ShowInstitutes();
          $s = 0;

          foreach ($rows as $row){
              $s++;
              ?>
              <option value="<?php echo $row['userID'] ?>"><?php echo $s .'. '. $row['name'] ?></option>
              <?php
          }
      }

      public function ShowPrograms(){
          $rows = parent::ShowPrograms();
          $s = 0;
          foreach ($rows as $row){
              $s++;

              ?>
              <option value="<?php echo $row['id'] ?>"><?php echo $s .'. '. $row['name'] ?></option>
              <?php
          }
      }


  }