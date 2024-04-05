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

            $conSettings = new Settings;
            $conSettings->GetContactSetting();
            $query = $conSettings->query;
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

                            if(isset($_POST['submit']) && $_POST['submit'] === 'Save'){

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
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'open_time',
                                        'name'          => 'Open Time',
                                        'min'           => 5,
                                        'max'           => 255,
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

                                    $insert = new Settings;

                                    if($insert->AddContactSetting($address,$open_time,$email, $phone, $facebook, $twitter, $linkedin, $pinterest, $instagram, $youtube)){

                                        $message[] = "Successfully Save Contact Setting";

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
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Open Time</label>
                                            <input type="text" name="open_time" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="Email" name="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Phone</label>
                                            <input type="text" name="phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Facebook</label>
                                            <input type="text" name="facebook" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Twitter</label>
                                            <input type="text" name="twitter" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Linkedin</label>
                                            <input type="text" name="linkedin" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Pinterest</label>
                                            <input type="text" name="pinterest" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Instagram</label>
                                            <input type="text" name="instagram" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Youtube</label>
                                            <input type="text" name="youtube" class="form-control">
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
                            <h3 class="card-header">All Contact Settings</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Address</th>
                                      <th>Time</th>
                                      <th>Email</th>
                                      <th>Phone</th>
                                      <th>Facebook</th>
                                      <th>Twitter</th>
                                      <th>Linkedin</th>
                                      <th>Pinterest</th>
                                      <th>Instagram</th>
                                      <th>Youtube</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>#</th>
                                      <th>Address</th>
                                      <th>Time</th>
                                      <th>Email</th>
                                      <th>Phone</th>
                                      <th>Facebook</th>
                                      <th>Twitter</th>
                                      <th>Linkedin</th>
                                      <th>Pinterest</th>
                                      <th>Instagram</th>
                                      <th>Youtube</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    <?php 

                                        $sl = 1;

                                        while ($row = $query->fetch_assoc()) { 

                                        $id             = $row['id'];
                                        $db_address     = $row['address'];
                                        $db_open_time      = $row['open_time'];
                                        $db_email       = $row['email'];
                                        $db_phone       = $row['phone'];
                                        $db_facebook    = $row['facebook'];
                                        $db_twitter     = $row['twitter'];
                                        $db_linkedin    = $row['linkedin'];
                                        $db_pinterest   = $row['pinterest'];
                                        $db_instagram   = $row['instagram'];
                                        $db_youtube     = $row['youtube'];
                                        $db_status      = $row['status'];
                                    ?>
                                    <tr>
                                      <td><?php echo $sl++; ?></td>
                                      <td><?php echo $db_address;?></td>
                                      <td><?php echo $db_open_time;?></td>
                                      <td><?php echo $db_email;?></td>
                                      <td><?php echo $db_phone;?></td>
                                      <td><?php echo $db_facebook;?></td>
                                      <td><?php echo $db_twitter;?></td>
                                      <td><?php echo $db_linkedin;?></td>
                                      <td><?php echo $db_pinterest;?></td>
                                      <td><?php echo $db_instagram;?></td>
                                      <td><?php echo $db_youtube;?></td>
                                      <td>
                                        <?php 

                                            if($db_status == 0){
                                                echo "<a href='change-status.php?id=$id&&value=1&&table=contact_setting' class='btn btn-danger'>Disable</a>";
                                            }elseif($db_status == 1){
                                                echo "<a href='change-status.php?id=$id&&value=0&&table=contact_setting' class='btn btn-success'>Enable</a>";
                                            }
                                        ?>
                                      </td>
                                      <td>
                                        <a href='<?php echo "edit-contact-setting.php?id=$id" ?>' class="btn btn-success btn-sm d-block mb-2"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm d-block" data-toggle="modal" data-target="#exampleModalCenter-<?php echo $id;?>">
                                          <i class="fa fa-trash-alt"></i>&nbsp;Delete
                                        </button></td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLongTitle">Delete Contact Setting</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <h5 class="text-center">If you want to delete contact setting ?</h5>
                                              </div>
                                              <div class="modal-footer">
                                                <a href='<?php echo "delete-contact-setting.php?id=$id"?>' class="btn btn-danger">Yes</a>
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
