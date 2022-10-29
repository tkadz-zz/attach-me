<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>
<link href="../colorlibSearch/css/main.css" rel="stylesheet" />

<style>
    div.scrollmenu {
        padding: 15px;
        overflow: auto;
        white-space: nowrap;
    }


    .logo{
        border: 1px solid #f6f6f6;
    }

    .logo img{
        width: 60px;
        height: 60px;
    }
    .card{
        display: block;
        padding: 1vh 1vh 1vh 1vh;
        border: none;
        border-radius: 15px;
        --margin-top: 5%;
        margin-bottom: 2%;
    }
    .header{
        margin-bottom: 5vh;
        margin-right: 2vh;
        float: right;
        margin-left: auto;
    }

    .far{
        color: rgba(15, 198, 239, 0.97)!important;
        font-size: 16px!important;
    }
    p.heading{
        font-weight: bold;
        font-size: 15px;
    }
    p.text-muted{
        font-size: 15px;
        font-weight: bold;
        color: #a1a7ae!important;
    }
    .btn-sm{
        border-radius: 8px;
    }
    .fas.fa-users{
        color: rgba(15, 198, 239, 0.97)!important;
    }
    .mutual span{
        font-size: 14px;
        color: #adb5bd;
        font-weight: bold;
    }
    .btn-primary.btn-lg{
        border-radius: 30px;
        border: none;
        background: #6509a1;
    }

    .btn-primary.btn-lg:hover{
        background: #9417e8;
    }

    .btn-dark.btn-lg{
        border-radius: 30px;
        width: 90%;
        border: none;
        background: #dee2e6;
    }
    .btn-dark span{
        font-size: 12px;
        text-align: center;
        color: #0000008c;
        font-weight: bold;
    }
    .btn-primary span{
        font-size: 12px;
        text-align: center;
        color: #fff;
        font-weight: bold;
    }
</style>



<div class="mt-4 mb-4">
        <div class="s003 col-md-6 shadow-sm">
            <form>
                <div class="inner-form">
                    <!--
                    <div class="input-field first-wrap">
                        <div class="input-select">

                            <select data-trigger="" name="choices-single-defaul">
                                <option placeholder="">Category</option>
                                <option>New Arrivals</option>
                                <option>Sale</option>
                                <option>Ladies</option>
                                <option>Men</option>
                                <option>Clothing</option>
                                <option>Footwear</option>
                                <option>Accessories</option>
                            </select>
                        </div>
                    </div>
                    -->
                    <div class="input-field second-wrap">
                        <input id="search" type="text" placeholder="Search Vacancies..." />
                    </div>
                    <div class="input-field third-wrap">
                        <button class="btn-search" type="button">
                            <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    <br>
    <br>
    <div class="container px-0 py-4">
        <div class="pp-category-filter">
            <div class="row">
                <div class="col-sm-12">
                    <span class="alert text-decoration-underline">Vacancy Filter <span class="fa fa-arrow-circle-down"></span> </span>
                    <br>
                    <div class="scrollmenu">
                        <a data-toggle="tooltip" data-placement="right" title="View All Vacancies" class="btn btn-primary pp-filter-button" href="vacancies.php" data-filter="all">All</a>
                        <?php
                        $nl = new StudentView();
                        $nl->categoryShortLoops();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <?php
    if(isset($_GET['filter'])){
        ?>
        <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
        <br>
        <br>
        <span class="card-description" style="font-size: 12px">Showing: <span class="badge badge-info text-dark"><?php echo $_GET['filter'] ?></span> Category</span>
        <br>
        <br>
        <?php
    }
    ?>

    <div class="row">

        <?php
        $today = date('Y-m-d');
        $records = 8;
        if(isset($_GET['filter'])){
            $fid = $_GET['fid'];
            $query = "SELECT * FROM vacancies WHERE cartegory='$fid' AND expiryDate >= '$today' AND dateOnline <='$today' AND status=1 ORDER BY id DESC";
        }
        else{
            $query = "SELECT * FROM vacancies WHERE expiryDate >= '$today' AND dateOnline <='$today' AND status=1 ORDER BY id DESC";
        }
        $p = new PignationView();
        $p->vacancyLoop($records, $query);
        ?>


    </div>

</div>


<script src="../colorlibSearch/js/extention/choices.js"></script>
<script>
    const choices = new Choices('[data-trigger]',
        {
            searchEnabled: false,
            itemSelectText: '',
        });

</script>




<?php
include 'includes/emptyLayoutBottom.inc.php';
?>
