  <?php

  class Userview extends Users
  {



      public function subUserViewProfile($id){
          $userRole = $this->isUser($id, $_SESSION['role']);
          ?>
          <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
              <div class="row ">
                  <div class="col-md-3 border-right">
                      <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                          <?php

                          $n = new StudentView();
                          $n->sexProfileImageView($id, $userRole[0]['sex']);

                          ?>

                          <span class="font-weight-bold"><?php echo $userRole[0]['name'] .' '. $userRole[0]['surname']   ?></span>
                          <span class="text-black-50"><?php echo $userRole[0]['email'] ?></span>
                          <span> </span>
                      </div>
                  </div>


                  <div class="col-md-5 border-right">
                      <div class="p-3 py-5">
                          <div class="d-flex justify-content-between align-items-center mb-3">
                              <h4 class="text-right card-header">Profile Settings</h4>

                          </div>
                          <form method="post" action="includes/subAccProfileUpdate.inc.php" >
                              <div class="row mt-2">
                                  <div class="col-md-6">
                                      <label class="labels">Name</label>
                                      <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRole[0]['name'] ?>" required>
                                  </div>
                                  <div class="col-md-6">
                                      <label class="labels">Surname</label>
                                      <input name="surname" type="text" class="form-control" value="<?php echo $userRole[0]['surname'] ?>" placeholder="surname" required>
                                  </div>
                              </div>
                              <div class="row mt-3">
                                  <div class="col-md-12">
                                      <label class="labels">Mobile Number (<span>07** *** ***</span>) </label>
                                      <input name="phone" type="number" max="0799999999" min="0700000000" class="form-control" placeholder="enter phone number" value="<?php echo $userRole[0]['phone'] ?>">
                                  </div>
                                  <div class="col-md-12">
                                      <label class="labels">Email ID</label>
                                      <input name="email" type="email" class="form-control" placeholder="enter email" value="<?php echo $userRole[0]['email'] ?>">
                                  </div>

                              </div>
                              <div class="row mt-3">
                                  <div class="col-md-6">
                                      <label class="labels">Sex</label>
                                      <select name="sex" class="form-control">
                                          <?php
                                          $extraV = new ExtraViews();
                                          $extraV->studentGender($_SESSION['subID']);
                                          ?>
                                      </select>
                                  </div>
                                  <div class="mt-5 text-center">
                                      <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                  </div>
                          </form>
                      </div>
                  </div>
              </div>



              <div class="col-md-4">
                  <div class="p-3 py-5">
                      <div class="d-flex justify-content-between align-items-center experience">
                          <span>Additional Settings</span>
                      </div>
                      <hr>
                      <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                      <br>
                  </div>
              </div>
          </div>
          </div>
          <?php
      }

      public function ShowInstitutes(){

          $rows = $this->GetAllInstitutes();
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