<?php
    
    require_once ('config.php');

    $id = (int) $_GET['id'];

    $categories = new Categories;
    
    $categories->deletecategories('categories', $id);

    header("Location:add-product-category.php"); 
?>