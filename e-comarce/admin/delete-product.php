<?php
    
    require_once ('config.php');

    $id = (int) $_GET['id'];

    $product = new Products;
    $product->getproduct(['id', '=', $id]);
    $query 		= $product->query;
    $result     = $query->fetch_assoc();
    $image      = $result['product_image'];
    
    if($product->deleteproduct('products', $id)){
        
        if(isset($image)){
                                               
           	$path_1 = "images/products/$image";
            unlink($path_1);  
        }

        header("Location:product-lists.php");
    }
?>