<?php

class Pignation extends Users
{



    public function admindataview($query)
    {
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if(count($rows) > 0)
        {
            $s = 0;
            ?>
            <?php
            foreach($rows as $row)
            {
                $artcateg = $this->GetCategoryById($row['category']);
                $file_ext   =   explode('.',$row['source']);
                $s++;
                ?>

                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <a class="text-decoration-none" href="adminArtDetails.php?artID=<?php echo $row['id'] ?>">
                        <div class="bg-white rounded shadow-sm">
                            <img style="height: 250px" src="<?php echo $row['source'] ?>" alt="" class="img-fluid card-img-top">
                            <div class="p-4">
                                <h5> <span class="text-dark"><?php echo $row['name'] ?></span></h5>
                                <p class="small text-muted mb-0">Name: <?php echo $row['name'] ?> <br> Author: <?php echo $row['author'] ?></p>
                                <p class="small text-muted mb-0">Status:
                                    <?php
                                    if($row['status'] == 1){
                                        ?>
                                        <span class="badge badge-success"><span class="mdi mdi-check"></span> Online</span>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <span class="badge badge-warning"><span class="mdi mdi-power"></span> Offline</span>
                                        <?php
                                    }
                                    ?>
                                </p>
                                <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                    <p class="small mb-0 text-dark">
                                        <i class="fa fa-picture-o mr-2"></i>
                                        <span class="font-weight-bold">
                                        <?php
                                        if($file_ext[1] == 'png' || $file_ext[1] == 'jpg' || $file_ext[1] == 'jpeg'){
                                            echo $file_ext[1];
                                        }
                                        elseif($file_ext[2] == 'png' || $file_ext[2] == 'jpg' || $file_ext[2] == 'jpeg'){
                                            echo $file_ext[2];
                                        }
                                        elseif($file_ext[3] == 'png' || $file_ext[3] == 'jpg' || $file_ext[3] == 'jpeg'){
                                            echo $file_ext[3];
                                        }
                                        else{
                                            echo 'extenion error!';
                                        }


                                        ?>
                                    </span>
                                    </p>
                                    <div class="badge badge-danger px-3 rounded-pill font-weight-normal"><?php echo $artcateg[0]['name'] ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
            <?php
        }
        else
        {
            ?>
            <hr>
            <div class="container px-0">
                <div class="pp-gallery">
                    <div class="-card-columns">
                        <div class="alert alert-danger" role="alert">
                            <span class="mdi mdi-information-outline"></span> No Art is available at the moment. Please check back in the future
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

    }





    public function dataview($query)
    {
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if(count($rows) > 0)
        {
            $s = 0;
            ?>
            <div class="-px-0">
                <div class="pp-gallery">
                    <div class="card-columns">
                        <?php
                        foreach($rows as $row)
                        {
                            $artcateg = $this->GetCategoryById($row['category']);

                            $s++;
                            ?>
                            <div class="card shadow-sm" data-groups="[&quot;<?php echo $artcateg[0]['name'] ?>&quot;]">
                                <a href="artDetails.php?art=<?php echo $row['id'] ?>">
                                    <figure class="pp-effect">
                                        <img style="height: 380px" class="img-fluid" src="<?php echo $row['source'] ?>" alt="<?php echo $row['source'] ?>"/>
                                        <figcaption>
                                            <div class="h4"><?php echo $row['name'] ?></div>
                                            <p><?php echo $row['author'] ?></p>
                                            <p><?php echo $artcateg[0]['name'] ?></p>
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        else
        {
            ?>
            <hr>
            <div class="container px-0">
                <div class="pp-gallery">
                    <div class="-card-columns">
                        <div class="alert alert-danger" role="alert">
                            <span class="mdi mdi-information-outline"></span> No Art is available at the moment. Please check back in the future
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