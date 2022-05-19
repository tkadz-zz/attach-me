<?php include('includes/navbar.inc.php'); ?>


    <header class="masthead">
        <div class="container px-5">
            <?php include 'includes/progress_bar.inc.php' ?>
            <div class="col-lg-6">
                <div -class="p-5">
                    <div style="font-size: 14px">
                        <?php include('includes/error_report.inc.php') ?>
                    </div>
                </div>
            </div>


            <?php
            if(!isset($_SESSION['id'])){
                $_SESSION['id'] = NULL;
            }

            $show = new SignupUserView();
            $show->showSignupForm($_SESSION['id']);
            ?>



        </div>
    </header>




    <script type="text/javascript">
        //close div in 5 secs
        window.setTimeout("closeDisDiv();", 6000);

        function closeDisDiv(){
            document.getElementById("divDis").style.display="none";
            $(".fadeout").click(function (){
                $("div").fadeOut();
            });
        }
    </script>


    <script>
        var check = function() {
            if (document.getElementById('password').value ==
                document.getElementById('confirmPassword').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById("save-btn").disabled = false;
                document.getElementById('message').innerHTML = '<div id="divDis" class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-success"><span class="fa fa-check-circle"></span> Password matched</div>';
            }
            else {
                document.getElementById('message').style.color = 'red';
                document.getElementById("save-btn").disabled = true;
                document.getElementById('message').innerHTML = '<div class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-danger"><span class="fa fa-exclamation-circle"></span> Password not matching Confirm Password</div>';
            }


        }
    </script>



<?php include('includes/footer.inc.php'); ?>