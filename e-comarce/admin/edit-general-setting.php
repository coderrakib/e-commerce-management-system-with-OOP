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
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
         <?php
    
            require_once ('config.php');

            $id = (int) $_GET['id'];

            $gSettings = new Settings;
            $gSettings->GetGeneralSetting(['id', '=', $id]);
            $query = $gSettings->query;

            $result            = $query->fetch_assoc(); 
            $db_header_text    = $result['header_text']; 
            $db_footer_text    = $result['footer_text']; 
            $db_logo           = $result['logo']; 
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Edit General Setting </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'general-setting.php'; ?>" class="breadcrumb-link">Edit General Setting</a></li>
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

                                $header     = $_POST['header'];
                                $footer     = $_POST['footer'];
                               
                                $image      = $_FILES['image']['name'];
                                $image_tmp  = $_FILES['image']['tmp_name'];

                                $directory  = 'images/logo/';

                                $form_data  = array(

                                    array(

                                        'field_name'    => 'header',
                                        'name'          => 'Header',
                                        'min'           => 10,
                                        'max'           => 500,
                                        'required'      => true
                                    ),

                                    array(

                                        'field_name'    => 'footer',
                                        'name'          => 'Footer',
                                        'required'      => true,
                                        'min'           => 10,
                                        'max'           => 500,
                                    ),

                                    array(

                                        'field_name'    => 'image',
                                        'type'          => 'file',
                                        'name'          => 'Image',
                                    ),
                                );

                                $validation     = new Validation;
                                $validation->validate($form_data);

                                if($validation->hasErrorPassed){

                                    $explode    = explode('.', $image);
                                    $extension  = end($explode);
                                    
                                    $update = new Settings;

                                    $data = array(

                                        'header_text', '=', $header,
                                        'footer_text', '=', $footer
                                    );

                                    if(!empty($image)){

                                        $new_name   = rand(1000, 99999).'.'.$extension;

                                        $data[] = 'logo';
                                        $data[] = '=';
                                        $data[] = $new_name;   
                                    }

                                    $where = array(

                                        'id', '=', $id,
                                    );

                                    if($update->UpdateGeneralSetting('general_setting', $data, $where)){

                                        $message[] = "Successfully Update General Setting";

                                        $_SESSION['messages']   = $message;
                                        $_SESSION['class_name'] = 'alert-success';

                                        require_once ('messages.php');

                                        if(!empty($image)){

                                            if(isset($image)){
                                               
                                               $path = "images/logo/$db_logo";
                                                unlink($path); 
                                            }
                                            
                                            move_uploaded_file($image_tmp, $directory.$new_name);
                                        }

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
                            <h3 class="card-header">Edit General Setting</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$id"; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Site Title</label>
                                            <textarea name="header" class="form-control"><?php echo $db_header_text; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Footer Text</label>
                                            <textarea name="footer" class="form-control"><?php echo $db_footer_text; ?></textarea>
                                            <script>
                                                CKEDITOR.replace( 'footer' );
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Logo Image</label><br>
                                            <?php
                                                if(!empty($db_logo)){

                                                    echo "<img class='mb-3 mt-3' src='images/logo/$db_logo' width='100px;'>";
                                                }
                                            ?>
                                            <input type="file" name="image" class="form-control">
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
