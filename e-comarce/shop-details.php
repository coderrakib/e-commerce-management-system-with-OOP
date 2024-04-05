    <?php 

        require_once ('admin/config.php'); 

        $product_id     =  (string) $_GET['id'];

        $p_details      = new Products;
        $p_details->getproduct(['product_id','=',$product_id,'status','=',1]);
        $p_query        = $p_details->query;
        $result         = $p_query->fetch_assoc();
        $p_name         = $result['product_name'];
        $p_cat          = $result['product_category'];
        $p_image        = $result['product_image'];
        $p_short_dec    = $result['product_short_dec'];
        $p_short_dec_b  = $result['product_short_dec_b'];
        $p_weight       = $result['product_weight'];
        $p_weight_b     = $result['product_weight_b'];
        $p_weight_type  = $result['product_weight_type'];
        $p_prize        = $result['product_price'];
        $dis_prize      = $result['discount_price'];
        $dis_prize_b    = $result['discount_price_b'];
        $p_dec          = $result['product_dec'];
        $p_info         = $result['product_info'];

        $parsent        = $dis_prize / 100;
        $minas          = $p_prize * $parsent;
        $total          = $p_prize - $minas;


        $parent_category  = new Categories;
        $parent_category->getcategories(['category_name','=',$p_cat,'status','=',1]);
        $parent_query = $parent_category->query;
        $result       = $parent_query->fetch_assoc();

        $parent_name    = $result['parent_name'];
    ?>
    <!-- Header Section Start-->
    <?php require_once ('include/header.php'); ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <?php require_once ('include/hero-normal.php'); ?>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="admin/images/products/<?php echo $p_image?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2><?php echo $parent_name; ?></h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <a href="./shop.php">Shop</a>
                            <span><?php echo $p_cat; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="admin/images/products/<?php echo $p_image;?>" alt="" width="540" height="560">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <?php 

                                $slider_limit = new OrderByLimit;
                                $slider_limit->GetLimitProduct(['status', '=', 1],'id','DESC',48);
                                $slider_query = $slider_limit->query;

                                while ($result = $slider_query->fetch_assoc()) {

                                    $p_id       = $result['product_id'];
                                    $p_image    = $result['product_image'];       
                            ?>
                            <a href="shop-details.php?id=<?php echo $p_id; ?>" title="">
                                <img src="admin/images/products/<?php echo $p_image; ?>" alt="" width="120" height="120">
                            </a>
                            <?php } ?>
                        
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo ucwords($p_name); ?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">
                            <?php
                                if(isset($dis_prize)){
                                    echo '&#2547; '.$total.'.00';
                                    echo " <del>&#2547; $p_prize.00</del>";
                                }else{
                                    echo '&#2547; '.$p_prize.'.00';
                                }
                            ?>
                        </div>
                        <p><?php echo $p_short_dec; ?></p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">ADD TO CARD</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping.</span></li>
                            <li><b>Weight</b> <span><?php echo $p_weight; ?> <?php echo $p_weight_type; ?></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Description</h6>
                                    <p><?php echo $p_dec; ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p><?php echo $p_info; ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Reviwes</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 

                    $parent_category  = new Categories;
                    $parent_category->getcategories(['category_name','=',$p_cat,'status','=',1]);
                    $parent_query = $parent_category->query;
                    $result       = $parent_query->fetch_assoc();

                    $parent_name    = $result['parent_name'];

                    $p_related      = new Products;
                    $p_related->getproduct(['parent_name','=',$parent_name,'status','=',1]);
                    $related_query  = $p_related->query;

                    while ($result = $related_query->fetch_assoc()) {
                        
                        $p_name         = $result['product_name'];
                        $p_image        = $result['product_image'];
                        $p_prize        = $result['product_price'];
                        $dis_prize      = $result['discount_price'];
                        $dis_prize_b    = $result['discount_price_b'];
                        
                        $parsent        = $dis_prize / 100;
                        $minas          = $p_prize * $parsent;
                        $total          = $p_prize - $minas;          
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="admin/images/products/<?php echo $p_image?>">
                            <?php if(isset($dis_prize)){ ?>
                            <div class='product_dis_parsent'>-<?php echo $dis_prize; ?> %</div>
                            <?php } ?>
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#"><?php echo $p_name; ?></a></h6>
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
        </div>
    </section>
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    <?php require_once ('include/footer.php'); ?>