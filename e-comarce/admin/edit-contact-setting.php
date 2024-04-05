<?php require_once ("config.php");?>
<!doctype html>
<html lang="en">
 
<head>
    <?php require_once ("include/css.php");
        echo '<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>';
    ?>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <?php require_once ("include/navbar.php");?>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php require_once ("include/leftsidebar.php");?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
         <?php
    
            require_once ('config.php');

            $id = (int) $_GET['id'];

            $conSettings = new Settings;
            $conSettings->GetContactSetting(['id', '=', $id]);
            $query = $conSettings->query;
            $row     = $query->fetch_assoc();
            $db_address     = $row['address'];
            $db_open_time   = $row['open_time'];
            $db_email       = $row['email'];
            $db_phone       = $row['phone'];
            $db_facebook    = $row['facebook'];
            $db_twitter     = $row['twitter'];
            $db_linkedin    = $row['linkedin'];
            $db_pinterest   = $row['pinterest'];
            $db_instagram   = $row['instagram'];
            $db_youtube     = $row['youtube'];
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Contact Setting </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'contact-setting.php'; ?>" class="breadcrumb-link">Contact Setting</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 offset-md-3 col-sm-12 col-12">
                       
                       <?php

                            if(isset($_POST['submit']) && $_POST['submit'] === 'Update'){

                                $address    = $_POST['address'];
                                $open_time  = $_POST['open_time'];
                                $email      = $_POST['email'];
                                $phone      = $_POST['phone'];
                                $facebook   = $_POST['facebook'];
                                $twitter    = $_POST['twitter'];
                                $linkedin   = $_POST['linkedin'];
                                $pinterest  = $_POST['pinterest'];
                                $instagram  = $_POST['instagram'];
                                $youtube    = $_POST['youtube'];
                               

                                $form_data  = array(

                                    array(

                                        'field_name'    => 'address',
                                        'name'          => 'Address',
                                        'min'           => 5,
                                        'max'           => 50,
                                    ),

                                    array(

                                        'field_name'    => 'open_time',
                                        'name'          => 'Open Time',
                                        'min'           => 5,
                                        'max'           => 50,
                                    ),

                                    array(

                                        'field_name'    => 'email',
                                        'name'          => 'Email',
                                        'min'           => 10,
                                        'max'           => 50,
                                    ),

                                    array(

                                        'field_name'    => 'phone',
                                        'name'          => 'Phone',
                                        'min'           => 11,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'facebook',
                                        'name'          => 'Facebook',
                                        'min'           => 10,
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'twitter',
                                        'name'          => 'Twitter',
                                        'min'           => 10,
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'linkedin',
                                        'name'          => 'Linkedin',
                                        'min'           => 10,
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'pinterest',
                                        'name'          => 'Pinterest',
                                        'min'           => 10,
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'instagram',
                                        'name'          => 'Instagram',
                                        'min'           => 10,
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'youtube',
                                        'name'          => 'Youtube',
                                        'min'           => 10,
                                        'max'           => 255,
                                    ),
                                );

                                $validation     = new Validation;
                                $validation->validate($form_data);

                                if($validation->hasErrorPassed){

                                    $update = new Settings;

                                    $data = array(

                                        'address',    '=', $address,
                                        'open_time',  '=', $open_time,
                                        'email',      '=', $email,
                                        'phone',      '=', $phone,
                                        'facebook',   '=', $facebook,
                                        'twitter',    '=', $twitter,
                                        'linkedin',   '=', $linkedin,
                                        'pinterest',  '=', $pinterest,
                                        'instagram',  '=', $instagram,
                                        'youtube',    '=', $youtube,
                                    );

                                    $where = array(

                                        'id', '=', $id, 
                                    );

                                    if($update->UpdateContactSetting('contact_setting', $data, $where)){

                                        $message[] = "Successfully Update Contact Setting";

                                        $_SESSION['messages']   = $message;
                                        $_SESSION['class_name'] = 'alert-success';

                                        require_once ('messages.php');

                                    }else{

                                        $message[] = "Something is Wrong .. Try again";

                                        $_SESSION['messages']   = $message;
                                        $_SESSION['class_name'] = 'alert-danger';

                                        require_once ('messages.php');
                                    }
                                }
                            }
                        ?>

                       <div class="card">
                                <h3 class="card-header">Contact Setting</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$id"; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" value="<?php echo $db_address; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Open Time</label>
                                            <input type="text" name="open_time" class="form-control" value="<?php echo $db_open_time; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $db_email; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Phone</label>
                                            <input type="text" name="phone" class="form-control" value="<?php echo $db_phone; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Facebook</label>
                                            <input type="text" name="facebook" class="form-control" value="<?php echo $db_facebook; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Twitter</label>
                                            <input type="text" name="twitter" class="form-control" value="<?php echo $db_twitter; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Linkedin</label>
                                            <input type="text" name="linkedin" class="form-control" value="<?php echo $db_linkedin; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Pinterest</label>
                                            <input type="text" name="pinterest" class="form-control" value="<?php echo $db_pinterest; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Instagram</label>
                                            <input type="text" name="instagram" class="form-control" value="<?php echo $db_instagram; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Youtube</label>
                                            <input type="text" name="youtube" class="form-control" value="<?php echo $db_youtube; ?>">
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                <label class="be-checkbox custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"><span class="custom-control-label">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <input type="submit" name="submit" value="Update" class="btn btn-space btn-primary">
                                                    <button class="btn btn-space btn-secondary">Cancel</button>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php require_once ('include/footer.php');?>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    
    <?php require_once ('include/js.php');?>

    </body>
</html>
