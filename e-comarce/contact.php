    
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

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p><?php echo $phone; ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p><?php echo $address; ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p><?php echo $open; ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p><?php echo $email; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14595.529817509972!2d89.22984117198695!3d23.858307426768114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fe91f902499f97%3A0x16852cb6a43f634f!2sKumarkhali!5e0!3m2!1sen!2sbd!4v1603267295965!5m2!1sen!2sbd" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>Kumarkhali</h4>
                <ul>
                    <li>Phone: <?php echo $phone; ?></li>
                    <li>Add: <?php echo $address; ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Your message"></textarea>
                        <button type="submit" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

    <!-- Footer Section Begin -->
    <?php require_once ('include/footer.php'); ?>