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

            $get_id         = (int) $_GET['id'];
            $video          = new Videos;
            $video->getvideo(['id','=',$get_id]);
            $query          = $video->query;
            $result         = $query->fetch_assoc();
            $db_title       = $result['video_title'];
            $db_title_b     = $result['video_title_b'];
            $db_thumbnail   = $result['video_thumbnail'];
            $db_video       = $result['video'];
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Edit Live Video </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'edit-video.php'; ?>" class="breadcrumb-link">Edit Live Video</a></li>
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
                            <h3 class="card-header">Edit Live Video</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Video Title</label>
                                            <input type="text" name="title" autocomplete="off" class="form-control" value="<?php echo $db_title; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Video Title <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="title_b" autocomplete="off" class="form-control" value="<?php echo $db_title_b; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Video Thumbnail</label></br>
                                            <img class="mb-3 mt-3" src="videos/<?php echo $db_thumbnail; ?>" width="100px;">
                                            <input type="file" name="thumbnail" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Video <span class="text-danger">(webm,mkv,mp4,3gp,gif file is allowed and max 500 mb)</span></label>
                                            <video width="200" height="100" controls>
                                              <source src="videos/<?php echo $db_video; ?>" type="video/mp4">
                                            </video>
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
