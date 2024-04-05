    
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
        $header_text    = (isset($result['header_text'])) ? $result['header_text'] : null;
        $header_text_b  = (isset($result['header_text_b'])) ? $result['header_text_b'] : null;
        $footer_text    = (isset($result['footer_text'])) ? $result['footer_text'] : null;
        $footer_text_b  = (isset($result['footer_text_b'])) ? $result['footer_text_b'] : null;
        $image          = (isset($result['image'])) ? $result['image'] : null;
        
        $conSettings = new Settings;
        $conSettings->GetContactSetting(['status', '=', 1]);
        $query  = $conSettings->query;
        $result = $query->fetch_assoc();
        $address    = (isset($result['address'])) ? $result['address'] : null;
        $open       = (isset($result['open_time'])) ? $result['open_time'] : null;
        $email      = (isset($result['email'])) ? $result['email'] : null;
        $phone      = (isset($result['phone'])) ? $result['phone'] : null;

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

    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="contact__widget">
                        <h4>Who we are</h4></br>
                        <?php echo $header_text; ?>
                        <?php echo $footer_text; ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <div class="contact__widget">
                        <div class="card">
                            <img style="background-size:cover;" class="card-img" src="admin/images/banner/<?php echo $image; ?>" width="100%" height="450px">
                            <div class="card-img-overlay">
                                <button style="position: absolute;left: 160px;top: 200px;" type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg"><i style="font-size:50px;" class="fa fa-play-circle"></i></button>

                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                     <iframe width="100%" height="500px" src="https://www.youtube.com/embed/s6PiBZhEHak" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section Begin -->
    <section style="padding-top:0px;margin-top:0px;" class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="contact__widget">
                        <h4>Our Mission</h4>
                        <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew. Exquisite excellent son gentleman acuteness her. Do is voice total power mr ye might round still.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="contact__widget">
                        <h4>Our Vission</h4>
                        <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew. Exquisite excellent son gentleman acuteness her. Do is voice total power mr ye might round still.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="contact__widget">
                        <h4>Our Values</h4>
                        <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew. Exquisite excellent son gentleman acuteness her. Do is voice total power mr ye might round still.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="contact__widget">
                        <h4>Our Success</h4>
                        <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew. Exquisite excellent son gentleman acuteness her. Do is voice total power mr ye might round still.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Contact Section Begin -->
    <section style="padding-top:0px;margin-top:0px;" class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <div class="contact__widget">
                        <h4>Our Team</h4>
                        <p>Let meet our creative and talented human resource</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <?php

                    $team = new Team;
                    $team->getteam(['status', '=', 1]);
                    $query = $team->query;

                    while ($row = $query->fetch_assoc()) { 

                        $db_name        = $row['name'];
                        $db_title       = $row['title'];
                        $db_facebook    = $row['facebook'];
                        $db_twitter     = $row['twitter'];
                        $db_linkedin    = $row['linkedin'];
                        $db_pinterest   = $row['pinterest'];
                        $db_image       = $row['image'];
                ?>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div style="background:#f5f5f5; box-shadow: 0px 0px 5px 0px #ccc;" class="contact__widget">
                        <img style="width:100px; height:100px;" class="img-fulid rounded-circle mt-5" src="admin/images/team/<?php echo $db_image; ?>">
                        <h4><?php echo $db_name; ?></h4>
                        <p><?php echo $db_title; ?></p>
                        <div class="footer__widget py-5">
                            <div class="footer__widget__social">
                                <a href="<?php echo $db_facebook?>"><i class="fa fa-facebook"></i></a>
                                <a href="<?php echo $db_twitter?>"><i class="fa fa-twitter"></i></a>
                                <a href="<?php echo $db_linkedin?>"><i class="fa fa-linkedin"></i></a>
                                <a href="<?php echo $db_pinterest?>"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Footer Section Begin -->
    <?php require_once ('include/footer.php'); ?>