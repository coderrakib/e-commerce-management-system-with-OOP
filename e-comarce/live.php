    <?php require_once ('admin/config.php'); ?>
    <!-- Header Section Start -->
    <?php require_once ('include/header.php'); ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <?php require_once ('include/hero-normal.php'); ?>
    <!-- Hero Section End -->
    <?php
        
       $current_page = basename($_SERVER['PHP_SELF']);

        $page = new Pages;
        $page->getpages(['page_slug', '=', $current_page]);
        $page_query = $page->query;
        $row        = $page_query->fetch_assoc();                                            
        $page_id    = $row['id'];

        $element = new PageElements;
        $element->getelements(['page_id','=', $page_id,'status', '=', 1]);
        $query   = $element->query;
        $result         = $query->fetch_assoc();
        $title          = (isset($result['banner_title'])) ? $result['banner_title'] : null;
        $title_b        = (isset($result['banner_title_bangla'])) ? $result['banner_title_bangla'] : null;
        $banner         = (isset($result['header_banner'])) ? $result['header_banner'] : null;

    ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="admin/images/banner/<?php echo $banner; ?>">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2><?php echo $title; ?></h2>
                            <div class="breadcrumb__option">
                                <a href="./index.php">Home</a>
                                <span><?php echo $title; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">

                <?php 

                    $video = new Videos;
                    $video->getvideo();
                    $v_query = $video->query;

                    while ($row = $v_query->fetch_assoc()) { 

                        $id             = $row['id'];
                        $db_title       = $row['video_title'];
                        $db_title_b     = $row['video_title_b'];
                        $db_thumbnail   = $row['video_thumbnail'];
                        $db_video       = $row['video'];
                ?>
               
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div style="border:3px solid #aaa;" class="product__item__pic set-bg" data-setbg="admin/videos/<?php echo $db_thumbnail; ?>"> 
                            
                            <button style="position: absolute;left: 150px;top: 110px; outline:none; border:none;" type="button" class="btn btn-dark" data-toggle="modal" data-target="#bd-example-modal-lg-<?php echo $id; ?>"><i style="font-size:40px; color:#7fad39;" class="fa fa-play-circle"></i></button>
                            
                            <div class="modal fade" id="bd-example-modal-lg-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                            <video style="outline:none;" width="100%" height="500" controls>
                                              <source src="admin/videos/<?php echo $db_video; ?>" type="video/mp4">
                                            </video>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#"><?php echo $db_title; ?></a></h6>
                       	</div>
                    </div>
                </div> 
                <?php } ?>    
           	</div>
        </div>
    </div>
    <!-- Contact Form End -->

    <!-- Footer Section Begin -->
    <?php require_once ('include/footer.php'); ?>
