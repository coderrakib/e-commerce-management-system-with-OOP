<?php 
    
    require_once ("admin/config.php");

    if(isset($_GET['lang'])){

        $language = (string) $_GET['lang'];

        $_SESSION['lang'] = $language;

        $lang = $_SESSION['lang'];
    }

    if(isset($_SESSION['customer'])){

        $create = $_SESSION['customer'];

        $customers = new Customers;
        $customers->getcustomer(['phone', '=', $create]);
        $query  = $customers->query;
        $result = $query->fetch_assoc();

        $customer_name      = $result['name'];
        $customer_phone     = $result['phone'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quality-100</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="front-assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="front-assets/css/dataTables.bootstrap4.min.css" type="text/css">
    <link rel="stylesheet" href="front-assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="front-assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="front-assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="front-assets/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="front-assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="front-assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="front-assets/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <!--<div id="preloder">
        <div class="loader"></div>
    </div>-->
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <?php 

                $gSettings = new Settings;
                $gSettings->GetGeneralSetting(['status', '=', 1]);
                $query  = $gSettings->query;
                $result = $query->fetch_assoc();
                $logo   = (isset($result['logo'])) ? $result['logo'] : null;
            ?>
            <a href="./index.php"><img src="admin/images/logo/<?php echo $logo; ?>" alt="" width="100px"></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i><span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i><span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>&#2547;150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <?php if(!isset($lang)){?>
                    <img src="front-assets/img/language.png" alt="">
                            <div>English</div>
                    <?php } ?>

                    <?php if(isset($lang)){ ?>
                    <?php if($lang == 'en'){ ?>
                        <img src="front-assets/img/language.png" alt="">
                        <div>English</div>
                    <?php } ?>
                    <?php if($lang == 'bn'){ ?>
                        <img src="front-assets/img/bangladesh-flag-icon-32.png" alt="">
                        <div>বাংলা</div>
                    <?php } ?>
                    <?php } ?>

                    <?php 

                        $current_page = basename($_SERVER['PHP_SELF']);
                    ?>
                    <span class="arrow_carrot-down"></span>
                    <ul>
                        <li><a href="http://localhost/e-comarce/<?php echo $current_page; ?>?lang=bn">বাংলা</a></li>
                        <li><a href="http://localhost/e-comarce/<?php echo $current_page; ?>?lang=en">English</a></li>
                    </ul>
            </div>
            <?php if(isset($customer_phone)){?>
                <div class="header__top__right__customer">
                    <?php 
                        if(!empty($customer_name)){
                    ?>
                    <div> <i style='font-size:18px;' class="fa fa-user-circle"></i>&nbsp;&nbsp;&nbsp;<?php echo $customer_name; ?></div>
                    <?php }else{ ?>
                        <div> <i style='font-size:18px;' class="fa fa-user-circle"></i>&nbsp;&nbsp;&nbsp;<?php echo $customer_phone; ?></div>
                    <?php }?>
                    <span class="arrow_carrot-down"></span>
                        <ul>
                            <li><a href="profile.php">Your Profile</a></li>
                            <li><a href="your-orders.php">Your Orders</a></li>
                            <li><a href="payment-history.php">Payment History</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                </div>
                <?php }else{ ?>
                    <div class="header__top__right__auth">
                        <a <?php if($current_page == 'login-signup.php'){echo "style='color:#7fad39';";} ?> href="login-signup.php"><i style='font-size:18px;' class="fa fa-user-circle"></i> My Account </a>
                    </div>
                <?php } ?>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <?php 
    
                    $menus = new Menus;
                    $menus->GetHeaderMenus(['status','=',1]);
                    $query = $menus->query;

                    while ($row = $query->fetch_assoc()) { 

                        $db_menu        = $row['menu_item_name'];
                        $db_menu_bangla = $row['menu_item_bangla'];
                        $db_page_id     = $row['page_id'];
                    ?>
  
                    <?php 

                        $pages = new Pages;
                        $pages->getpages(['id', '=', $db_page_id, 'status','=',1]);
                        $page_query = $pages->query;

                        if(mysqli_num_rows($page_query) >= 1){

                        while ($result = $page_query->fetch_assoc()) {
                                                    
                        $page_slug = $result['page_slug'];
                    ?>
                    <?php 

                        $current_page = basename($_SERVER['PHP_SELF']);
                    ?>

                    <li <?php if($current_page == $page_slug){echo "class='active'"; }?>>
                                
                        <?php if(!isset($lang)) { ?>
                            <a href="<?php echo $page_slug; ?>"><?php echo $db_menu;; ?></a>
                        <?php } ?>
                            
                        <?php if(isset($lang)){ ?>
                            <?php if($lang == 'en'){?>
                                <a href="<?php echo $page_slug.'?lang='.$lang; ?>"><?php echo $db_menu; ?></a>
                            <?php } ?>
                            <?php if($lang == 'bn'){?>
                                <a href="<?php echo $page_slug.'?lang='.$lang;; ?>"><?php echo $db_menu_bangla; ?></a>
                            <?php } ?>
                            <?php } ?>
                           
                    </li>

                <?php } } ?>

                <?php } ?>
            </ul>
        </nav>
        <?php 

            $conSettings = new Settings;
            $conSettings->GetContactSetting(['status', '=', 1]);
            $query  = $conSettings->query;
            $result = $query->fetch_assoc();
            $email      = (isset($result['email'])) ? $result['email'] : null;
            $phone      = (isset($result['phone'])) ? $result['phone'] : null;
            $facebook   = (isset($result['facebook'])) ? $result['facebook'] : null;
            $twitter    = (isset($result['twitter'])) ? $result['twitter'] : null;
            $linkedin   = (isset($result['linkedin'])) ? $result['linkedin'] : null;
            $pinterest  = (isset($result['pinterest'])) ? $result['pinterest'] : null;
            $instagram  = (isset($result['instagram'])) ? $result['instagram'] : null;
            $youtube    = (isset($result['youtube'])) ? $result['youtube'] : null;
        ?>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="<?php echo $facebook?>"><i class="fa fa-facebook"></i></a>
            <a href="<?php echo $twitter?>"><i class="fa fa-twitter"></i></a>
            <a href="<?php echo $linkedin?>"><i class="fa fa-linkedin"></i></a>
            <a href="<?php echo $pinterest?>"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> <?php echo $email; ?></li>
                <li>Free Shipping for all Order of &#2547;99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> <?php echo $email; ?></li>
                                <li>Free Shipping for all Order of &#2547;99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="<?php echo $facebook?>"><i class="fa fa-facebook"></i></a>
                                <a href="<?php echo $twitter?>"><i class="fa fa-twitter"></i></a>
                                <a href="<?php echo $linkedin?>"><i class="fa fa-linkedin"></i></a>
                                <a href="<?php echo $pinterest?>"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <?php if(!isset($lang)){?>
                                    <img src="front-assets/img/language.png" alt="">
                                    <div>English</div>
                                <?php } ?>

                                <?php if(isset($lang)){ ?>
                                    <?php if($lang == 'en'){ ?>
                                        <img src="front-assets/img/language.png" alt="">
                                        <div>English</div>
                                    <?php } ?>
                                    <?php if($lang == 'bn'){ ?>
                                        <img src="front-assets/img/bangladesh-flag-icon-32.png" alt="">
                                        <div>বাংলা</div>
                                    <?php } ?>
                                <?php } ?>

                                <?php 

                                    $current_page = basename($_SERVER['PHP_SELF']);
                                ?>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="http://localhost/e-comarce/<?php echo $current_page; ?>?lang=bn">বাংলা</a></li>
                                    <li><a href="http://localhost/e-comarce/<?php echo $current_page; ?>?lang=en">English</a></li>
                                </ul>
                            </div>
                            <?php if(isset($customer_phone)){?>
                                <div class="header__top__right__customer">
                                    <?php 
                                        if(!empty($customer_name)){
                                    ?>
                                    <div> <i style='font-size:18px;' class="fa fa-user-circle"></i>&nbsp;&nbsp;&nbsp;<?php echo $customer_name; ?></div>
                                    <?php }else{ ?>
                                        <div> <i style='font-size:18px;' class="fa fa-user-circle"></i>&nbsp;&nbsp;&nbsp;<?php echo $customer_phone; ?></div>
                                    <?php }?>
                                    <span class="arrow_carrot-down"></span>
                                    <ul>
                                        <li><a href="profile.php">Your Profile</a></li>
                                        <li><a href="your-orders.php">Your Orders</a></li>
                                        <li><a href="payment-history.php">Payment History</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </div>
                                <?php }else{ ?>
                                <div class="header__top__right__auth">
                                    <a <?php if($current_page == 'login-signup.php'){echo "style='color:#7fad39';";} ?> href="login-signup.php"><i style='font-size:18px;' class="fa fa-user-circle"></i> My Account </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="navbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="header__logo">
                            <a href="./index.php"><img src="admin/images/logo/<?php echo $logo; ?>" alt="" width="70px" height="70px"></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <nav class="header__menu">
                            <ul>
                                <?php 
        
                                    $menus = new Menus;
                                    $menus->GetHeaderMenus(['status','=',1]);
                                    $query = $menus->query;

                                    while ($row = $query->fetch_assoc()) { 

                                    $db_menu        = $row['menu_item_name'];
                                    $db_menu_bangla = $row['menu_item_bangla'];
                                    $db_page_id     = $row['page_id'];
                                ?>
      
                                <?php 

                                    $pages = new Pages;
                                    $pages->getpages(['id', '=', $db_page_id, 'status','=',1]);
                                    $page_query = $pages->query;

                                    if(mysqli_num_rows($page_query) >= 1){

                                        while ($result = $page_query->fetch_assoc()) {
                                                        
                                            $page_slug = $result['page_slug'];
                                ?>
                                <?php 

                                    $current_page = basename($_SERVER['PHP_SELF']);
                                ?>

                                <li <?php if($current_page == $page_slug){echo "class='active'"; }?>>
                                    
                                    <?php if(!isset($lang)) { ?>
                                        <a href="<?php echo $page_slug; ?>"><?php echo $db_menu;; ?></a>
                                    <?php } ?>
                                
                                    <?php if(isset($lang)){ ?>
                                        <?php if($lang == 'en'){?>
                                                <a href="<?php echo $page_slug.'?lang='.$lang; ?>"><?php echo $db_menu; ?></a>
                                        <?php } ?>
                                        <?php if($lang == 'bn'){?>
                                                <a href="<?php echo $page_slug.'?lang='.$lang;; ?>"><?php echo $db_menu_bangla; ?></a>
                                        <?php } ?>
                                    <?php } ?>
                               
                                </li>

                                <?php } } ?>

                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <div class="header__cart">
                            <ul>
                                <li><a href="#"><i class="fa fa-heart"></i><span>1</span></a></li>
                                <li><a href="#"><i class="fa fa-shopping-bag"></i><span>3</span></a></li>
                            </ul>
                            <div class="header__cart__price">item: <span>&#2547;150.00</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <script>
        window.onscroll = function() {myFunction()};

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
          if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
          } else {
            navbar.classList.remove("sticky");
          }
        }
    </script>