<?php 
    
    require_once ('admin/config.php');

    $current_page = basename($_SERVER['PHP_SELF']);

    $page = new Pages;
    $page->getpages(['page_slug', '=', $current_page]);
    $page_query = $page->query;
    $row        = $page_query->fetch_assoc();                                            
    $page_id    = $row['id'];

    $element = new PageElements;
    $element->getelements(['page_id','=', $page_id,'status', '=', 1]);
    $query = $element->query;
    $result         = $query->fetch_assoc();
    $title          = (isset($result['banner_title'])) ? $result['banner_title'] : null;
    $title_b        = (isset($result['banner_title_bangla'])) ? $result['banner_title_bangla'] : null;
    $banner_desc    = (isset($result['banner_desc'])) ? $result['banner_desc'] : null;
    $banner_desc_b  = (isset($result['banner_desc_bangla'])) ? $result['banner_desc_bangla'] : null;
    $banner         = (isset($result['header_banner'])) ? $result['header_banner'] : null;
?>
<section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
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
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>

                    <div class="hero__item set-bg" data-setbg="admin/images/banner/<?php echo $banner; ?>">
                        <div class="overlay">    
                            <div class="hero__text">
                                <span><?php echo $title; ?></span>
                                <h2 style="color:#aaa"><?php echo $banner_desc;?></h2>
                                <p>Free Pickup and Delivery Available</p>
                                <a href="#" class="primary-btn">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>