<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
include 'includes/subAccSessionFilter.inc.php';
?>

<link href="../colorlibSearch/css/main.css" rel="stylesheet" />
<style>
    form {
        width: 50%;
    }

    .hide {
        display: none;
    }

    .show {
        display: block;
    }
</style>

<br>

<div class="container px-0">
    <div class="pp-gallery">
        <div class="-card-columns">
            <div class="alert alert-info text-dark" role="alert">
                we understand that <?php echo $_SESSION['name'] ?> might have many ways to deploy vacancies and get responses.<br>
                In that case, this page allows you to search students using the National ID they have provided on their CV in order to attach them securely
                <br>
                <br>
                <span class="mdi mdi-information-outline"></span> Search Rules <br><br>
                <ul>
                    <li>Search is for registered student accounts only</li>
                    <li>Search works only with National ID</li>
                    <li>National ID should be 12 or 13 characters long to search</li>
                    <li>format should be as follows: 01-234567R89</li>
                    <br>
                    <strong>NB: This setup is done to protect other student's privacy</strong>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 mb-4">

    <div class="s003 col-md-6 shadow-sm">
        <form method="POST" action="includes/studentAccSearch.inc.php">
            <div class="inner-form">
                <div class="input-field second-wrap">
                    <input <?php if(isset($_SESSION['search'])){?> value="<?php echo $_SESSION['search'] ?>" <?php } ?> id="search"  name="search" type="text" placeholder="Enter full National ID(xx-xxxxxxRxx)" pattern="[-a-zA-Z0-9]+" minlength="12" maxlength="13" required/>
                </div>
                <div class="input-field third-wrap">
                    <button class="btn-search" name="btn-search" type="submit">
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
</div>


<?php
if(isset($_SESSION['search'])){
    $nID = $_SESSION['search'];
    unset($_SESSION['search']);

    $n = new Usercontr();
    $rows = $n->studentSearch($nID);
    if($rows == NULL){
        ?>
        <div class="container px-0">
            <div class="pp-gallery">
                <div class="-card-columns">
                    <div class="alert alert-warning text-dark" role="alert">
                        <span class="mdi mdi-information-outline"></span> Student Account Not Found. Make sure <br><br>
                        <ul>
                            <li>Student is registered on Attach-Me Platform</li>
                            <li>National ID is correct</li>
                            <li>If problem persist, contact system administrator</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    else{
        $userID = $rows[0]['user_id'];

        $_SESSION['type'] = 's';
        $_SESSION['err'] = 'Student Account Found';
        echo "<script type='text/javascript'>
                window.location='studentProfile.php?userID=$userID&nID=$nID';
              </script>";
    }
}
?>




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


