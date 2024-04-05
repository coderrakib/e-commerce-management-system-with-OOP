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

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">

                    <?php

                        if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){

                            $phone      = $_POST['phone'];
                            $pass       = $_POST['pass'];
                            $con_pass   = $_POST['con_pass'];
                            $hash_pass  = hash('sha512', $pass);
                            
                            $customer_id  = 'QUL'.rand(1000, 99999);

                            $form_data  = array(

                                array(

                                    'field_name'    => 'phone',
                                    'name'          => 'Customer Phone',
                                    'required'      => true,
                                    'min'           => 11,
                                    'max'           => 11,
                                    'unique'        => true,
                                    'table'         => 'customers',
                                    'column'        => 'phone'
                                ),

                                array(

                                    'field_name'    => 'pass',
                                    'name'          => 'Password',
                                    'required'      => true,
                                    'min'           => 6,
                                    'max'           => 30,
                                    'matching'      => $pass 
                                ),

                                array(

                                    'field_name'    => 'con_pass',
                                    'name'          => 'Confirm Password',
                                    'required'      => true,
                                    'min'           => 6,
                                    'max'           => 30,
                                    'matching'      => $pass 
                                ),
                            );

                            $validation     = new Validation;
                            $validation->validate($form_data);

                            if($validation->hasErrorPassed){

                                $insert = new Customers;

                                if($insert->addcustomer($customer_id,$phone,$hash_pass)){
                                    
                                    $message[] = "Successfully Sign Up";

                                    $_SESSION['customer'] = $phone;

                                    $_SESSION['messages']   = $message;
                                    $_SESSION['class_name'] = 'alert-success';

                                    require_once ('messages.php');

                                    echo "<script>
                                     setTimeout(function(){
                                        window.location.href = 'profile.php';
                                     }, 2000);
                                    </script>" ;

                                }else{

                                    $message[] = "Something is Wrong .. Try again";

                                    $_SESSION['messages']   = $message;
                                    $_SESSION['class_name'] = 'alert-danger';

                                    require_once ('messages.php');
                                }
                            }
                        }
                    ?>


                    <div style="border:1px solid #ddd; padding:20px;">
                        <div class="contact__form__title">
                            <h2>Sign Up</h2>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <input type="text" name="phone" placeholder="Your Phone">
                            <input type="password" name="pass" placeholder="Password (Minimum 6 Characters)">
                            <input type="password" name="con_pass" placeholder="Confirm password">
                            
                            <button type="submit" name="submit" class="site-btn mb-4">SIGN UP</button>
                        </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <?php

                            if(isset($_POST['login']) && $_SERVER["REQUEST_METHOD"] == "POST"){

                                $log_phone      = $_POST['log_phone'];
                                $log_pass       = $_POST['log_pass'];
                                $log_hash_pass  = hash('sha512', $log_pass);

                                    $form_data  = array(

                                    array(

                                        'field_name'    => 'log_phone',
                                        'name'          => 'Customer Phone',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'log_pass',
                                        'name'          => 'Password',
                                        'required'      => true,
                                    ),
                                );

                                $validation     = new Validation;
                                $validation->validate($form_data);

                                if($validation->hasErrorPassed){

                                    $login  = new Customers;

                                    if($login->customerLogin($log_phone, $log_hash_pass)){
                                            
                                        $message[] = "Successfully Login";

                                        $_SESSION['customer']   = $log_phone;

                                        $_SESSION['messages']   = $message;
                                        $_SESSION['class_name'] = 'alert-success';

                                        require_once ('messages.php');

                                        echo "<script>
                                        setTimeout(function(){
                                            window.location.href = 'profile.php';
                                         }, 2000);
                                        </script>";

                                    }else{

                                        $message[] = "Customer Phone or Password is Wrong !";

                                        $_SESSION['messages']   = $message;
                                        $_SESSION['class_name'] = 'alert-danger';

                                        require_once ('messages.php');
                                    }
                                }
                            }
                        ?>
                        <div style="border:1px solid #ddd;padding:20px;">
                           <div class="contact__form__title">
                                <h2>Log In</h2>
                            </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <input type="text" name="log_phone" placeholder="Your Phone">
                            <input type="password" name="log_pass" placeholder="Password">
                            <button type="submit" name="login" class="site-btn mb-4">LOG IN</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Form End -->

    <!-- Footer Section Begin -->
    <?php require_once ('include/footer.php'); ?>
