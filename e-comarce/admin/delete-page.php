<?php
    
    require_once ('config.php');

    $id = (int) $_GET['id'];

    $pages = new Pages;
    $pages->getpages(['id', '=', $id]);
    $query 		= $pages->query;
    $result     = $query->fetch_assoc();
    $slug       = $result['page_slug'];
    
    if($pages->deletepages('pages', $id)){
        
        if(isset($slug)){
                                               
           	$path_1 = "../$slug";
            unlink($path_1);  
        }

        header("Location:page-lists.php");
    }
?>