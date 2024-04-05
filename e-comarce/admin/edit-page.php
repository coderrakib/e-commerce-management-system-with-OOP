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

            $pages = new Pages;
            $pages->getpages(['id', '=', $p_id]);
            $query = $pages->query;

            $result = $query->fetch_assoc();
            $db_id     = $result['id'];
            $db_name   = $result['page_name'];
            $db_title  = $result['page_title'];
            $db_slug   = $result['page_slug'];
            $db_description  = $result['page_description'];

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
                            <h2 class="pageheader-title"> Edit Page </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'edit-page.php'; ?>" class="breadcrumb-link">Edit Page</a></li>
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

                                $name           = strtolower($_POST['name']);
                                $title          = $_POST['title'];
                                $slug           = strtolower($_POST['name'].'.php');
                                $description    = $_POST['description'];
                                
                                $form_data  = array(

                                    array(

                                        'field_name'    => 'name',
                                        'name'          => 'Page Name',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'title',
                                        'name'          => 'Title',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'description',
                                        'name'          => 'Description',
                                        'min'           => 10
                                    ),
                                );

                                $validation     = new Validation;
                                $validation->validate($form_data);

                                if($validation->hasErrorPassed){

                                    $update = new Pages;

                                    $data = array(

                                        'page_name', '=', $name,
                                        'page_title', '=', $title,
                                        'page_slug', '=', $slug,
                                        'page_description', '=', $description,
                                    );

                                     $where = array(

                                        'id', '=', $p_id,
                                    );

                                    if($update->updatepages('pages', $data, $where)){

                                        $message[] = "Successfully Update Page";

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
                                <h3 class="card-header">Edit Page</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$p_id"; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Page Name <span class="text-danger">(Unique)</span></label>
                                            <input type="text" name="name" autocomplete="off" class="form-control" value="<?php echo $db_name;?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Page Title</label>
                                            <input type="text" name="title" autocomplete="off" class="form-control" value="<?php echo $db_title;?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Page Description</label>
                                            <textarea name="description" class="form-control"><?php echo $db_description;?></textarea>
                                            <script>
                                                CKEDITOR.replace( 'description' );
                                            </script>
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
