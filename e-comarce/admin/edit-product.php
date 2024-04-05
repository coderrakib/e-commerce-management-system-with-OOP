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
            
            $get_product    = new Products;
            $get_product->getproduct(['id', '=', $get_id]);
            $query                  = $get_product->query;
            $result                 = $query->fetch_assoc();
            $db_name                = $result['product_name'];
            $db_name_b              = $result['product_name_b'];
            $db_category            = $result['product_category'];
            $db_price               = $result['product_price'];
            $db_price_b             = $result['product_price_b'];
            $db_dis_check           = $result['dis_check'];

            $db_dis_price           = $result['discount_price'];
            $db_dis_price_b         = $result['discount_price_b'];
            $db_weight              = $result['product_weight'];
            $db_weight_b            = $result['product_weight_b'];
            $db_weight_type         = $result['product_weight_type'];
            $db_image               = $result['product_image'];
            $db_dec                 = $result['product_dec'];
            $db_dec_b               = $result['product_dec_b'];
            $db_short_dec           = $result['product_short_dec'];
            $db_short_dec_b         = $result['product_short_dec_b'];
            $db_info                = $result['product_info'];
            $db_info_b              = $result['product_info_b'];
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Edit Product </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'edit-product.php'; ?>" class="breadcrumb-link">Edit Product</a></li>
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

                                $name                   = $_POST['name'];
                                $name_b                 = $_POST['name_b'];
                                $p_category             = $_POST['p_category'];
                                $price                  = $_POST['price'];
                                $price_b                = $_POST['price_b'];
                                $dis_check              = isset($_POST['dis_check']) ? $_POST['dis_check'] : 0;
                                $dis_price              = $_POST['dis_price'];
                                $dis_price_b            = $_POST['dis_price_b'];
                                $weight                 = $_POST['weight'];
                                $weight_b               = $_POST['weight_b'];
                                $weight_type            = $_POST['weight_type'];
                                
                                $product_image          = $_FILES['image']['name'];
                                $product_image_tmp      = $_FILES['image']['tmp_name'];

                                $description            = $_POST['description'];
                                $description_b          = $_POST['description_b'];
                                $short_description      = $_POST['short_description'];
                                $short_description_b    = $_POST['short_description_b'];
                                $info                   = $_POST['info'];
                                $info_b                 = $_POST['info_b'];
                                
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
                                    
                                    $update = new Products;

                                    $data   = array(

                                        'product_name',     '=', $name,
                                        'product_name_b',   '=', $name_b,
                                        'product_category', '=', $p_category,
                                        'product_price',    '=', $price,
                                        'product_price_b',  '=', $price_b,
                                        'dis_check',        '=', $dis_check,
                                        'discount_price',   '=', $dis_price,
                                        'discount_price_b', '=', $dis_price_b,
                                        'product_weight',   '=', $weight,
                                        'product_weight_b', '=', $weight_b,
                                        'product_weight_type', '=', $weight_type,
                                        'product_dec',      '=', $description,
                                        'product_dec_b',    '=', $description_b,
                                        'product_short_dec','=', $short_description,
                                        'product_short_dec_b','=', $short_description_b,
                                        'product_info',     '=', $info,
                                        'product_info_b',   '=', $info_b,
                                    );

                                    if(!empty($product_image)){

                                        $image_new_name  = rand(1000, 99999).'.'.$image_extension;

                                        $data[] = 'product_image';
                                        $data[] = '=';
                                        $data[] = $image_new_name;
                                    }

                                    $where  = array(

                                        'id', '=', $get_id,
                                    );

                                    if($update->updateproduct('products',$data,$where)){

                                        $message[] = "Successfully Update Products";

                                        $_SESSION['messages']   = $message;
                                        $_SESSION['class_name'] = 'alert-success';

                                        require_once ('messages.php');

                                        if(!empty($product_image)){

                                            if(isset($product_image)){
                                               
                                                $path = "images/products/$db_image";
                                                unlink($path); 
                                            }
                                            
                                           move_uploaded_file($product_image_tmp, $directory.$image_new_name);
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
                                <h3 class="card-header">Edit Product</h3>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$get_id"; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" autocomplete="off" class="form-control" value="<?php echo $db_name; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Name <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="name_b" autocomplete="off" class="form-control" value="<?php echo $db_name_b; ?>">
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
                                                    ?>

                                                    <option value="<?php echo $name ?>" <?php if ($db_category == $name){echo "selected ='selected'";} ?>><?php echo $name ?></option>

                                                <?php }} ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Price <span class="text-danger">*</span></label>
                                            <input type="text" name="price" autocomplete="off" class="form-control" value="<?php echo $db_price; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Price <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="price_b" autocomplete="off" class="form-control" value="<?php echo $db_price_b; ?>">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">If you want to discount Price ? Check Now</label>&nbsp;&nbsp;
                                           <input class="form-check-input" name="dis_check" type="checkbox" value="1" <?php if($db_dis_check == 1){echo "checked='checked'";}?>>
                                        </div>
                                        <div class="form-group">
                                            <label>Discount Price <span class="text-danger">(Just %)</span></label>
                                            <input type="text" name="dis_price" autocomplete="off" class="form-control" value="<?php echo $db_dis_price; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Discount Price <span class="text-danger">(Just %)</span> <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="dis_price_b" autocomplete="off" class="form-control" value="<?php echo $db_dis_price_b; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Weight <span class="text-danger">*</span></label>
                                            <input type="text" name="weight" autocomplete="off" class="form-control" value="<?php echo $db_weight; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Weight <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <input type="text" name="weight_b" autocomplete="off" class="form-control" value="<?php echo $db_weight_b; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Weight Type <span class="text-danger">*</span></label>
                                            <select name="weight_type" class="form-control">
                                                <option value="">Select Product Weight Type</option>
                                                <option value="Pisce" <?php if($db_weight_type == 'Pisce'){echo "selected='selected'";} ?>>Pisce</option>
                                                <option value="Kg" <?php if($db_weight_type == 'Kg'){echo "selected='selected'";} ?>>Kg</option>
                                                <option value="Litter" <?php if($db_weight_type == 'Litter'){echo "selected='selected'";} ?>>Litter</option>
                                                <option value="Gm" <?php if($db_weight_type == 'Gm'){echo "selected='selected'";} ?>>Gm</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Product Image <span class="text-danger">*</span></label></br>
                                            <img class="mb-2" src="images/products/<?php echo $db_image; ?>" width="100px">
                                            <input type="file" name="image" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Description <span class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control"><?php echo $db_dec; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('description');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Description <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="description_b" class="form-control"><?php echo $db_dec_b; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('description_b');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Short Description <span class="text-danger">*</span></label>
                                            <textarea name="short_description" class="form-control"><?php echo $db_short_dec; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('short_description');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Short Description <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="short_description_b" class="form-control"><?php echo $db_short_dec_b; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('short_description_b');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Information <span class="text-danger">*</span></label>
                                            <textarea name="info" class="form-control"><?php echo $db_info; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('info');
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Information <span class="text-danger">*</span> <span class="text-danger">(Bangla)</span></label>
                                            <textarea name="info_b" class="form-control"><?php echo $db_info_b; ?></textarea>
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
