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

            $video = new Videos;
            $video->getvideo();
            $query = $video->query;
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Add Live Video </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'add-video.php'; ?>" class="breadcrumb-link">Add Live Video</a></li>
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

                                $title      = $_POST['title'];
                                $title_b    = $_POST['title_b'];
                            
                                $thumb      = $_FILES['thumbnail']['name'];
                                $thumb_tmp  = $_FILES['thumbnail']['tmp_name'];

                                $video      = $_FILES['video']['name'];
                                $video_tmp  = $_FILES['video']['tmp_name'];

                                $directory  = 'videos/';
                                
                                $form_data  = array(

                                    array(

                                        'field_name'    => 'title',
                                        'name'          => 'Video Title',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'title_b',
                                        'name'          => 'Video Title Bangla',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 255,
                                    ),

                                    array(

                                        'field_name'    => 'thumbnail',
                                        'name'          => 'Video Thumbnail',
                                        'type'          => 'file',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'video',
                                        'name'          => 'Video',
                                        'type'          => 'file',
                                        'required'      => true,
                                    ),
                                );

                                $validation     = new Validation;
                                $validation->validate($form_data);

                                if($validation->hasErrorPassed){

                                    $thumb_explode      = explode('.', $thumb);
                                    $thumb_extension    = end($thumb_explode);
                                    $thumb_new_name     = rand(1000, 99999).'.'.$thumb_extension;

                                    $video_explode      = explode('.', $video);
                                    $video_extension    = end($video_explode);
                                    $video_new_name     = rand(1000, 99999).'.'.$video_extension;

                                    $insert = new Videos;

                                    if($insert->addvideo($title, $title_b, $thumb_new_name, $video_new_name)){

                                        move_uploaded_file($thumb_tmp, $directory.$thumb_new_name);
                                        move_uploaded_file($video_tmp, $directory.$video_new_name0);

                                        $message[] = "Successfully Add Live Video";

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
                            <h3 class="card-header">Add Live Video</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Video Title</label>
                                            <input type="text" name="title" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Video Title <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="title_b" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Video Thumbnail</label>
                                            <input type="file" name="thumbnail" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Video <span class="text-danger">(webm,mkv,mp4,3gp,gif file is allowed and max 500 mb)</span></label>
                                            <input type="file" name="video" autocomplete="off" class="form-control">
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
                            <h3 class="card-header">All Live Video</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Video Title</th>
                                      <th>Video Title Bangla</th>
                                      <th>Video Thumbnail</th>
                                      <th>Video</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>#</th>
                                      <th>Video Title</th>
                                      <th>Video Title Bangla</th>
                                      <th>Video Thumbnail</th>
                                      <th>Video</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    <?php 

                                        $sl = 1;

                                        while ($row = $query->fetch_assoc()) { 

                                        $id             = $row['id'];
                                        $db_title       = $row['video_title'];
                                        $db_title_b     = $row['video_title_b'];
                                        $db_thumbnail   = $row['video_thumbnail'];
                                        $db_video       = $row['video'];
                                        $db_status      = $row['status'];

                                        if($db_thumbnail){

                                            if(file_exists("videos/$db_thumbnail")){

                                                $db_thumbnail = "<img class='img-responsive img-fluid img-thumbnail' src='videos/$db_thumbnail' width='80px'>";
                                            }else{
                                                $db_thumbnail = "Image Not Found";
                                            }
                                                
                                        }else{
                                            $db_thumbnail = "Image is Not Added";
                                        }

                                        if($db_video){

                                            if(file_exists("videos/$db_video")){

                                                $db_video = "<video width='200' height='100' controls>
                                                                <source src='videos/$db_video' type='video/mp4'>
                                                            </video>";
                                            }else{
                                                $db_video = "Video Not Found";
                                            }
                                                
                                        }else{
                                            $db_video = "Video is Not Added";
                                        }
                                    ?>
                                    <tr>
                                      <td><?php echo $sl++; ?></td>
                                      <td><?php echo $db_title;?></td>
                                      <td><?php echo $db_title_b;?></td>
                                      <td>
                                        <?php echo $db_thumbnail; ?>
                                      </td>
                                      <td>
                                        <?php echo $db_video; ?>
                                      </td>
                                      <td>
                                        <?php 

                                            if($db_status == 0){
                                                echo "<a href='change-status.php?id=$id&&value=1&&table=video' class='btn btn-danger'>Disable</a>";
                                            }elseif($db_status == 1){
                                                echo "<a href='change-status.php?id=$id&&value=0&&table=video' class='btn btn-success'>Enable</a>";
                                            }
                                        ?>
                                      </td>
                                      <td>
                                        <a href='<?php echo "edit-video.php?id=$id" ?>' class="btn btn-success btn-sm d-inline-block"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm d-inline-block" data-toggle="modal" data-target="#exampleModalCenter-<?php echo $id;?>">
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
