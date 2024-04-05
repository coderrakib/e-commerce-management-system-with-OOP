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

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                <?php 

                                $Maincategories = new Categories;
                                $Maincategories->getcategories(['parent_name', '=','', 'status', '=', 1]);
                                $Mainquery = $Maincategories->query;

                                while ($resultMainCategory  = $Mainquery->fetch_assoc()) {
                                                        
                                    $MainCategory = $resultMainCategory['category_name'];
                            ?>
                            <li><a href="#"><?php echo $MainCategory; ?></a>
                                
                                <ul>
                                    <?php

                                        $Subcategories = new Categories;
                                        $Subcategories->getcategories(['parent_name', '=', $MainCategory, 'status', '=', 1]);
                                        $Subquery = $Subcategories->query;

                                        if(mysqli_num_rows($Subquery) >= 1){

                                            while ( $resultSubCategory = $Subquery->fetch_assoc()) {
                                                
                                                $SubCategory = $resultSubCategory['category_name'];

                                                echo "<li><a href='#'>$SubCategory</a></li>";
                                            }
                                        }
                                    ?>
                                </ul>
                               
                            </li>
                                
                            <?php } ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <?php 

                                        $slider_limit = new OrderByLimit;
                                        $slider_limit->GetLimitProduct(['status', '=', 1],'id','DESC',12);
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
                                                <?php if(isset($dis_prize)){?>
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
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Review Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <?php 

                                        $slider_limit = new OrderByLimit;
                                        $slider_limit->GetLimitProduct(['status', '=', 1],'id','DESC',12);
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
                                                <?php if(isset($dis_prize)){?>
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
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <?php 

                                    $discount       = new OrderByLimit;
                                    $discount->GetOrderByProduct(['dis_check','=',1, 'status', '=', 1],'id','DESC');
                                    $discount_query = $discount->query;

                                    while ($result  = $discount_query->fetch_assoc()) {

                                    $p_id           = $result['product_id'];
                                    $p_category     = $result['product_category'];
                                    $p_name         = $result['product_name'];
                                    $p_name_b       = $result['product_name_b'];
                                    $p_prize        = $result['product_price'];
                                    $p_prize_b      = $result['product_price_b'];
                                    $dis_prize      = $result['discount_price'];
                                    $dis_prize_b    = $result['discount_price_b'];
                                    $p_image        = $result['product_image'];

                                    $parsent        = $dis_prize / 100;
                                    $minas          = $p_prize * $parsent;
                                    $total          = $p_prize - $minas;
    
                                ?>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="admin/images/products/<?php echo $p_image; ?>">
                                            <div class="product__discount__percent">-<?php echo $dis_prize; ?>%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            
                                            <?php 

                                                $p_categories = new Categories;
                                                $p_categories->getcategories(['category_name', '=', $p_category, 'status', '=', 1]);
                                                $p_query   = $p_categories->query;

                                                if(mysqli_num_rows($p_query) >= 1){

                                                while ($result_category  = $p_query->fetch_assoc()) {
                                                                    
                                                    $category = $result_category['parent_name'];
                                            ?>
                                            <span><?php echo $category; ?></span>

                                            <?php } } ?>

                                            <h5><a href="shop-details.php?id=<?php echo $p_id ?>"><?php echo $p_name; ?></a></h5>
                                            <div class="product__item__price">৳<?php echo $total.'.00';?> <span>৳<?php echo $p_prize.'.00';?></span></div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6>
                                        <span>
                                            <?php 

                                                $p_related      = new Products;
                                                $p_related->getproduct(['status','=',1]);
                                                $related_query  = $p_related->query;

                                                $num_rows = mysqli_num_rows($related_query);

                                                echo $num_rows;
                                            ?>
                                        </span> Products found
                                    </h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php 

                            $orderby        = new OrderByLimit;
                            $orderby->GetOrderByProduct(['status', '=', 1],'id','DESC');
                            $orderby_query  = $orderby->query;

                            while ($result = $orderby_query->fetch_assoc()) {

                            $p_id       = $result['product_id'];
                            $p_name     = $result['product_name'];
                            $p_name_b   = $result['product_name_b'];
                            $p_prize    = $result['product_price'];
                            $p_prize_b  = $result['product_price_b'];
                            $dis_prize      = $result['discount_price'];
                            $dis_prize_b    = $result['discount_price_b'];
                            $p_image    = $result['product_image'];

                            $parsent        = $dis_prize / 100;
                            $minas          = $p_prize * $parsent;
                            $total          = $p_prize - $minas;
                                
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="admin/images/products/<?php echo $p_image; ?>">
                                    <?php if(isset($dis_prize)){ ?>
                                        <div class="product_dis_parsent">-<?php echo $dis_prize; ?>%</div>
                                    <?php } ?>
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="shop-details.php?id=<?php echo $p_id ?>"><?php echo $p_name; ?></a></h6>
                                    <?php if(isset($dis_prize)){?>
                                        <h5>৳<?php echo $total.'.00';?>&nbsp;<span><del>৳<?php echo $p_prize.'.00';?></del></span></h5>
                                    <?php }else{ ?>
                                        <h5>৳<?php echo $p_prize.'.00';?></h5>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Section Begin -->
    <?php require_once ('include/footer.php'); ?>