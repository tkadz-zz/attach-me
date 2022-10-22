<?php


 function MyReturn($type, $err){

    session_start();
    $_SESSION['type'] = $type;
    $_SESSION['err'] = $err;

     echo $_SESSION['type'];
     echo $_SESSION['err'];

     unset($_SESSION['type']);
     unset($_SESSION['err']);

}


$type = 's';
$err = 'This is an error message';
MyReturn($type, $err);



?>


<div class="col-md-12">
    <div>
        <div class="card mx-auto">
            <div class="row">


                <div class="col-md-2">
                    <div>
                        <img class="card-img-top rounded-circle" style="width: 80px" src="../img/companyEnterprise.png" alt="Card image cap"><br>
                        Company Name
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="card-title">
                        <p class="heading">Vacancy Title<i class="far fa-compass"></i></p>
                    </div>
                    <div class="mutual">
                        <i class="fas fa-users"></i>&nbsp;&nbsp;<span>Body</span>
                        <p>Some few details here</p>
                        <p>Some few details here</p>
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
