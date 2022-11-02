<?php

class SignupUserView extends Users{

    public function showSignupForm($id){
        $rows = $this->GetUser($id);
        if(isset($_SESSION['id'])){
            $regStatus = $rows[0]['regStatus'];
        }
        else{
            $regStatus = NULL;
        }?>

    <style>
    .avatar{
        vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    </style>

        <?php

        if($regStatus == 2){
            $Date = date("Y-m-d");
            //71 YEARS MAXIMUM AGE
            $DOBMin =  date('Y-m-d', strtotime($Date. ' - 26206 days'));
            //15 YEARS OLD MINIMUM AGE
            $DOBMax =  date('Y-m-d', strtotime($Date. ' - 6117 days'));
            //ACCOUNT IS NOW CREATED
            ?>

            <div class="row gx-5 pt-4 align-items-center">
                <div class="col-lg-6">
                    <div -class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">'HELLO <?php echo $_SESSION['name'] ?>!'</h1>
                        </div>

                        <form role="form" class="user" method="POST" action="includes/signupStages.inc.php">
                            <div class="form-group row">

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>National ID</label>
                                    <input id="nid" type="text"  class="form-control form-control-user" placeholder="National ID(xx-xxxxxxRxx)" autocomplete="off" name="nid" minlength="12" maxlength="12"  required >
                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>When where you born?</label>
                                    <input id="dob" type="date"  class="form-control form-control-user" placeholder="When Where your born?" autocomplete="off" name="DOB" min="<?php echo $DOBMin ?>"max="<?php echo $DOBMax ?>" required >
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Marital Status</label>
                                    <select type="number" class="form-control form-control-user" id="exampleFirstName" autocomplete="off" name="marital" required >
                                        <option value=""> -- Marital Status --</option>
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="private">Keep Private</option>
                                    </select>
                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Gender</label>
                                    <select type="text" class="form-control form-control-user" id="sex" placeholder="Tell Us Your Gender" autocomplete="off" name="gender" required >
                                        <option value=""> -- Select Your Gender -- </option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="n_a">Keep Private</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label>Phone (07** *** ***)</label>
                                    <input type="number" class="form-control form-control-user" id="number" placeholder="Phone Number" name="phone" min="0700000000" max="0799999999" maxlength="9" required >
                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Email (optional)</label>
                                    <input type="email" class="form-control form-control-user"
                                           id="email"
                                           placeholder="Provide Email if you own one"
                                           name="email"
                                    >
                                </div>
                                <br>
                                <br>
                                <div>
                                    <span id='message'></span>
                                </div>
                                <br>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Country</label>
                                    <select class="form-control form-control-user" id="country" name="country" required>

                                        <option value=""> -- Select Your Country -- </option>

                                        <option value="Afghanistan">Afghanistan</option>

                                        <option value="Albania">Albania</option>

                                        <option value="Algeria">Algeria</option>

                                        <option value="American Samoa">American Samoa</option>

                                        <option value="Andorra">Andorra</option>

                                        <option value="Angola">Angola</option>

                                        <option value="Anguilla">Anguilla</option>

                                        <option value="Antigua & Barbuda">Antigua & Barbuda</option>

                                        <option value="Argentina">Argentina</option>

                                        <option value="Armenia">Armenia</option>

                                        <option value="Aruba">Aruba</option>

                                        <option value="Australia">Australia</option>

                                        <option value="Austria">Austria</option>

                                        <option value="Azerbaijan">Azerbaijan</option>

                                        <option value="Bahamas">Bahamas</option>

                                        <option value="Bahrain">Bahrain</option>

                                        <option value="Bangladesh">Bangladesh</option>

                                        <option value="Barbados">Barbados</option>

                                        <option value="Belarus">Belarus</option>

                                        <option value="Belgium">Belgium</option>

                                        <option value="Belize">Belize</option>

                                        <option value="Benin">Benin</option>

                                        <option value="Bermuda">Bermuda</option>

                                        <option value="Bhutan">Bhutan</option>

                                        <option value="Bolivia">Bolivia</option>

                                        <option value="Bonaire">Bonaire</option>

                                        <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>

                                        <option value="Botswana">Botswana</option>

                                        <option value="Brazil">Brazil</option>

                                        <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>

                                        <option value="Brunei">Brunei</option>

                                        <option value="Bulgaria">Bulgaria</option>

                                        <option value="Burkina Faso">Burkina Faso</option>

                                        <option value="Burundi">Burundi</option>

                                        <option value="Cambodia">Cambodia</option>

                                        <option value="Cameroon">Cameroon</option>

                                        <option value="Canada">Canada</option>

                                        <option value="Canary Islands">Canary Islands</option>

                                        <option value="Cape Verde">Cape Verde</option>

                                        <option value="Cayman Islands">Cayman Islands</option>

                                        <option value="Central African Republic">Central African Republic</option>

                                        <option value="Chad">Chad</option>

                                        <option value="Channel Islands">Channel Islands</option>

                                        <option value="Chile">Chile</option>

                                        <option value="China">China</option>

                                        <option value="Christmas Island">Christmas Island</option>

                                        <option value="Cocos Island">Cocos Island</option>

                                        <option value="Colombia">Colombia</option>

                                        <option value="Comoros">Comoros</option>

                                        <option value="Congo">Congo</option>

                                        <option value="Cook Islands">Cook Islands</option>

                                        <option value="Costa Rica">Costa Rica</option>

                                        <option value="Cote DIvoire">Cote DIvoire</option>

                                        <option value="Croatia">Croatia</option>

                                        <option value="Cuba">Cuba</option>

                                        <option value="Curaco">Curacao</option>

                                        <option value="Cyprus">Cyprus</option>

                                        <option value="Czech Republic">Czech Republic</option>

                                        <option value="Denmark">Denmark</option>

                                        <option value="Djibouti">Djibouti</option>

                                        <option value="Dominica">Dominica</option>

                                        <option value="Dominican Republic">Dominican Republic</option>

                                        <option value="East Timor">East Timor</option>

                                        <option value="Ecuador">Ecuador</option>

                                        <option value="Egypt">Egypt</option>

                                        <option value="El Salvador">El Salvador</option>

                                        <option value="Equatorial Guinea">Equatorial Guinea</option>

                                        <option value="Eritrea">Eritrea</option>

                                        <option value="Estonia">Estonia</option>

                                        <option value="Ethiopia">Ethiopia</option>

                                        <option value="Falkland Islands">Falkland Islands</option>

                                        <option value="Faroe Islands">Faroe Islands</option>

                                        <option value="Fiji">Fiji</option>

                                        <option value="Finland">Finland</option>

                                        <option value="France">France</option>

                                        <option value="French Guiana">French Guiana</option>

                                        <option value="French Polynesia">French Polynesia</option>

                                        <option value="French Southern Ter">French Southern Ter</option>

                                        <option value="Gabon">Gabon</option>

                                        <option value="Gambia">Gambia</option>

                                        <option value="Georgia">Georgia</option>

                                        <option value="Germany">Germany</option>

                                        <option value="Ghana">Ghana</option>

                                        <option value="Gibraltar">Gibraltar</option>

                                        <option value="Great Britain">Great Britain</option>

                                        <option value="Greece">Greece</option>

                                        <option value="Greenland">Greenland</option>

                                        <option value="Grenada">Grenada</option>

                                        <option value="Guadeloupe">Guadeloupe</option>

                                        <option value="Guam">Guam</option>

                                        <option value="Guatemala">Guatemala</option>

                                        <option value="Guinea">Guinea</option>

                                        <option value="Guyana">Guyana</option>

                                        <option value="Haiti">Haiti</option>

                                        <option value="Hawaii">Hawaii</option>

                                        <option value="Honduras">Honduras</option>

                                        <option value="Hong Kong">Hong Kong</option>

                                        <option value="Hungary">Hungary</option>

                                        <option value="Iceland">Iceland</option>

                                        <option value="Indonesia">Indonesia</option>

                                        <option value="India">India</option>

                                        <option value="Iran">Iran</option>

                                        <option value="Iraq">Iraq</option>

                                        <option value="Ireland">Ireland</option>

                                        <option value="Isle of Man">Isle of Man</option>

                                        <option value="Israel">Israel</option>

                                        <option value="Italy">Italy</option>

                                        <option value="Jamaica">Jamaica</option>

                                        <option value="Japan">Japan</option>

                                        <option value="Jordan">Jordan</option>

                                        <option value="Kazakhstan">Kazakhstan</option>

                                        <option value="Kenya">Kenya</option>

                                        <option value="Kiribati">Kiribati</option>

                                        <option value="Korea North">Korea North</option>

                                        <option value="Korea Sout">Korea South</option>

                                        <option value="Kuwait">Kuwait</option>

                                        <option value="Kyrgyzstan">Kyrgyzstan</option>

                                        <option value="Laos">Laos</option>

                                        <option value="Latvia">Latvia</option>

                                        <option value="Lebanon">Lebanon</option>

                                        <option value="Lesotho">Lesotho</option>

                                        <option value="Liberia">Liberia</option>

                                        <option value="Libya">Libya</option>

                                        <option value="Liechtenstein">Liechtenstein</option>

                                        <option value="Lithuania">Lithuania</option>

                                        <option value="Luxembourg">Luxembourg</option>

                                        <option value="Macau">Macau</option>

                                        <option value="Macedonia">Macedonia</option>

                                        <option value="Madagascar">Madagascar</option>

                                        <option value="Malaysia">Malaysia</option>

                                        <option value="Malawi">Malawi</option>

                                        <option value="Maldives">Maldives</option>

                                        <option value="Mali">Mali</option>

                                        <option value="Malta">Malta</option>

                                        <option value="Marshall Islands">Marshall Islands</option>

                                        <option value="Martinique">Martinique</option>

                                        <option value="Mauritania">Mauritania</option>

                                        <option value="Mauritius">Mauritius</option>

                                        <option value="Mayotte">Mayotte</option>

                                        <option value="Mexico">Mexico</option>

                                        <option value="Midway Islands">Midway Islands</option>

                                        <option value="Moldova">Moldova</option>

                                        <option value="Monaco">Monaco</option>

                                        <option value="Mongolia">Mongolia</option>

                                        <option value="Montserrat">Montserrat</option>

                                        <option value="Morocco">Morocco</option>

                                        <option value="Mozambique">Mozambique</option>

                                        <option value="Myanmar">Myanmar</option>

                                        <option value="Nambia">Nambia</option>

                                        <option value="Nauru">Nauru</option>

                                        <option value="Nepal">Nepal</option>

                                        <option value="Netherland Antilles">Netherland Antilles</option>

                                        <option value="Netherlands">Netherlands (Holland, Europe)</option>

                                        <option value="Nevis">Nevis</option>

                                        <option value="New Caledonia">New Caledonia</option>

                                        <option value="New Zealand">New Zealand</option>

                                        <option value="Nicaragua">Nicaragua</option>

                                        <option value="Niger">Niger</option>

                                        <option value="Nigeria">Nigeria</option>

                                        <option value="Niue">Niue</option>

                                        <option value="Norfolk Island">Norfolk Island</option>

                                        <option value="Norway">Norway</option>

                                        <option value="Oman">Oman</option>

                                        <option value="Pakistan">Pakistan</option>

                                        <option value="Palau Island">Palau Island</option>

                                        <option value="Palestine">Palestine</option>

                                        <option value="Panama">Panama</option>

                                        <option value="Papua New Guinea">Papua New Guinea</option>

                                        <option value="Paraguay">Paraguay</option>

                                        <option value="Peru">Peru</option>

                                        <option value="Phillipines">Philippines</option>

                                        <option value="Pitcairn Island">Pitcairn Island</option>

                                        <option value="Poland">Poland</option>

                                        <option value="Portugal">Portugal</option>

                                        <option value="Puerto Rico">Puerto Rico</option>

                                        <option value="Qatar">Qatar</option>

                                        <option value="Republic of Montenegro">Republic of Montenegro</option>

                                        <option value="Republic of Serbia">Republic of Serbia</option>

                                        <option value="Reunion">Reunion</option>

                                        <option value="Romania">Romania</option>

                                        <option value="Russia">Russia</option>

                                        <option value="Rwanda">Rwanda</option>

                                        <option value="St Barthelemy">St Barthelemy</option>

                                        <option value="St Eustatius">St Eustatius</option>

                                        <option value="St Helena">St Helena</option>

                                        <option value="St Kitts-Nevis">St Kitts-Nevis</option>

                                        <option value="St Lucia">St Lucia</option>

                                        <option value="St Maarten">St Maarten</option>

                                        <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>

                                        <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>

                                        <option value="Saipan">Saipan</option>

                                        <option value="Samoa">Samoa</option>

                                        <option value="Samoa American">Samoa American</option>

                                        <option value="San Marino">San Marino</option>

                                        <option value="Sao Tome & Principe">Sao Tome & Principe</option>

                                        <option value="Saudi Arabia">Saudi Arabia</option>

                                        <option value="Senegal">Senegal</option>

                                        <option value="Seychelles">Seychelles</option>

                                        <option value="Sierra Leone">Sierra Leone</option>

                                        <option value="Singapore">Singapore</option>

                                        <option value="Slovakia">Slovakia</option>

                                        <option value="Slovenia">Slovenia</option>

                                        <option value="Solomon Islands">Solomon Islands</option>

                                        <option value="Somalia">Somalia</option>

                                        <option value="South Africa">South Africa</option>

                                        <option value="Spain">Spain</option>

                                        <option value="Sri Lanka">Sri Lanka</option>

                                        <option value="Sudan">Sudan</option>

                                        <option value="Suriname">Suriname</option>

                                        <option value="Swaziland">Swaziland</option>

                                        <option value="Sweden">Sweden</option>

                                        <option value="Switzerland">Switzerland</option>

                                        <option value="Syria">Syria</option>

                                        <option value="Tahiti">Tahiti</option>

                                        <option value="Taiwan">Taiwan</option>

                                        <option value="Tajikistan">Tajikistan</option>

                                        <option value="Tanzania">Tanzania</option>

                                        <option value="Thailand">Thailand</option>

                                        <option value="Togo">Togo</option>

                                        <option value="Tokelau">Tokelau</option>

                                        <option value="Tonga">Tonga</option>

                                        <option value="Trinidad & Tobago">Trinidad & Tobago</option>

                                        <option value="Tunisia">Tunisia</option>

                                        <option value="Turkey">Turkey</option>

                                        <option value="Turkmenistan">Turkmenistan</option>

                                        <option value="Turks & Caicos Is">Turks & Caicos Is</option>

                                        <option value="Tuvalu">Tuvalu</option>

                                        <option value="Uganda">Uganda</option>

                                        <option value="United Kingdom">United Kingdom</option>

                                        <option value="Ukraine">Ukraine</option>

                                        <option value="United Arab Erimates">United Arab Emirates</option>

                                        <option value="United States of America">United States of America</option>

                                        <option value="Uraguay">Uruguay</option>

                                        <option value="Uzbekistan">Uzbekistan</option>

                                        <option value="Vanuatu">Vanuatu</option>

                                        <option value="Vatican City State">Vatican City State</option>

                                        <option value="Venezuela">Venezuela</option>

                                        <option value="Vietnam">Vietnam</option>

                                        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>

                                        <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>

                                        <option value="Wake Island">Wake Island</option>

                                        <option value="Wallis & Futana Is">Wallis & Futana Is</option>

                                        <option value="Yemen">Yemen</option>

                                        <option value="Zaire">Zaire</option>

                                        <option value="Zambia">Zambia</option>

                                        <option value="Zimbabwe">Zimbabwe</option>

                                    </select>
                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Whats your religion?</label>
                                    <input id="dob" type="text"  class="form-control form-control-user"
                                           id="exampleLastName"
                                           placeholder="Religion/Belief"
                                           autocomplete="off"
                                           name="religion"
                                           required
                                    >
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <label>About self</label>
                                    <textarea name="about" class="form-control form-control-user" style="height: 100px" placeholder="tell us a little more about you"></textarea>
                                </div>
                            </div>
                            <br>

                            <button id="save-btn" name="stage2" type="submit"  class="btn btn-outline-primary btn-user btn-block">
                                Next <span class="fa fa-chevron-circle-right"></span>
                            </button>
                        </form>
                        <br>
                        <hr>

                        <?php

                        if(!isset($_SESSION['id'])){
                            ?>
                            <div class="text-center">
                                <a class="small" href="signin.php">Already have an account? Sign-in!</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Personal Details</h1>
                        <p class="lead fw-normal text-muted mb-5">Please, Tell us more about yourself for better personalisation
                        <div class="d-flex flex-column flex-lg-row align-items-center"></div>
                    </div>
                </div>
            </div>
            <?php
        }
        elseif ($regStatus == 3){
            ?>
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <div -class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $_SESSION['regNumber'] ?></h1>
                        </div>

                        <form role="form" class="user" method="POST" action="includes/signupStages.inc.php">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Institute</label>
                                    <select name="institute" type="text" class="form-control form-control-user" required>
                                        <option> -- Choose Your Institute -- </option>
                                        <option value="0"> Not Listed Below </option>
                                        <?php
                                        $n = new Userview();
                                        $n->ShowInstitutes();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Course/Program</label>
                                    <select name="program" type="text" class="form-control form-control-user" required>
                                        <option> -- Choose Your Program/Course -- </option>
                                        <option value="0"> Not Listed Below </option>
                                        <?php
                                        $n = new Userview();
                                        $n->ShowPrograms();
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Program/Course Type</label>
                                    <select name="programType" type="text" class="form-control form-control-user" required>
                                        <option> -- Program/Course Type -- </option>
                                        <option value="0"> Not Listed Below </option>
                                        <option value="Certificate"> Certificate </option>
                                        <option value="Bachelor"> Bachelor's Degree </option>
                                        <option value="Masters"> Masters Degree </option>
                                        <option value="PHD"> PHD </option>
                                        <option value="Doctorate"> Doctorate </option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Date Started / From</label>
                                    <input type="date" class="form-control form-control-user"
                                           placeholder="Date Name"
                                           autocomplete="off"
                                           name="dateStart"
                                           required
                                    >
                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Date Graduated /to Graduate</label>
                                    <input type="date" class="form-control form-control-user"
                                           id="exampleLastName"
                                           placeholder="Surname"
                                           autocomplete="off"
                                           name="dateEnd"
                                           required
                                    >
                                </div>
                            </div>
                            <br>
                            <br>

                            <button id="save-btn" name="stage3" type="submit"  class="btn btn-outline-primary btn-user btn-block">
                                Next <span class="fa fa-chevron-circle-right"></span>
                            </button>
                            <br>
                        </form>
                        <hr>

                        <?php
                        if(!isset($_SESSION['id'])){
                            ?>
                            <div class="text-center">
                                <a class="small" href="signin.php">Already have an account? Sign-in!</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Educational Details</h1>
                        <p class="lead fw-normal text-muted mb-5">Okay <?php echo $_SESSION['regNumber'] ?> You have come soo far and we are almost there. Now you tell us more
                            about your latest education career
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        elseif ($regStatus == 4){
            ?>
            <div class="row gx-5 align-items-center">
                <br>
                <div class="col-lg-12">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Horay!!!</h1>
                        <br>
                        <p class="lead fw-normal text-muted mb-5">Congratulations <?php echo $_SESSION['name'] .' '. $_SESSION['surname'] ?> Your account is now ready to use. Our journey with you begins here.
                        <div>
                            <label>by clicking finish, you agree to our <a href="#!">Terms and conditions</a></label>
                            <br>
                            <br>
                            <form method="POST" action="includes/signupStages.inc.php">
                                <input type="text" name="emptyInput" hidden >
                                <button id="save-btn" name="stage4" type="submit"  class="btn btn-outline-primary btn-user btn-block"> Finish <span class="fa fa-check"></span></button>
                            </form>
                        </div>
                        <br>
                        <hr>
                        <div>
                        <div>
                        </div>

                        <script>
                            function myFunction() {
                              document.getElementById("myCheck").disabled = true;
                            }
                        </script>
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        else{
            ?>
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <div -class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form role="form" class="user" method="POST" action="includes/signup.inc.php">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                           id="exampleRegNumber"
                                           placeholder="Student Reg-Number"
                                           autocomplete="off"
                                           name="loginID"
                                           required
                                    >
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                           id="exampleFirstName"
                                           placeholder="First Name"
                                           autocomplete="off"
                                           name="name"
                                           required
                                    >
                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                           id="exampleLastName"
                                           placeholder="Surname"
                                           autocomplete="off"
                                           name="surname"
                                           required
                                    >
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                           id="password"
                                           placeholder="Password"
                                           name="password"
                                           required
                                           onkeyup='check();'
                                    >
                                </div>
                                <br>

                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                           id="confirmPassword"
                                           placeholder="Repeat Password"
                                           name="confirmPassword"
                                           required
                                           onkeyup='check();'
                                    >
                                </div>
                                <br>

                                <div>
                                    <span id='message'></span>
                                </div>
                                <br>
                            </div>
                            <br>

                            <button id="save-btn" name="submitButton" class="btn btn-outline-primary btn-user btn-block" disabled="disabled">
                                Register Account <span class="fa fa-user-plus"></span>
                            </button>
                            <br>
                        </form>
                        <hr>


                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <?php
                        if(!isset($_SESSION['id'])){
                            ?>
                            <div class="text-center">
                                <a class="small" href="signin.php">Already have an account? Sign-in!</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Create a free Student account</h1>
                        <p class="lead fw-normal text-muted mb-5">We are happy you have decided to join us. Its a choice thats worth it
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
