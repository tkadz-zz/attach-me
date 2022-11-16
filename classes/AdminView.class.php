  <?php

  class AdminView extends AdminModel
  {

    //GetFunctions
      public function ViewAllUsers(){
          $rows = $this->GetAllUsers();
          $s=0;
          foreach ($rows as $row){
              $s++;
              $userRows = $this->isUser($row['id'], $row['role']);

              if($row['role'] == 'admin'){
                  $borderClass = 'danger';
              }
              elseif ($row['role'] == 'student'){
                  $borderClass = 'success';
              }
              elseif ($row['role'] == 'institute'){
                  $borderClass = 'primary';
              }
              elseif ($row['role'] == 'company'){
                  $borderClass = 'warning';
              }

          ?>
          <tr>
              <td><?php echo $s ?> </td>
              <td><a href="userProfile.php?userID=<?php echo $row['id'] ?>">
              <?php
                echo $userRows[0]['name'];
                if($row['role'] == 'student'){
                    echo ' '. $userRows[0]['surname'];
                }
              ?></a>
              </td>
              <td><span class="badge badge-<?php echo $borderClass ?>"><?php echo $row['role'] ?></span></td>
              <td><a href="userProfile.php?userID=<?php echo $row['id'] ?>"><span class="fa fa-pencil"></span></a></td>
          </tr>
        <?php
          }
      }

      public function myCount($ress){
          $s = 0;
          foreach ($ress as $res){
              $s++;
          }
          if($s >= 100){
              echo '99+';
          }
          else{
              echo $s;
          }
      }

      public function countAllUsers(){
          $userRows = $this->GetAllUsers();
          $n = new Usercontr();
          $n->myCount($userRows);
      }

      public function countAllStudents(){
          $userRows = $this->GetAllStudents();
          $n = new Usercontr();
          $n->myCount($userRows);
      }

      public function countAllCompanies(){
          $userRows = $this->GetAllCompanies();
          $n = new Usercontr();
          $n->myCount($userRows);
      }
      public function countAllInstitutes(){
          $userRows = $this->GetAllInstitutes();
          $n = new Usercontr();
          $n->myCount($userRows);
      }

      public function countAllAdmin(){
          $userRows = $this->GetAllAdmin();
          $n = new Usercontr();
          $n->myCount($userRows);
      }

  }