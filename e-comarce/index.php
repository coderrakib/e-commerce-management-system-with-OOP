    <?php require_once ('admin/config.php'); ?>
    <!-- Header Section Start -->
    <?php require_once ('include/header.php'); ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
     <?php require_once ('include/hero.php'); ?>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php 

                        $discount       = new OrderByLimit;
                        $discount->GetOrderByProduct(['status', '=', 1],'id','DESC');
                        $discount_query = $discount->query;

                        while ($result  = $discount_query->fetch_assoc()) {

                            $p_id           = $result['product_id'];
                            $p_category     = $result['product_category'];
                            $p_image        = $result['product_image'];
                    ?>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="admin/images/products/<?php echo $p_image?>">
                            <?php 

                                $p_categories = new Categories;
                                $p_categories->getcategories(['category_name', '=', $p_category, 'status', '=', 1]);
                                $p_query   = $p_categories->query;

                                if(mysqli_num_rows($p_query) >= 1){

                                    while ($result_category  = $p_query->fetch_assoc()) {
                                                                    
                                    $category = $result_category['parent_name'];
                            ?>
                                <h5><a href="#"><?php echo $category; ?></a></h5>

                            <?php } } ?>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>

                            <li class='active' data-filter='*'>All</li>

                            <?php 

                                $limit = new OrderByLimit;
                                $limit->GetLimitCategory(['parent_name', '=','', 'status', '=', 1],'id','DESC',5);
                                $query = $limit->query;

                                $tab_menu    = '';
                                $tab_content = '';
                                
                                while ($result = $query->fetch_assoc()) {
                                   
                                    $category = $result['category_name'];
                                    $id       = $result['id'];       
                                        
                                    $nospace  = str_replace(' ', '', $category);
                                    $tab_menu .= "<li data-filter='.$nospace'> $category</li>";
                                   
                                    $p_categories = new Categories;
                                    $p_categories->getcategories(['parent_name', '=', $category, 'status', '=', 1]);
                                    $p_query   = $p_categories->query;

                                        if(mysqli_num_rows($p_query) >= 1){

                                            while ($result_category  = $p_query->fetch_assoc()) {
                                                                    
                                                $sub_category = $result_category['category_name'];
                                        

                                                $orderby        = new OrderByLimit;
                                                $orderby->GetOrderByProduct(['product_category','=',$sub_category,'status', '=', 1],'id','DESC');
                                                $orderby_query  = $orderby->query;

                                                while ($result = $orderby_query->fetch_assoc()) {

                                                $p_id       = $result['product_id'];
                                                $p_name     = $result['product_name'];
                                                $p_category = $result['product_category'];
                                                $p_name_b   = $result['product_name_b'];
                                                $p_prize    = $result['product_price'];
                                                $p_prize_b  = $result['product_price_b'];
                                                $dis_prize      = $result['discount_price'];
                                                $dis_prize_b    = $result['discount_price_b'];
                                                $p_image    = $result['product_image'];

                                                $parsent        = $dis_prize / 100;
                                                $minas          = $p_prize * $parsent;
                                                $total          = $p_prize - $minas;
                                            
                                                $tab_content .= "<div class='col-lg-3 col-md-4 col-sm-6 mix $nospace'>
                                                    <div class='featured__item'>
                                                        <div class='featured__item__pic set-bg' data-setbg='admin/images/products/$p_image'>";
                                                            if(isset($dis_prize)){ 
                                                        $tab_content .= "<div class='product_dis_parsent'>-$dis_prize %</div>";
                                                        } 
                                                            
                                                        $tab_content .= "<ul class='featured__item__pic__hover'>
                                                                <li><a href='#'><i class='fa fa-heart'></i></a></li>
                                                                <li><a href='#'><i class='fa fa-retweet'></i></a></li>
                                                                <li><a href='#'><i class='fa fa-shopping-cart'></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class='featured__item__text'>
                                                            <h6><a href='shop-details.php?id=$p_id'>$p_name</a></h6>";
                                                            if(isset($dis_prize)){
                                                                $tab_content .= "<h5>৳$total.00&nbsp;<span><del>৳$p_prize.00</del></span></h5>";
                                                            }
                                                            else{ 
                                                                $tab_content .= "<h5>৳$p_prize.00</h5>";
                                                            } 
                                                        $tab_content .= "</div>
                                                    </div>
                                                </div>";
                                            }   
                                        }
                                    }

                                ?>
                            
                            <?php } ?>

                            <?php echo $tab_menu; ?>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php 

                    echo $tab_content;              
                ?>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->
    <?php
        
        $current_page = basename($_SERVER['PHP_SELF']);

        $page = new Pages;
        $page->getpages(['page_slug', '=', $current_page]);
        $page_query = $page->query;
        $row        = $page_query->fetch_assoc();                                            
        $page_id    = $row['id'];

        $element = new PageElements;
        $element->getelements(['page_id','=', $page_id,'status', '=', 1]);
        $query = $element->query;
        $result = $query->fetch_assoc();

        $footer_1   = (isset($result['footer_banner_1'])) ? $result['footer_banner_1'] : null;
        $footer_2   = (isset($result['footer_banner_2'])) ? $result['footer_banner_2'] : null;
    ?>
    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="admin/images/banner/<?php echo $footer_1; ?>" alt="" width="100%" height="270px;">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="admin/images/banner/<?php echo $footer_2; ?>" alt="" width="100%" height="270px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <?php 

                                $slider_limit = new OrderByLimit;
                                $slider_limit->GetLimitProduct(['status', '=', 1],'id','DESC',48);
                                $slider_query = $slider_limit->query;

                                while ($result = $slider_query->fetch_assoc()) {

                                    $p_id       = $result['product_id'];
                                    $p_name     = $result['product_name'];
                                    $p_name_b   = $result['product_name_b'];
                                    $p_prize    = $result['product_price'];
                                    $p_prize_b  = $result['product_price_b'];
                                    $p_image    = $result['product_image'];
                                    $p_prize    = $result['product_price'];
                                    $p_prize_b  = $result['product_price_b'];
                                    $dis_prize      = $result['discount_price'];
                                    $dis_prize_b    = $result['discount_price_b'];

                                    $parsent        = $dis_prize / 100;
                                    $minas          = $p_prize * $parsent;
                                    $total          = $p_prize - $minas;

                            ?>
                            <div class="latest-prdouct__slider__item">
                                <a href="shop-details.php?id=<?php echo $p_id ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width:110px;height:110px;" src="admin/images/products/<?php echo $p_image; ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $p_name; ?></h6>
                                        <?php if(isset($dis_prize)){ ?>
                                        <span>৳<?php echo $total.'.00';?></span>
                                        <?php }else{ ?>
                                        <span>৳<?php echo $p_prize.'.00';?></span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="front-assets/img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Footer Section Begin -->
    <?php require_once ('include/footer.php'); ?>
    <!-- Footer Section End -->

    