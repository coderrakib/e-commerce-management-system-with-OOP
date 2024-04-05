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

        <?php 

            $p_id = (int) $_GET['id']; 

            $elements = new PageElements;
            $elements->getelements(['id', '=', $p_id]);
            $query = $elements->query;

            $result                 = $query->fetch_assoc();
            $db_id                  = $result['id'];
            $db_title               = $result['banner_title'];
            $db_title_b             = $result['banner_title_bangla'];
            $db_banner_desc         = $result['banner_desc'];
            $db_banner_desc_b       = $result['banner_desc_bangla'];
            $db_header_banner       = $result['header_banner'];
            $db_footer_banner_1     = $result['footer_banner_1'];
            $db_footer_banner_2     = $result['footer_banner_2'];
            $db_header_text         = $result['header_text'];
            $db_header_text_b       = $result['header_text_b'];
            $db_footer_text         = $result['footer_text'];
            $db_footer_text_b       = $result['footer_text_b'];
            $db_image               = $result['image'];
            $db_page_id             = $result['page_id'];
        ?>
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
                            <h2 class="pageheader-title"> Edit Ui Elements </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'edit-ui-elements.php'; ?>" class="breadcrumb-link">Edit Ui Elements</a></li>
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
                                    ),


                                    array(

                                        'field_name'    => 'footer_banner_1',
                                        'type'          => 'file',
                                        'name'          => 'Footer Banner 1',
                                    ),

                                    array(

                                        'field_name'    => 'footer_banner_2',
                                        'type'          => 'file',
                                        'name'          => 'Footer Banner 2',
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
                                    

                                    $f_banner_1_explode    = explode('.', $f_banner_1);
                                    $f_banner_1_extension  = end($f_banner_1_explode);
                                    
                                   
                                    $f_banner_2_explode    = explode('.', $f_banner_2);
                                    $f_banner_2_extension  = end($f_banner_2_explode);
                                    
                                   
                                    $feature_image_explode    = explode('.', $feature_image);
                                    $feature_image_extension  = end($feature_image_explode);
                                    

                                    $update = new PageElements;

                                    $data = array(

                                        'banner_title',         '=', $title,
                                        'banner_title_bangla',  '=', $b_title,
                                        'banner_desc',          '=', $desc,
                                        'banner_desc_bangla',   '=', $b_desc,
                                        'header_text',          '=', $header_text,
                                        'header_text_b',        '=', $header_text_b,
                                        'footer_text',          '=', $footer_text,
                                        'footer_text_b',        '=', $footer_text_b,
                                        'page_id',              '=', $page_name,
                                    );

                                    if(!empty($h_banner)){

                                        $h_banner_new_name   = rand(1000, 99999).'.'.$h_banner_extension;
                                        $data[] = 'header_banner';
                                        $data[] = '=';
                                        $data[] = $h_banner_new_name;
                                    }

                                    if(!empty($f_banner_1)){

                                        $f_banner_1_new_name   = rand(1000, 99999).'.'.$f_banner_1_extension;
                                        $data[] = 'footer_banner_1';
                                        $data[] = '=';
                                        $data[] = $f_banner_1_new_name;
                                    }

                                    if(!empty($f_banner_2)){

                                        $f_banner_2_new_name   = rand(1000, 99999).'.'.$f_banner_2_extension;
                                        $data[] = 'footer_banner_2';
                                        $data[] = '=';
                                        $data[] = $f_banner_2_new_name;
                                    }

                                     if(!empty($feature_image)){

                                        $feature_image_new_name   = rand(1000, 99999).'.'.$feature_image_extension;
                                        $data[] = 'image';
                                        $data[] = '=';
                                        $data[] = $feature_image_new_name;
                                    }

                                    $where = array(

                                        'id', '=', $p_id,
                                    );

                                    if($update->updateelements('ui_elements', $data, $where)){
                                    
                                        $message[] = "Successfully Update Ui Elements";

                                        $_SESSION['messages']   = $message;
                                        $_SESSION['class_name'] = 'alert-success';

                                        require_once ('messages.php');

                                        if(!empty($h_banner)){

                                            if(isset($h_banner)){
                                               
                                               $path = "images/banner/$db_header_banner";
                                                unlink($path); 
                                            }
                                            
                                            move_uploaded_file($h_banner_image_tmp, $directory.$h_banner_new_name);
                                        }

                                        if(!empty($f_banner_1)){

                                            if(isset($f_banner_1)){
                                               
                                               $path = "images/banner/$db_footer_banner_1";
                                                unlink($path); 
                                            }
                                            
                                            move_uploaded_file($f_banner_1_image_tmp, $directory.$f_banner_1_new_name);
                                        }

                                        if(!empty($f_banner_2)){

                                            if(isset($f_banner_2)){
                                               
                                               $path = "images/banner/$db_footer_banner_2";
                                                unlink($path); 
                                            }
                                            
                                            move_uploaded_file($f_banner_2_image_tmp, $directory.$f_banner_2_new_name);
                                        }

                                        if(!empty($feature_image)){

                                            if(isset($feature_image)){
                                               
                                               $path = "images/banner/$db_image";
                                                unlink($path); 
                                            }
                                            
                                            move_uploaded_file($feature_image_image_tmp, $directory.$feature_image_new_name);
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
                                <h3 class="card-header">Edit Ui Elements</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$p_id"; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Banner Title</label>
                                            <input type="text" name="title" autocomplete="off" class="form-control" value="<?php echo $db_title; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Banner Title <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="b_title" autocomplete="off" class="form-control" value="<?php echo $db_title_b; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Banner Description</label>
                                            <textarea name="description" class="form-control"><?php echo $db_banner_desc; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Banner Description <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="b_description" class="form-control"><?php echo $db_banner_desc_b; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Header Banner</label><br>
                                            <img src="images/banner/<?php echo $db_header_banner; ?>" width="80px;">
                                            <input type="file" name="h_banner" autocomplete="off" class="form-control mt-3">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Footer Banner-1</label><br>
                                            <img src="images/banner/<?php echo $db_footer_banner_1; ?>" width="80px;">
                                            <input type="file" name="footer_banner_1" autocomplete="off" class="form-control mt-3">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Footer Banner-2</label><br>
                                            <img src="images/banner/<?php echo $db_footer_banner_2; ?>" width="80px;">
                                            <input type="file" name="footer_banner_2" autocomplete="off" class="form-control mt-3">
                                        </div>
                                        <div class="form-group">
                                            <label>Header Text</label>
                                            <textarea name="header_text" class="form-control"><?php echo $db_header_text; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('header_text');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Header Text <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="header_text_b" class="form-control"><?php echo $db_header_text_b; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('header_text_b');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Footer Text</label>
                                            <textarea name="footer_text" class="form-control"><?php echo $db_footer_text; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('footer_text');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Footer Text <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="footer_text_b" class="form-control"><?php echo $db_footer_text_b; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('footer_text_b');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Feature Image</label><br>
                                            <img src="images/banner/<?php echo $db_image; ?>" width="80px;">
                                            <input type="file" name="feature_image" autocomplete="off" class="form-control mt-3">
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
                                                <option value="<?php echo $page_id; ?>"<?php if($db_page_id == $page_id){echo "selected ='selected'";}?>><?php echo $page_name; ?></option> 
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
