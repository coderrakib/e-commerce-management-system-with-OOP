<?php 
    
    require_once ("admin/config.php");

    $conSettings = new Settings;
    $conSettings->GetContactSetting(['status', '=', 1]);
    $query  = $conSettings->query;
    $result = $query->fetch_assoc();
    $address    = (isset($result['address'])) ? $result['address'] : null;
    $email      = (isset($result['email'])) ? $result['email'] : null;
    $phone      = (isset($result['phone'])) ? $result['phone'] : null;
    $facebook   = (isset($result['facebook'])) ? $result['facebook'] : null;
    $twitter    = (isset($result['twitter'])) ? $result['twitter'] : null;
    $linkedin   = (isset($result['linkedin'])) ? $result['linkedin'] : null;
    $pinterest  = (isset($result['pinterest'])) ? $result['pinterest'] : null;
    $instagram  = (isset($result['instagram'])) ? $result['instagram'] : null;
    $youtube    = (isset($result['youtube'])) ? $result['youtube'] : null;

    $gSettings = new Settings;
    $gSettings->GetGeneralSetting(['status', '=', 1]);
    $query  = $gSettings->query;
    $result = $query->fetch_assoc();
    $footer = (isset($result['footer_text'])) ? $result['footer_text'] : null;
    $logo   = (isset($result['logo'])) ? $result['logo'] : null;
?>
<footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.php"><img src="admin/images/logo/<?php echo $logo;?>" alt="" width="70px" height="70px"></a>
                        </div>
                        <ul>
                            <li>Address: <?php echo $address; ?></li>
                            <li>Phone: <?php echo $phone; ?></li>
                            <li>Email: <?php echo $email; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <?php 
    
                                $menus = new Menus;
                                $menus->GetFooterMenus(['status','=',1]);
                                $query = $menus->query;

                                while ($row = $query->fetch_assoc()) { 

                                    $db_menu        = $row['menu_item_name'];
                                    $db_menu_bangla = $row['menu_item_bangla'];
                                    $db_page_id     = $row['page_id'];
                                ?>
              
                                <?php 

                                    $pages = new Pages;
                                    $pages->getpages(['id', '=', $db_page_id]);
                                    $page_query = $pages->query;

                                    if(mysqli_num_rows($page_query) >= 1){

                                    while ($result = $page_query->fetch_assoc()) {
                                                                
                                    $page_slug = $result['page_slug'];
                                ?>
                                <?php 

                                    $current_page = basename($_SERVER['PHP_SELF']);
                                ?>

                                <li>
                                            
                                    <?php if(!isset($lang)) { ?>
                                        <a <?php if($current_page == $page_slug){echo "style='color:#7fad39;'"; }?> href="<?php echo $page_slug; ?>"><?php echo $db_menu;; ?></a>
                                    <?php } ?>
                                        
                                    <?php if(isset($lang)){ ?>
                                        <?php if($lang == 'en'){?>
                                            <a <?php if($current_page == $page_slug){echo "style='color:#7fad39;'"; }?> href="<?php echo $page_slug.'?lang='.$lang; ?>"><?php echo $db_menu; ?></a>
                                        <?php } ?>
                                        <?php if($lang == 'bn'){?>
                                            <a <?php if($current_page == $page_slug){echo "style='color:#7fad39;'"; }?> href="<?php echo $page_slug.'?lang='.$lang;; ?>"><?php echo $db_menu_bangla; ?></a>
                                    <?php } ?>
                                    <?php } ?>   
                                </li>

                            <?php } } ?>

                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="<?php echo $facebook?>"><i class="fa fa-facebook"></i></a>
                            <a href="<?php echo $twitter?>"><i class="fa fa-twitter"></i></a>
                            <a href="<?php echo $linkedin?>"><i class="fa fa-linkedin"></i></a>
                            <a href="<?php echo $pinterest?>"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><?php echo $footer; ?></div>
                        <div class="footer__copyright__payment">
                            <img class="mr-2" src="front-assets/img/bkash.png" alt="" width="60px">
                            <img class="" src="front-assets/img/nagad.png" alt="" width="60px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="front-assets/js/jquery-3.3.1.min.js"></script>
    <script src="front-assets/js/bootstrap.min.js"></script>
    <script src="front-assets/js/jquery.nice-select.min.js"></script>
    <script src="front-assets/js/jquery-ui.min.js"></script>
    <script src="front-assets/js/jquery.slicknav.js"></script>
    <script src="front-assets/js/mixitup.min.js"></script>
    <script src="front-assets/js/owl.carousel.min.js"></script>
    <script src="front-assets/js/jquery.dataTables.min.js"></script>
    <script src="front-assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="front-assets/js/datatables-demo.js"></script>
    
    <script src="front-assets/js/main.js"></script>
</body>
</html>