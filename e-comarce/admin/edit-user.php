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
    
            $u_id = (int) $_GET['id']; 

            $users = new Users;
            $users->getUsers(['id', '=', $u_id]);
            $query = $users->query;

            $result = $query->fetch_assoc();
            $db_id     = $result['id'];
            $db_name   = $result['user_name'];
            $db_email  = $result['email'];
            $db_type   = $result['type'];
            $db_image  = $result['image'];
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Edit User </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'add-user.php'; ?>" class="breadcrumb-link">Edit User</a></li>
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

                                $name       = $_POST['name'];
                                $email      = $_POST['email'];
                                $pass       = $_POST['pass'];
                                $con_pass   = $_POST['con_pass'];
                                $hash_pass  = hash('sha512', $pass);
                                $type       = $_POST['type'];

                                $image      = $_FILES['image']['name'];
                                $image_tmp  = $_FILES['image']['tmp_name'];

                                $directory  = 'images/users/';

                                $form_data  = array(

                                    array(

                                        'field_name'    => 'name',
                                        'name'          => 'User Name',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'email',
                                        'name'          => 'Email',
                                        'required'      => true,
                                        'min'           => 5,
                                        'max'           => 30,
                                    ),

                                    array(

                                        'field_name'    => 'pass',
                                        'name'          => 'Password',
                                        'min'           => 8,
                                        'max'           => 30,
                                        'matching'      => $pass   
                                    ),

                                    array(

                                        'field_name'    => 'con_pass',
                                        'name'          => 'Confirm Password',
                                        'min'           => 8,
                                        'max'           => 30,
                                        'matching'      => $pass 
                                    ),

                                    array(

                                        'field_name'    => 'type',
                                        'name'          => 'User Type',
                                        'required'      => true,
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
                                    

                                    $update = new Users;

                                    $data = array(

                                        'user_name', '=', $name,
                                        'email', '=', $email,
                                        'type', '=', $type,
                                    );

                                    if(!empty($image)){

                                        $new_name   = rand(1000, 99999).'.'.$extension;

                                        $data[] = 'image';
                                        $data[] = '=';
                                        $data[] = $new_name;   
                                    }

                                    $where = array(

                                        'id', '=', $u_id,
                                    );

                                    if($update->updateUsers('users', $data, $where)){

                                        $message[] = "Successfully Update User";

                                        $_SESSION['messages']   = $message;
                                        $_SESSION['class_name'] = 'alert-success';

                                        require_once ('messages.php');

                                        if(!empty($image)){

                                            if(isset($image)){
                                               
                                               $path = "images/users/$db_image";
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
                                <h3 class="card-header">Edit User</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$u_id"; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>User Name <span class="text-danger">(Unique)</span></label>
                                            <input type="text" name="name" autocomplete="off" class="form-control" value="<?php echo $db_name;?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Email address</label>
                                            <input type="email" name="email" autocomplete="off" class="form-control" value="<?php echo $db_email;?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="pass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Repeat Password</label>
                                            <input type="password" name="con_pass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Type <span class="text-danger">(Unique)</span></label>
                                            <input type="text" name="type" autocomplete="off" class="form-control" value="<?php echo $db_type;?>" readonly>
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
