
<?php require_once ('admin/config.php'); ?>

<section class="hero hero-normal">
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
                </div>
            </div>
        </div>
    </section>