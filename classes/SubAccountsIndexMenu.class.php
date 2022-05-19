<?php

class SubAccountsIndexMenu extends Users
{

    public function subAccountsLoop($id){
        $rows = $this->GetSubCompanyById($id);
        $rowscount = count($rows);

        ?>
        <div class="row">

            <?php
            $x=0;
            foreach($rows as $row){

                $x++;
                $inputID = 'inputid' . $x;
                $buttonID = 'buttonid' . $x;
                $hr = 'hrid' . $x;

                $subID = $row['id'];
                $subCompanyID = $row['companyID'];
                ?>

                <div class="col-md-3 mb-3">
                    <div class="card">
                        <?php
                        if($row['sex'] == 'M')
                        {
                        ?>
                        <img class="card-img-top" style="width: 80px" src="../img/male.png" alt="Card image cap">
                        <?php
                        }
                        elseif($row['sex'] == 'F'){

                        ?>
                        <img class="card-img-top" style="width: 80px" src="../img/female.png" alt="Card image cap">
                        <?php
                        }
                        else{
                        ?>
                            <img class="card-img-top" style="width: 80px" src="../img/user.png" alt="Card image cap">
                        <?php
                        }
                        ?>
                        <div class="card-body">
                            <h6 class="card-text"><?php echo $row['name'] .' '. $row['surname'] ?></h6>
                            <p class="card-text"><?php echo $row['department'] ?></p>
                            <button id="theButton1<?php echo $x ?>" onclick="clickMe<?php echo $x ?>()" type="button" class="btn btn-secondary"> <span class="fa fa-chevron-circle-down"></span></button>



                            <form method="post" action="includes/subAccSignin.inc.php" >
                                <div class="col-md-12">
                                    <hr class="hide" id="<?php echo $hr; ?>">
                                    <input name="password" id="<?php echo $inputID; ?>" type="password" class="form-control hide" placeholder="Password">
                                    <input name="subID" type="text" hidden value="<?php echo $subID ?>">
                                    <input name="subCompanyID" type="text" hidden value="<?php echo $subCompanyID ?>">
                                    <br>
                                    <button name="sub_login" class="btn btn-primary hide" id="<?php echo $buttonID; ?>"  type="submit">Login</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>






                <script>
                    function clickMe<?php echo $x ?>() {
                        var text = document.getElementById("<?php echo $inputID; ?>");
                        text.classList.toggle("hide");
                        text.classList.toggle("show");

                        var tests = document.getElementById("<?php echo $buttonID; ?>");
                        tests.classList.toggle("hide");
                        tests.classList.toggle("show");

                        var tests = document.getElementById("<?php echo $hr; ?>");
                        tests.classList.toggle("hide");
                        tests.classList.toggle("show");
                    }
                </script>

                <?php
            }
            ?>


        </div>






        <?php
    }

}