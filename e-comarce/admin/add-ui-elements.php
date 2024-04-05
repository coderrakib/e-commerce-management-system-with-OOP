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
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Add Ui Elements </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'add-ui-elements.php'; ?>" class="breadcrumb-link">Add Ui Elements</a></li>
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

                            if(isset($_POST['submit']) && $_POST['submit'] === 'Save'){

                                $title                  = $_POST['title'];
                                $b_title                = $_POST['b_title'];
                                $desc                   = $_POST['description'];
                                $b_desc                 = $_POST['b_description'];

                                $h_banner               = $_FILES['h_banner']['name'];
                                $h_banner_image_tmp     = $_FILES['h_banner']['tmp_name'];

                                $f_banner_1             = $_FILES['footer_banner_1']['name'];
                                $f_banner_1_image_tmp   = $_FILES['footer_banner_1']['tmp_name'];

                                $f_banner_2             = $_FILES['footer_banner_2']['name'];
                                $f_banner_2_image_tmp   = $_FILES['footer_banner_2']['tmp_name'];

                                $header_text            = $_POST['header_text'];
                                $header_text_b          = $_POST['header_text_b'];
                                $footer_text            = $_POST['footer_text'];
                                $footer_text_b          = $_POST['footer_text_b'];

                                $feature_image             = $_FILES['feature_image']['name'];
                                $feature_image_image_tmp   = $_FILES['feature_image']['tmp_name'];

                                $page_name              = $_POST['page_name'];

                                $directory  = 'images/banner/';

                                $form_data  = array(

                                    array(

                                        'field_name'    => 'title',
                                        'name'          => 'Banner Title',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'b_title',
                                        'name'          => 'Banner Title Bangla',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'description',
                                        'name'          => 'Banner Description',
                                        'min'           => 5,
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'b_description',
                                        'name'          => 'Banner Description Bangla',
                                        'min'           => 5,
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'h_banner',
                                        'type'          => 'file',
                                        'name'          => 'Header Banner',
                                        'required'      => true,
                                    ),


                                    array(

                                        'field_name'    => 'footer_banner_1',
                                        'type'          => 'file',
                                        'name'          => 'Footer Banner 1',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'footer_banner_2',
                                        'type'          => 'file',
                                        'name'          => 'Footer Banner 2',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'header_text',
                                        'name'          => 'Header Text',
                                        'min'           => 5,
                                    ),

                                    array(

                                        'field_name'    => 'header_text_b',
                                        'name'          => 'Header Text Bangla',
                                        'min'           => 5,
                                    ),

                                    array(

                                        'field_name'    => 'footer_text',
                                        'name'          => 'Footer Text',
                                        'min'           => 5,
                                    ),

                                    array(

                                        'field_name'    => 'footer_text_b',
                                        'name'          => 'Footer Text Bangla',
                                        'min'           => 5,
                                    ),

                                    array(

                                        'field_name'    => 'feature_image',
                                        'type'          => 'file',
                                        'name'          => 'Feature Image',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'page_name',
                                        'name'          => 'Page Name',
                                        'required'      => true,
                                    ),
                                );

                                $validation     = new Validation;
                                $validation->validate($form_data);

                                if($validation->hasErrorPassed){

                                    $h_banner_explode    = explode('.', $h_banner);
                                    $h_banner_extension  = end($h_banner_explode);
                                    $h_banner_new_name   = rand(1000, 99999).'.'.$h_banner_extension;

                                    $f_banner_1_explode    = explode('.', $f_banner_1);
                                    $f_banner_1_extension  = end($f_banner_1_explode);
                                    $f_banner_1_new_name   = rand(1000, 99999).'.'.$f_banner_1_extension;
                                   
                                    $f_banner_2_explode    = explode('.', $f_banner_2);
                                    $f_banner_2_extension  = end($f_banner_2_explode);
                                    $f_banner_2_new_name   = rand(1000, 99999).'.'.$f_banner_2_extension;
                                   
                                    $feature_image_explode    = explode('.', $feature_image);
                                    $feature_image_extension  = end($feature_image_explode);
                                    $feature_image_new_name   = rand(1000, 99999).'.'.$feature_image_extension;

                                    $insert = new PageElements;

                                    if($insert->addelements($title, $b_title, $desc, $b_desc, $h_banner_new_name, $f_banner_1_new_name, $f_banner_2_new_name, $header_text, $header_text_b, $footer_text, $footer_text_b, $feature_image_new_name, $page_name )){

                                        move_uploaded_file($h_banner_image_tmp, $directory.$h_banner_new_name);
                                        move_uploaded_file($f_banner_1_image_tmp, $directory.$f_banner_1_new_name);
                                        move_uploaded_file($f_banner_2_image_tmp, $directory.$f_banner_2_new_name);
                                        move_uploaded_file($feature_image_image_tmp, $directory.$feature_image_new_name);
                                        
                                    
                                    $message[] = "Successfully Save Ui Elements";

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
                                <h3 class="card-header">Add Ui Elements</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Banner Title</label>
                                            <input type="text" name="title" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Banner Title <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="b_title" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Banner Description</label>
                                            <textarea name="description" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Banner Description <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="b_description" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Header Banner</label>
                                            <input type="file" name="h_banner" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Footer Banner-1</label>
                                            <input type="file" name="footer_banner_1" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Footer Banner-2</label>
                                            <input type="file" name="footer_banner_2" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Header Text</label>
                                            <textarea name="header_text" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('header_text');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Header Text <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="header_text_b" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('header_text_b');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Footer Text</label>
                                            <textarea name="footer_text" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('footer_text');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Footer Text <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="footer_text_b" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('footer_text_b');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Feature Image</label>
                                            <input type="file" name="feature_image" autocomplete="off" class="form-control">
                                        </div>
                                         <div class="form-group">
                                            <label for="inputEmail">Page Name</label>
                                            <select name="page_name" class="form-control">
                                                <option value="">Select Page Name</option>
                                                <?php

                                                    $pages = new Pages;
                                                    $pages->getpages();
                                                    $page_query = $pages->query;

                                                    $sl = 1;

                                                    while ($row = $page_query->fetch_assoc()) { 

                                                    $page_id           = $row['id'];
                                                    $page_name         = $row['page_name'];
                                                ?>
                                                <option value="<?php echo $page_id; ?>"><?php echo $page_name; ?></option> 
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                <label class="be-checkbox custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"><span class="custom-control-label">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <input type="submit" name="submit" value="Save" class="btn btn-space btn-primary">
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
