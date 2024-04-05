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
                            <h2 class="pageheader-title"> Add Product </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'add-product.php'; ?>" class="breadcrumb-link">Add Product</a></li>
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

                                $name                   = $_POST['name'];
                                $name_b                 = $_POST['name_b'];
                                $p_category             = $_POST['p_category'];
                                $price                  = $_POST['price'];
                                $price_b                = $_POST['price_b'];
                                $dis_check              = $_POST['dis_check'];
                                $dis_price              = $_POST['dis_price'];
                                $dis_price_b            = $_POST['dis_price_b'];
                                $weight                 = $_POST['weight'];
                                $weight_b               = $_POST['weight_b'];
                                $weight_type            = $_POST['weight_type'];
                                
                                $image                  = $_FILES['image']['name'];
                                $image_tmp              = $_FILES['image']['tmp_name'];

                                $description            = $_POST['description'];
                                $description_b          = $_POST['description_b'];
                                $short_description      = $_POST['short_description'];
                                $short_description_b    = $_POST['short_description_b'];
                                $info                   = $_POST['info'];
                                $info_b                 = $_POST['info_b'];

                                $categories             = new Categories;
                                $categories->getcategories(['category_name', '=', $p_category]);
                                $cat_query              = $categories->query;
                                $cat_result             = $cat_query->fetch_assoc();

                                $parent_name            = $cat_result['parent_name'];
                                $product_id             = trim(str_replace(' ','',$parent_name)).rand(1000,99999);

                                
                                $directory  = 'images/products/';

                                $form_data  = array(

                                    array(

                                        'field_name'    => 'name',
                                        'name'          => 'Product Name',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 50,
                                    ),

                                    array(

                                        'field_name'    => 'name_b',
                                        'name'          => 'Product Name Bangla',
                                        'required'      => true,
                                        'min'           => 2,
                                        'max'           => 100,
                                    ),

                                    array(

                                        'field_name'    => 'p_category',
                                        'name'          => 'Product Category',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'price',
                                        'name'          => 'Price',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'price_b',
                                        'name'          => 'Price Bangla',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'weight',
                                        'name'          => 'Weight',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'weight_b',
                                        'name'          => 'Weight Bangla',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'weight_type',
                                        'name'          => 'Weight Type',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'image',
                                        'type'          => 'file',
                                        'name'          => 'Image',
                                        'required'      => true,
                                    ),

                                    array(

                                        'field_name'    => 'description',
                                        'name'          => 'Description',
                                        'required'      => true,
                                        'min'           => 5,
                                    ),

                                    array(

                                        'field_name'    => 'description_b',
                                        'name'          => 'Description Bangla',
                                        'required'      => true,
                                        'min'           => 5,
                                    ),

                                    array(

                                        'field_name'    => 'short_description',
                                        'name'          => 'Short Description',
                                        'required'      => true,
                                        'min'           => 5,
                                    ),

                                    array(

                                        'field_name'    => 'short_description_b',
                                        'name'          => 'Short Description Bangla',
                                        'required'      => true,
                                        'min'           => 5,
                                    ),

                                    array(

                                        'field_name'    => 'info',
                                        'name'          => 'Information',
                                        'required'      => true,
                                        'min'           => 5,
                                    ),

                                    array(

                                        'field_name'    => 'info_b',
                                        'name'          => 'Information Bangla',
                                        'required'      => true,
                                        'min'           => 5,
                                    ),
                                );

                                $validation     = new Validation;
                                $validation->validate($form_data);

                                if($validation->hasErrorPassed){

                                    $image               = explode('.', $image);
                                    $image_extension     = end($image);
                                    $image_new_name      = rand(1000, 99999).'.'.$image_extension;

                                    $insert = new Products;

                                    if($insert->addproduct($product_id, $parent_name, $name, $name_b, $p_category, $price, $price_b, $dis_check, $dis_price, $dis_price_b, $weight, $weight_b, $weight_type, $image_new_name, $description, $description_b, $short_description, $short_description_b, $info, $info_b)){

                                        move_uploaded_file($image_tmp, $directory.$image_new_name);
                                      
                                        $message[] = "Successfully Save Products";

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
                                <h3 class="card-header">Add Product</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Name <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="name_b" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Category <span class="text-danger">*</span></label>
                                            <select name="p_category" class="form-control">
                                                <option value="">Select Product Category</option>
                                                <?php 

                                                    $getcategories = new Categories;
                                                    $getcategories->getcategories();
                                                    $query = $getcategories->query;

                                                    while ($result = $query->fetch_assoc()) {
                                                        
                                                        if(!empty($result['parent_name'])){

                                                            $name = $result['category_name'];

                                                            echo "<option value='$name'>$name</option>";
                                                        }
                                                ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Price <span class="text-danger">*</span></label>
                                            <input type="text" name="price" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Price <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="price_b" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">If you want to discount Price ? Check Now</label>&nbsp;&nbsp;
                                           <input class="form-check-input" name="dis_check" type="checkbox" value="1">
                                        </div>
                                        <div class="form-group">
                                            <label>Discount Price <span class="text-danger">(Just %)</span></label>
                                            <input type="text" name="dis_price" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Discount Price <span class="text-danger">(Just %)</span> <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="dis_price_b" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Weight <span class="text-danger">*</span></label>
                                            <input type="text" name="weight" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Weight <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="weight_b" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Weight Type <span class="text-danger">*</span></label>
                                            <select name="weight_type" class="form-control">
                                                <option value="">Select Product Weight Type</option>
                                                <option value="Pieces">Pieces</option>
                                                <option value="Kg">Kg</option>
                                                <option value="Litter">Litter</option>
                                                <option value="Gm">Gm</option>
                                                <option value="Ml">Ml</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Image <span class="text-danger">*</span></label>
                                            <input type="file" name="image" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Description <span class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('description');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Description <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="description_b" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('description_b');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Short Description <span class="text-danger">*</span></label>
                                            <textarea name="short_description" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('short_description');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Short Description <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="short_description_b" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('short_description_b');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Information <span class="text-danger">*</span></label>
                                            <textarea name="info" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('info');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Information <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="info_b" class="form-control"></textarea>
                                            <script>
                                                CKEDITOR.replace('info_b');
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
