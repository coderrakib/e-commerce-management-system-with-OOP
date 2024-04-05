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

            $team = new Team;
            $team->getteam();
            $query = $team->query;
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Add Team </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'team.php'; ?>" class="breadcrumb-link">Add Team</a></li>
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

                                $name       = $_POST['name'];
                                $name_b     = $_POST['name_b'];
                                $title      = $_POST['title'];
                                $title_b    = $_POST['title_b'];
                                $fb         = $_POST['facebook'];
                                $tw         = $_POST['twitter'];
                                $in         = $_POST['linkedin'];
                                $pn         = $_POST['pinterest'];
                               
                                $image      = $_FILES['image']['name'];
                                $image_tmp  = $_FILES['image']['tmp_name'];

                                $directory  = 'images/team/';

                                $form_data  = array(

                                    array(

                                        'field_name'    => 'name',
                                        'name'          => 'Name',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'name_b',
                                        'name'          => 'Name Bangla',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'title',
                                        'name'          => 'Title',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'title_b',
                                        'name'          => 'Title Bangla',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'facebook',
                                        'name'          => 'Facebook',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30
                                    ),

                                    array(

                                        'field_name'    => 'twitter',
                                        'name'          => 'Twitter',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30
                                    ),

                                    array(

                                        'field_name'    => 'linkedin',
                                        'name'          => 'Linkedin',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30
                                    ),

                                    array(

                                        'field_name'    => 'pinterest',
                                        'name'          => 'Pinterest',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30
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

                                    $insert = new Team;

                                    if($insert->addteam($name, $name_b, $title, $title_b, $fb, $tw, $in, $pn, $new_name)){

                                        move_uploaded_file($image_tmp, $directory.$new_name);
                                        
                                        $message[] = "Successfully Add Team";

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

                        <!--update -->
                        <!--update -->
                        <!--update quary-->

                        <?php

                            if(isset($_POST['submit']) && $_POST['submit'] === 'Update'){

                                $get_id   = $_POST['hidden'];

                                $get_image = new Team;
                                $get_image->getteam(['id','=', $get_id]);
                                $get_query  = $get_image->query;
                                $result     = $get_query->fetch_assoc();
                                $get_image  = $result['image'];

                                $name       = $_POST['name'];
                                $name_b     = $_POST['name_b'];
                                $title      = $_POST['title'];
                                $title_b    = $_POST['title_b'];
                                $fb         = $_POST['facebook'];
                                $tw         = $_POST['twitter'];
                                $in         = $_POST['linkedin'];
                                $pn         = $_POST['pinterest'];
                               
                                $image      = $_FILES['image']['name'];
                                $image_tmp  = $_FILES['image']['tmp_name'];

                                $directory  = 'images/team/';

                                $form_data  = array(

                                    array(

                                        'field_name'    => 'name',
                                        'name'          => 'Name',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'name_b',
                                        'name'          => 'Name Bangla',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'title',
                                        'name'          => 'Title',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'title_b',
                                        'name'          => 'Title Bangla',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'facebook',
                                        'name'          => 'Facebook',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30
                                    ),

                                    array(

                                        'field_name'    => 'twitter',
                                        'name'          => 'Twitter',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30
                                    ),

                                    array(

                                        'field_name'    => 'linkedin',
                                        'name'          => 'Linkedin',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30
                                    ),

                                    array(

                                        'field_name'    => 'pinterest',
                                        'name'          => 'Pinterest',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30
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
                                   
                                    $update = new Team;

                                    $data = array(

                                        'name',         '=', $name,
                                        'name_bangla',  '=', $name_b,
                                        'title',        '=', $title,
                                        'title_bangla', '=', $title_b,
                                        'facebook',     '=', $fb,
                                        'twitter',      '=', $tw,
                                        'linkedin',     '=', $in,
                                        'pinterest',    '=', $pn,
                                    );

                                    if(!empty($image)){

                                        $new_name   = rand(1000, 99999).'.'.$extension;
                                        $data[] = 'image';
                                        $data[] = '=';
                                        $data[] = $new_name;
                                    }

                                    $where = array(

                                        'id', '=', $get_id,
                                    );

                                    if($update->updateteam('team', $data, $where)){

                                        $message[] = "Successfully Updated Team";

                                        $_SESSION['messages']   = $message;
                                        $_SESSION['class_name'] = 'alert-success';

                                        require_once ('messages.php');

                                        if(!empty($image)){

                                            if(isset($image)){
                                               
                                               $path = "images/team/$get_image";
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
                                <h3 class="card-header">Add Team</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="name_b" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Title</label>
                                            <input type="text" name="title" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Title <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="title_b" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="text" name="facebook" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Twitter</label>
                                            <input type="text" name="twitter" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Linkedin</label>
                                            <input type="text" name="linkedin" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Pinterest</label>
                                            <input type="text" name="pinterest" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
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
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h3 class="card-header">All Team Member</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Title</th>
                                      <th>Facebook</th>
                                      <th>Twitter</th>
                                      <th>Linkedin</th>
                                      <th>Pinterest </th>
                                      <th>Image </th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Title</th>
                                      <th>Facebook</th>
                                      <th>Twitter</th>
                                      <th>Linkedin</th>
                                      <th>Pinterest </th>
                                      <th>Image </th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    <?php 

                                        $sl = 1;

                                        while ($row = $query->fetch_assoc()) { 

                                        $id             = $row['id'];
                                        $db_name        = $row['name'];
                                        $db_title       = $row['title'];
                                        $db_facebook    = $row['facebook'];
                                        $db_twitter     = $row['twitter'];
                                        $db_linkedin    = $row['linkedin'];
                                        $db_pinterest   = $row['pinterest'];
                                        $db_image       = $row['image'];
                                        $db_status      = $row['status'];

                                        if($db_image){

                                            if(file_exists("images/team/$db_image")){

                                                $db_image = "<img class='img-responsive img-fluid img-thumbnail' src='images/team/$db_image' width='80px'>";
                                            }else{
                                                $db_image = "Image Not Found";
                                            }
                                                
                                        }else{
                                            $db_image = "Image is Not Added";
                                        }
                                    ?>
                                    <tr>
                                      <td><?php echo $sl++; ?></td>
                                      <td><?php echo $db_name;?></td>
                                      <td><?php echo $db_title;?></td>
                                      <td><?php echo $db_facebook;?></td>
                                      <td><?php echo $db_twitter;?></td>
                                      <td><?php echo $db_linkedin;?></td>
                                      <td><?php echo $db_pinterest;?></td>
                                      <td>
                                        <?php echo $db_image; ?>
                                      </td>
                                      <td>
                                        <?php 

                                            if($db_status == 0){
                                                echo "<a href='change-status.php?id=$id&&value=1&&table=team' class='btn btn-danger'>Disable</a>";
                                            }elseif($db_status == 1){
                                                echo "<a href='change-status.php?id=$id&&value=0&&table=team' class='btn btn-success'>Enable</a>";
                                            }
                                        ?>
                                      </td>
                                      <td>
                                        
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success btn-sm d-block mb-2" data-toggle="modal" data-target="#exampleModal-<?php echo $id;?>">
                                          <i class="fa fa-edit"></i>&nbsp;Edit
                                        </button>

                                        <?php

                                            $edit_team = new Team;
                                            $edit_team->getteam(['id','=', $id]);
                                            $edit_query = $edit_team->query;
                                            $row        = $edit_query->fetch_assoc();
                                            $db_name            = $row['name'];
                                            $db_name_bangla     = $row['name_bangla'];
                                            $db_title           = $row['title'];
                                            $db_title_bangla    = $row['title_bangla'];
                                            $db_fb              = $row['facebook'];
                                            $db_tw              = $row['twitter'];
                                            $db_in              = $row['linkedin'];
                                            $db_pn              = $row['pinterest'];
                                            $db_image           = $row['image'];
                                        ?>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Team</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" name="name" autocomplete="off" class="form-control" value="<?php echo $db_name; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Name <span class="text-danger">(Bangla)</span></label>
                                                        <input type="text" name="name_b" autocomplete="off" class="form-control" value="<?php echo $db_name_bangla; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail">Title</label>
                                                        <input type="text" name="title" autocomplete="off" class="form-control" value="<?php echo $db_title; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail">Title <span class="text-danger">(Bangla)</span></label>
                                                        <input type="text" name="title_b" autocomplete="off" class="form-control" value="<?php echo $db_title_bangla; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Facebook</label>
                                                        <input type="text" name="facebook" class="form-control" value="<?php echo $db_fb; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Twitter</label>
                                                        <input type="text" name="twitter" class="form-control" value="<?php echo $db_tw; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Linkedin</label>
                                                        <input type="text" name="linkedin" class="form-control" value="<?php echo $db_in; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pinterest</label>
                                                        <input type="text" name="pinterest" class="form-control" value="<?php echo $db_pn; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <img class="mb-3" src="images/team/<?php echo $db_image; ?>" width="100px;">
                                                        <input type="file" name="image" class="form-control">
                                                    </div>
                                              </div>
                                              <div class="row modal-footer">
                                                    <div class="pl-0">
                                                        <p class="text-right">
                                                            <input type="hidden" name="hidden" value="<?php echo $id; ?>">
                                                            <input type="submit" name="submit" value="Update" class="btn btn-space btn-primary">
                                                            <button class="btn btn-space btn-secondary" data-dismiss="modal">Cancel</button>
                                                        </p>
                                                    </div>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <button type="button" class="btn btn-danger btn-sm d-block" data-toggle="modal" data-target="#exampleModalCenter-<?php echo $id;?>">
                                          <i class="fa fa-trash-alt"></i>&nbsp;Delete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLongTitle">Delete Team Member</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <h5 class="text-center">If you want to delete team member ?</h5>
                                              </div>
                                              <div class="modal-footer">
                                                <a href='<?php echo "delete-team.php?id=$id"?>' class="btn btn-danger">Yes</a>
                                                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        </td>
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
