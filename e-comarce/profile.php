    <?php require_once ('admin/config.php'); 

        $get = $_SESSION['customer'];
    ?>
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

        $custo_detalis  = new Customers;
        $custo_detalis->getcustomer(['phone','=', $get,'status', '=', 1]);
        $custo_query    = $custo_detalis->query;

        $custo_result   = $custo_query->fetch_assoc();
        $id             = $custo_result['customer_id'];
        $name           = $custo_result['name'];
        $phone          = $custo_result['phone'];
        $pass           = $custo_result['password'];
        $street         = $custo_result['street'];
        $apartment      = $custo_result['apartment'];
        $city           = $custo_result['city'];
        $zip            = $custo_result['zip'];
        $email          = $custo_result['email'];
        $account        = $custo_result['account'];
        $account_number = $custo_result['account_number'];

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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php

                    if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){

                    $name       = ucwords($_POST['name']);
                    $street     = $_POST['street'];
                    $apartment  = $_POST['apartment'];
                    $city       = $_POST['city'];
                    $zip        = $_POST['zip'];
                    $email      = $_POST['email'];
                    $account    = isset($_POST['account']) ? $_POST['account'] : null;
                    $account_number       = $_POST['account_number'];
                    
                    $form_data  = array(

                        array(

                            'field_name'    => 'name',
                            'name'          => 'Customer Name',
                            'required'      => true,
                            'min'           => 5,
                            'max'           => 30,
                        ),

                        array(

                            'field_name'    => 'street',
                            'name'          => 'Street Address',
                            'required'      => true,
                            'min'           => 5,
                            'max'           => 255,
                        ),

                        array(

                            'field_name'    => 'apartment',
                            'name'          => 'Apartment Address',
                            'min'           => 5,
                            'max'           => 255, 
                        ),

                        array(

                            'field_name'    => 'city',
                            'name'          => 'City or Town',
                            'required'      => true,
                            'min'           => 5,
                            'max'           => 30
                        ),

                        array(

                            'field_name'    => 'zip',
                            'name'          => 'Zip Code',
                            'required'      => true,
                            'min'           => 4,
                            'max'           => 4
                        ),

                        array(

                            'field_name'    => 'email',
                            'name'          => 'Email',
                            'required'      => true,
                            'min'           => 10,
                            'max'           => 30
                        ),

                        array(

                            'field_name'    => 'account',
                            'name'          => 'Bkash/Rocket/Nagad Account',
                            'required'      => true,
                        ),

                        array(

                            'field_name'    => 'account_number',
                            'name'          => 'Bkash/Rocket/Nagad Number',
                            'required'      => true,
                            'min'           => 11,
                            'max'           => 11,

                            ),
                        );

                        $validation     = new Validation;
                        $validation->validate($form_data);

                        if($validation->hasErrorPassed){

                            $update = new Customers;

                            $data = array(

                                'name',          '=', $name,
                                'street',        '=', $street,
                                'apartment',     '=', $apartment,
                                'city',          '=', $city,
                                'zip',           '=', $zip,
                                'email',         '=', $email,
                                'account',       '=', $account,
                                'account_number','=', $account_number,
                            );

                            $where = array(
                                'phone', '=', $get,
                            );

                            if($update->updatecustomer('customers',$data,$where)){
                                        
                                $message[] = "Successfully Add Details";    

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

            <!--Change Password -->

            <?php

                    if(isset($_POST['save']) && $_SERVER["REQUEST_METHOD"] == "POST"){

                    $current        = $_POST['current'];
                    $hash_current   = hash('sha512', $current);
                    $new            = $_POST['new'];
                    $retype         = $_POST['retype'];
                    $hash_new       = hash('sha512', $new);
                    
                    $form_data  = array(

                        array(

                            'field_name'    => 'current',
                            'name'          => 'Current Password',
                            'required'      => true
                        ),

                        array(

                            'field_name'    => 'new',
                            'name'          => 'New Password',
                            'required'      => true,
                            'min'           => 6,
                            'max'           => 30,
                            'matching'      => $new
                        ),

                        array(

                            'field_name'    => 'retype',
                            'name'          => 'New Retype Password',
                            'required'      => true,
                            'min'           => 6,
                            'max'           => 30,
                            'matching'      => $new
                        )

                        );

                        $validation     = new Validation;
                        $validation->validate($form_data);

                        if($validation->hasErrorPassed){

                            $update = new Customers;

                            $data = array(

                                'password',          '=', $hash_new,
                            );

                            $where = array(
                                'phone', '=', $get,
                            );

                            if($hash_current != $pass){

                                $message[] = "Current Password is Incorrect";    

                                $_SESSION['messages']   = $message;
                                $_SESSION['class_name'] = 'alert-danger';

                                require_once ('messages.php');

                            }else{

                                if($update->updatecustomer('customers',$data,$where)){
                                        
                                $message[] = "Successfully Save Change. Next Log in Use New Password";    

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
                }
            ?>
            </div>
        </div>
    </div>
    <!-- Contact Form Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 style="background:#eee; text-align:center; border-top:1px solid #7fad39; padding:10px 0px 10px 0px; font-weight:bold; margin-bottom:30px;color:#292929;"><span style="font-size:21px; color:#7fad39;"><i class="fa fa-user-circle"></i></span>&nbsp;&nbsp;Your Profile</h4>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>Full Name<span>*</span></p>
                                <input type="text" name="name" value="<?php echo $name; ?>">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="street" placeholder="Street Address" class="checkout__input__add" value="<?php echo $street; ?>">
                                <input type="text" name="apartment" placeholder="Apartment, suite, unite ect (optinal)" value="<?php echo $apartment; ?>">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" value="<?php echo $city; ?>">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip" value="<?php echo $zip; ?>">
                            </div>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="email" name="email" value="<?php echo $email; ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Bkash / Rocket / Nagad Number<span>*</span></p>
                                        <input type="text" name="account_number" value="<?php echo $account_number; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Number Type<span>*</span></p>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="account" class="custom-control-input" value="Bkash" <?php if($account == 'Bkash'){echo "checked='checked'";}?>>
                                        <label class="custom-control-label" for="customRadioInline1">Bkash </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="account" class="custom-control-input" value="Rocket" <?php if($account == 'Rocket'){echo "checked='checked'";}?>>
                                        <label class="custom-control-label" for="customRadioInline2">Rocket</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline3" name="account" class="custom-control-input" value="Nagad" <?php if($account == 'Nagad'){echo "checked='checked'";}?>>
                                        <label class="custom-control-label" for="customRadioInline3">Nagad </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="site-btn">Add Details</button>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Information</h4>
                                <ul>
                                    <li>Customer Id <span><?php echo $id; ?></span></li>
                                    <li>Full Name <span><?php echo $name; ?></span></li>
                                    <li>Address <span><?php echo $street; ?></span></li>
                                    <li>Phone   <span><?php echo $phone; ?></span></li>
                                    <li>Email   <span><?php echo $email; ?></span></li>
                                    <li>Post Code   <span><?php echo $zip; ?></span></li>
                                    <li><?php echo $account; ?> Account   <span><?php echo $account_number; ?></span></li>
                                </ul>
                            </div>
                            <div class="checkout__order">
                                <h4>Change Password</h4>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                    <div class="checkout__input">
                                        <p>Current Password<span>*</span></p>
                                        <input type="password" name="current">
                                    </div>
                                    <div class="checkout__input">
                                        <p>New Password<span>*(Minimum 6 Characters)</span></p>
                                        <input type="password" name="new">
                                    </div>
                                    <div class="checkout__input">
                                        <p>Confirm New Password<span>*</span></p>
                                        <input type="password" name="retype">
                                    </div>
                                    <button type="submit" name="save" class="site-btn">Save Change</button>
                                </form>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Contact Form End -->

    <!-- Footer Section Begin -->
    <?php require_once ('include/footer.php'); ?>

