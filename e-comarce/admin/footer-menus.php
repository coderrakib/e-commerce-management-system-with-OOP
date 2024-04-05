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

            $menus = new Menus;
            $menus->GetFooterMenus();
            $query = $menus->query;
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Footer Menus </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'footer-menus.php'; ?>" class="breadcrumb-link">Footer Menus</a></li>
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

                                $name     = ucwords($_POST['name']);
                                $bangla   = $_POST['b_name'];
                                $page     = $_POST['page_name'];
                               
                                $form_data  = array(

                                    array(

                                        'field_name'    => 'name',
                                        'name'          => 'Menu Item',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 100,
                                    ),

                                    array(

                                        'field_name'    => 'b_name',
                                        'name'          => 'Menu Bangla Name',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 500,
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

                                    $insert = new Menus;

                                    if($insert->AddFooterMenus($name,$bangla,$page)){
                                        
                                        $message[] = "Successfully Save Menu Item";

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
                        <?php

                            if(isset($_POST['submit']) && $_POST['submit'] === 'Update'){

                                $get_id   = $_POST['hidden'];

                                $name     = ucwords($_POST['name']);
                                $bangla   = $_POST['b_name'];
                                $page     = $_POST['page_name'];

                                $form_data  = array(

                                    array(

                                        'field_name'    => 'name',
                                        'name'          => 'Menu Item',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 100,
                                    ),

                                    array(

                                        'field_name'    => 'b_name',
                                        'name'          => 'Menu Bangla Name',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 500,
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

                                    $update = new Menus;

                                    $data = array(

                                        'menu_item_name',   '=', $name,
                                        'menu_item_bangla', '=', $bangla,
                                        'page_id',          '=', $page,
                                    );

                                    $where = array(

                                        'id', '=', $get_id,
                                    );

                                    if($update->UpdateFooterMenus('footer_menus', $data, $where)){
    
                                        $message[] = "Successfully Update Footer Menu";

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
                                <h3 class="card-header">Footer Menus</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Menu Item Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Menu Item Name <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="b_name" class="form-control">
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
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h3 class="card-header">All Footer Menus</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Menu Item Name</th>
                                      <th>Menu Item Name (Bangla)</th>
                                      <th>Page Name</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>#</th>
                                      <th>Menu Item Name</th>
                                      <th>Menu Item Name (Bangla)</th>
                                      <th>Page Name</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    <?php 

                                        $sl = 1;

                                        while ($row = $query->fetch_assoc()) { 

                                        $id             = $row['id'];
                                        $db_menu        = $row['menu_item_name'];
                                        $db_menu_bangla = $row['menu_item_bangla'];
                                        $db_page_id     = $row['page_id'];
                                        $db_status      = $row['status'];
                                    ?>
                                    <tr>
                                      <td><?php echo $sl; ?></td>
                                      <td><?php echo $db_menu;?></td>
                                      <td><?php echo $db_menu_bangla;?></td>
                                      <td>
                                        <?php 

                                            $pages = new Pages;
                                            $pages->getpages(['id', '=', $db_page_id]);
                                            $page_query = $pages->query;

                                            if(mysqli_num_rows($page_query) >= 1){

                                                while ($result = $page_query->fetch_assoc()) {
                                                    
                                                    $page_name = $result['page_name'];

                                                    echo ucwords($page_name);
                                                }
                                            }
                                        ?>
                                      </td>
                                      <td>
                                        <?php 

                                            if($db_status == 0){
                                                echo "<a href='change-status.php?id=$id&&value=1&&table=footer_menus' class='btn btn-danger'>Disable</a>";
                                            }elseif($db_status == 1){
                                                echo "<a href='change-status.php?id=$id&&value=0&&table=footer_menus' class='btn btn-success'>Enable</a>";
                                            }
                                        ?>
                                      </td>
                                      <td>
                                        <!-- edit modal -->
                                        <button type="button" class="btn btn-success btn-sm d-inline-block" data-toggle="modal" data-target="#exampleModal-<?php echo $id;?>">
                                          <i class="fa fa-edit"></i>&nbsp;Edit
                                        </button>
                                        <?php

                                            $edit_menus = new Menus;
                                            $edit_menus->GetFooterMenus(['id','=',$id]);
                                            $edit_query = $edit_menus->query;
                                            $row        = $edit_query->fetch_assoc();
                                            $db_menu_item       = $row['menu_item_name'];
                                            $db_menu_item_ban   = $row['menu_item_bangla'];
                                            $db_menu_page_id    = $row['page_id'];
                                        ?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Footer Menu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>Menu Item Name</label>
                                                        <input type="text" name="name" class="form-control" value="<?php echo $db_menu_item?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Menu Item Name <span class="text-danger">(Bangla)</span></label>
                                                        <input type="text" name="b_name" class="form-control" value="<?php echo $db_menu_item_ban?>">
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
                                                            <option value="<?php echo $page_id; ?>" <?php if($page_id == $db_menu_page_id){ echo 'selected="selected"'; } ?>><?php echo $page_name; ?></option> 
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <input type="hidden" name="hidden" value="<?php echo $id; ?>">
                                                    <button type="button" class="btn btn-space btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" name="submit" value="Update" class="btn btn-space btn-primary">
                                                  </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>

                                        <button type="button" class="btn btn-danger btn-sm d-inline-block" data-toggle="modal" data-target="#exampleModalCenter-<?php echo $id;?>">
                                          <i class="fa fa-trash-alt"></i>&nbsp;Delete
                                        </button></td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLongTitle">Delete Footer Menus</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <h5 class="text-center">If you want to delete footer menus ?</h5>
                                              </div>
                                              <div class="modal-footer">
                                                <a href='<?php echo "delete-footer-menus.php?id=$id"?>' class="btn btn-danger">Yes</a>
                                                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </tr>
                                    <?php $sl++; } ?>
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
