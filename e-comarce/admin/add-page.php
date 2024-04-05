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
                            <h2 class="pageheader-title"> Add Page </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'add-page.php'; ?>" class="breadcrumb-link">Add Page</a></li>
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

                            if(isset($_POST['submit']) && $_POST['submit'] === 'Add New'){

                                $name           = strtolower(trim($_POST['name']));
                                $title          = $_POST['title'];
                                $slug           = strtolower($_POST['name'].'.php');
                                $description    = $_POST['description'];

                                $newFileName    = "../".$name.".php";
                                
                                $form_data  = array(

                                    array(

                                        'field_name'    => 'name',
                                        'name'          => 'Page Name',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 30,
                                        'unique'        => true,
                                        'table'         => 'pages',
                                        'column'        => 'page_name'
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

                                    $insert = new Pages;

                                    if (file_put_contents($newFileName, $description) !== false) {
    
                                        if($insert->addpages($name, $title, $slug, $description)){

                                        $message[] = "Successfully Add New Page";

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
                            }
                        ?>

                       <div class="card">
                                <h3 class="card-header">Add Page</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Page Name</label>
                                            <input type="text" name="name" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Page Title</label>
                                            <input type="text" name="title" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Page Description</label>
                                            <textarea name="description" class="form-control"></textarea>
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
                                                    <input type="submit" name="submit" value="Add New" class="btn btn-space btn-primary">
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
