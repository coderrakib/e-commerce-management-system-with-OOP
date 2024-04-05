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
                            <h2 class="pageheader-title"> Product Categories </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'add-product-category.php'; ?>" class="breadcrumb-link">Product Categories</a></li>
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

                                $parent     = $_POST['p_category'];
                                $name       = ucwords($_POST['name']);
                                $b_name     = $_POST['b_name'];
                            
                                $form_data  = array(

                                    array(

                                        'field_name'    => 'p_category',   
                                    ),

                                    array(

                                        'field_name'    => 'name',
                                        'name'          => 'Category Name',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 100,
                                        'unique'        => true,
                                        'table'         => 'categories',
                                        'column'        => 'category_name',
                                    ),

                                    array(

                                        'field_name'    => 'b_name',
                                        'name'          => 'Category Bangla Name',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 100,
                                    ),
                                );

                                $validation     = new Validation;
                                $validation->validate($form_data);

                                if($validation->hasErrorPassed){      

                                    $insert = new Categories;

                                    if($insert->addcategories($parent, $name, $b_name)){

                                        $message[] = "Successfully Save Product Category";

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

                                $get_id     = $_POST['hidden'];

                                $update_parent     = $_POST['p_category'];
                                $update_name       = $_POST['name'];
                                $update_b_name     = $_POST['b_name'];

                                $form_data  = array(

                                    array(

                                        'field_name'    => 'p_category',   
                                    ),

                                    array(

                                        'field_name'    => 'name',
                                        'name'          => 'Category Name',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 100,
                                    ),

                                    array(

                                        'field_name'    => 'b_name',
                                        'name'          => 'Category Bangla Name',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 100,
                                    ),
                                );

                                $validation     = new Validation;
                                $validation->validate($form_data);

                                if($validation->hasErrorPassed){

                                
                                    $update = new Categories;

                                    $data = array(

                                        'category_name', '=', $update_name,
                                        'category_bangla', '=', $update_b_name,
                                        'parent_name', '=', $update_parent,
                                    );

                                    $where = array(

                                        'id', '=', $get_id,
                                    );

                                    if($update->updatecategories('categories', $data, $where)){
    
                                        $message[] = "Successfully Update Product Category";

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
                                <h3 class="card-header">Product Categories</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Parent Category</label>
                                            <select name="p_category" class="form-control">
                                                <option value="">Select Parent Category</option>
                                                <?php 

                                                    $getcategories = new Categories;
                                                    $getcategories->getcategories(['parent_name', '=', '']);
                                                    $query = $getcategories->query;

                                                    while ($result = $query->fetch_assoc()) {
                                                        
                                                        $name = $result['category_name'];
       
                                                ?>
                                                
                                                <option value="<?php echo $name; ?>"><?php echo $name; ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Category Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Category Name <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="b_name" class="form-control">
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
                            <h3 class="card-header">All Product Categories</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Category Name</th>
                                      <th>Category Name Bangla</th>
                                      <th>Parent Name</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>#</th>
                                      <th>Category Name</th>
                                      <th>Category Name Bangla</th>
                                      <th>Parent Name</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    <?php 

                                        $getcategories = new Categories;
                                        $getcategories->getcategories();
                                        $query = $getcategories->query;

                                        $sl = 1;

                                        while ($row = $query->fetch_assoc()) { 

                                        $id             = $row['id'];
                                        $db_name        = $row['category_name'];
                                        $db_name_bangla = $row['category_bangla'];
                                        $db_parent      = $row['parent_name'];
                                        $db_status      = $row['status'];
                                    ?>
                                    <tr>
                                      <td><?php echo $sl++; ?></td>
                                      <td><?php echo $db_name;?></td>
                                      <td><?php echo $db_name_bangla;?></td>
                                      <td>
                                        <?php echo $db_parent; ?>
                                      </td>
                                      <td>
                                        <?php 

                                            if($db_status == 0){
                                                echo "<a href='change-status.php?id=$id&&value=1&&table=categories' class='btn btn-danger'>Disable</a>";
                                            }elseif($db_status == 1){
                                                echo "<a href='change-status.php?id=$id&&value=0&&table=categories' class='btn btn-success'>Enable</a>";
                                            }
                                        ?>
                                      </td>
                                      <td>
                                        <!-- Edit Modal -->
                                        <button type="button" class="btn btn-success btn-sm btn-inline-block" data-toggle="modal" data-target="#exampleModal-<?php echo $id;?>">
                                          <i class="fa fa-edit"></i>&nbsp;Edit
                                        </button>

                                        <?php
    
                                            $categories_edit = new Categories;
                                            $categories_edit->getcategories(['id','=',$id]);
                                            $query_edit = $categories_edit->query;
                                            $row        = $query_edit->fetch_assoc();
                                            $db_name        = $row['category_name'];
                                            $db_name_bangla = $row['category_bangla'];
                                            $db_parent      = $row['parent_name'];
                                        ?>
                                        
                                        <div class="modal fade" id="exampleModal-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                                  <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Parent Category</label>
                                                            <select name="p_category" class="form-control">
                                                                <option value="">Select Parent Category</option>
                                                                    <?php 
                                                                        
                                                                        $getcategories_fetch = new Categories;
                                                                        $getcategories_fetch->getcategories(['parent_name', '=', '']);
                                                                        $query_fetch = $getcategories_fetch->query;

                                                                        while ($result = $query_fetch->fetch_assoc()) {
                                                        
                                                                            $name           = $result['category_name'];      
                                                                    ?>
                                                                <option value="<?php echo $name; ?>"<?php if($db_parent == $name){echo 'selected="selected"';}?>><?php echo $name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail">Category Name</label>
                                                            <input type="text" name="name" class="form-control" value="<?php echo $db_name;?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail">Category Name <span class="text-danger">(Bangla)</span></label>
                                                            <input type="text" name="b_name" class="form-control" value="<?php echo $db_name_bangla;?>">
                                                        </div>
                                                    </div>
                                                  <div class="modal-footer">
                                                    <input type="hidden" name="hidden" value="<?php echo $id; ?>">
                                                    <input class="btn btn-primary" type="submit" name="submit" value="Update">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- Delete Modal -->
                                        <button type="button" class="btn btn-danger btn-sm d-inline-block" data-toggle="modal" data-target="#exampleModalCenter-<?php echo $id;?>">
                                          <i class="fa fa-trash-alt"></i>&nbsp;Delete
                                        </button></td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLongTitle">Delete Product Category</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <h5 class="text-center">If you want to delete product category ?</h5>
                                              </div>
                                              <div class="modal-footer">
                                                <a href='<?php echo "delete-category.php?id=$id"?>' class="btn btn-danger">Yes</a>
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
