<?php

class Pignation extends Users
{


    public function SubAccLoop($query){
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
         if(count($rows) > 0){
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
                        if($row['avatar'] != ''){ ?>
                            <img class="card-img-top rounded-circle" style="width: 80px; height: 80px" src="<?php echo $row['avatar'] ?>" alt="Card image cap">
                        <?php }
                        else{
                            if($row['sex'] == 'MALE') { ?>
                                <img class="card-img-top" style="width: 80px" src="../img/male.png" alt="Card image cap">
                            <?php }
                            elseif($row['sex'] == 'FEMALE'){ ?>
                                <img class="card-img-top" style="width: 80px" src="../img/female.png" alt="Card image cap">
                            <?php }
                            else{ ?>
                                <img class="card-img-top" style="width: 80px" src="../img/user.png" alt="Card image cap">
                            <?php }
                        } ?>

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
         }
         else{
             ?>
         <hr>
             <div class="container px-0">
                 <div class="pp-gallery">
                     <div class="-card-columns">
                         <div class="alert alert-info text-dark" role="alert">
                             <span class="mdi mdi-information-outline"></span> No Accounts found. <br><br>
                             If you are trying to search, check your spelling and try again or submit a blank search to view all accounts
                         </div>
                     </div>
                 </div>
             </div>
             <?php
         }
            ?>
        </div>
        <?php
    }






    public function vacancyLoop($query)
    {
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if(count($rows) > 0)
        {
            $s = 0;
            foreach ($rows as $row){
                $categRoles = $this->GetCategoryByID($row['cartegory']);
                $companyRoles = $this->GetCompanyById($row['companyID']);
            ?>
            <div class="col-md-12"
                <?php
                if(count($categRoles) <= 0){
                    $categName = 'uncategorised';
                    $categID =0;
                    ?>
                 data-groups="[&quot;<?php echo $categName ?>&quot;]">
                <?php
                }
                else{
                    $categName = $categRoles[0]['category'];
                    $categID = $categRoles[0]['id'];
                    ?>
                    data-groups="[&quot;<?php echo $categName ?>&quot;]">
                    <?php
                }
                ?>

                <div>
                    <div class="card mx-auto">
                        <div class="row">


                            <div class="col-md-2">
                                <div>
                                    <?php
                                    if($companyRoles[0]['avatar'] == ''){
                                        ?>
                                        <img class="card-img-top rounded-circle" style="width: 80px" src="../img/companyEnterprise.png" alt="Card image cap"><br>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <img class="card-img-top rounded-circle" style="width: 80px" src="<?php echo $companyRoles[0]['avatar'] ?>" alt="Card image cap"><br>
                                        <?php
                                    }
                                    ?>
                                    <div class="card-description">
                                        <?php echo $companyRoles[0]['name'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="card-title">
                                    <p class="heading"><?php echo $row['title'] ?> : <a data-toggle="tooltip" data-placement="right" title="View All
                                    <?php echo $categName ?> Vacancies" href="?filter=<?php echo $categName ?>&fid=<?php echo $categID ?>" style="font-size: 10px" class="badge badge-primary text-decoration-none"><?php echo $categName ?></a></p>
                                </div>
                                <div class="mutual">

                                    <span>Posted: </span><span class="card-description text-dark" style="font-size: 13px"><?php echo $this->timeAgo($row['datePosted']) ?> : (<?php echo $this->dateToDayMDY($row['datePosted']) ?>)</span><br>
                                    <span>Deadline: </span><span class="card-description text-dark" style="font-size: 13px"><?php echo $this->dateToDay($row['expiryDate']) ?></span><br>
                                    <span>Location: </span><span class="card-description text-dark" style="font-size: 13px"><?php echo strtoupper($row['location']) ?></span>
                                </div>
                                <div class="row btnsubmit mt-4">
                                    <div class="col-md-12 col-12">
                                        <button style="float: right" type="button" class="btn btn-primary btn-lg"><span>Apply Now</span></button>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
            </div>
            <?php
            }
        }
        else
        {
            ?>
            <hr>
            <div class="container px-0">
                <div class="pp-gallery">
                    <div class="-card-columns">
                        <div class="alert alert-info text-dark" role="alert">
                            <span class="mdi mdi-information-outline"></span> No vacancies found. Try filtering to another category browse all vacancies
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

    }

    public function paging($query,$records_per_page)
    {
        $starting_position=0;
        if(isset($_GET["page_no"]))
        {
            $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }



    public function paginglink($query,$records_per_page)
    {

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $total_no_of_records = count($rows);
        if($total_no_of_records > 0)
        {
            ?>
                <hr>
            <div class="col-md-12">
                <tr>
                    <td colspan="12">
                        <?php
                        $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
                        $current_page=1;
                        if(isset($_GET["page_no"]))
                        {
                            $current_page=$_GET["page_no"];
                        }
                        if($current_page!=1)
                        {
                            $previous =$current_page-1;
                            ?>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=1"><span class="fa fa-chevron-circle-left"></span> First Page</a>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=<?php echo $previous ?>"><span class="fa fa-reply"></span> Previous Page</a>
                            <?php
                        }
                        for($i=1;$i<=$total_no_of_pages;$i++)
                        {
                            if($i==$current_page)
                            {
                                ?>
                                <a class="btn btn-primary" href="<?php echo $self ?>?page_no=<?php echo $i ?>"><?php echo $i ?></a>
                                <?php
                            }
                            else
                            {
                                ?>
                                <a class="btn btn-secondary" href="<?php echo $self ?>?page_no=<?php echo $i ?>"><?php echo $i ?></a>
                                <?php
                            }
                        }
                        if($current_page!=$total_no_of_pages)
                        {
                            $next=$current_page+1;
                            ?>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=<?php echo $next ?>">Next Page <span class="fa fa-chevron-circle-right"></span></a>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=<?php echo $total_no_of_pages ?>">Last Page <span class="fa fa-angle-double-right"></span></a>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            </div>
            <?php
        }
    }


}