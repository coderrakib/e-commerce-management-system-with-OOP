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

            $gSettings = new Settings;
            $gSettings->GetGeneralSetting();
            $query = $gSettings->query;
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> General Setting </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'general-setting.php'; ?>" class="breadcrumb-link">General Setting</a></li>
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

                                $header     = $_POST['header'];
                                $footer     = $_POST['footer'];
                               
                                $image      = $_FILES['image']['name'];
                                $image_tmp  = $_FILES['image']['tmp_name'];

                                $directory  = 'images/logo/';

                                $form_data  = array(

                                    array(

                                        'field_name'    => 'header',
                                        'name'          => 'Header',
                                        'min'           => 5,
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
                                        'required'      => true,
                                    ),
                                );

                                $validation     = new Validation;
                                $validation->validate($form_data);

                                if($validation->hasErrorPassed){

                                    $explode    = explode('.', $image);
                                    $extension  = end($explode);
                                    $new_name   = rand(1000, 99999).'.'.$extension;

                                    $insert = new Settings;

                                    if($insert->AddGeneralSetting($header, $footer, $new_name)){

                                        move_uploaded_file($image_tmp, $directory.$new_name);
                                        
                                        $message[] = "Successfully Save General Setting";

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
                                <h3 class="card-header">General Setting</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Site Title</label>
                                            <textarea name="header" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Footer Text</label>
                                            <textarea name="footer" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace( 'footer' );
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Logo Image</label>
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
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h3 class="card-header">All General Settings</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Header Text</th>
                                      <th>Footer Text</th>
                                      <th>Logo</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>#</th>
                                      <th>Header Text</th>
                                      <th>Footer Text</th>
                                      <th>Logo</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    <?php 

                                        $sl = 1;

                                        while ($row = $query->fetch_assoc()) { 

                                        $id         = $row['id'];
                                        $db_header  = $row['header_text'];
                                        $db_footer  = $row['footer_text'];
                                        $db_image   = $row['logo'];
                                        $db_status  = $row['status'];

                                        if($db_image){

                                            if(file_exists("images/logo/$db_image")){

                                                $db_image = "<img class='img-responsive img-fluid img-thumbnail' src='images/logo/$db_image' width='80px'>";
                                            }else{
                                                $db_image = "Image Not Found";
                                            }
                                                
                                        }else{
                                            $db_image = "Image is Not Added";
                                        }
                                    ?>
                                    <tr>
                                      <td><?php echo $sl++; ?></td>
                                      <td><?php echo $db_header;?></td>
                                      <td><?php echo $db_footer;?></td>
                                      <td>
                                        <?php echo $db_image; ?>
                                      </td>
                                      <td>
                                        <?php 

                                            if($db_status == 0){
                                                echo "<a href='change-status.php?id=$id&&value=1&&table=general_setting' class='btn btn-danger'>Disable</a>";
                                            }elseif($db_status == 1){
                                                echo "<a href='change-status.php?id=$id&&value=0&&table=general_setting' class='btn btn-success'>Enable</a>";
                                            }
                                        ?>
                                      </td>
                                      <td>
                                        <a href='<?php echo "edit-general-setting.php?id=$id" ?>' class="btn btn-success btn-sm d-block mb-2"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm d-block" data-toggle="modal" data-target="#exampleModalCenter-<?php echo $id;?>">
                                          <i class="fa fa-trash-alt"></i>&nbsp;Delete
                                        </button></td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLongTitle">Delete General Setting</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <h5 class="text-center">If you want to delete general setting ?</h5>
                                              </div>
                                              <div class="modal-footer">
                                                <a href='<?php echo "delete-general-setting.php?id=$id"?>' class="btn btn-danger">Yes</a>
                                                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
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
