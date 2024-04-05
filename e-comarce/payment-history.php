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

    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <h3 class="card-header">Your Payment Histories</h3>
                        <div class="card-body">
                        	<div class="table-responsive">
                        		<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
								  <thead>
								    <tr>
								      <th scope="col">#</th>
								      <th scope="col">First</th>
								      <th scope="col">Last</th>
								      <th scope="col">Handle</th>
								    </tr>
								  </thead>
								  <tbody>
								    <tr>
								      <th scope="row">2</th>
								      <td>Jacob</td>
								      <td>Thornton</td>
								      <td>@fat</td>
								    </tr>
								    <tr>
								      <th scope="row">3</th>
                                      <td>Larry the Bird</td>
								      <td>Larry the Bird</td>
								      <td>@twitter</td>
								    </tr>
								  </tbody>
								</table>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Section Begin -->

    <?php require_once ('include/footer.php'); ?>
