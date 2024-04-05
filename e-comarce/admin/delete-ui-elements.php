<?php
    
    require_once ('config.php');

    $id = (int) $_GET['id'];

    $elements 	= new PageElements;
    $elements->getelements(['id', '=', $id]);
    $query 		= $elements->query;
    $result     = $query->fetch_assoc();
    $db_header_banner    = $result['header_banner'];
    $db_footer_1_banner  = $result['footer_banner_1'];
    $db_footer_2_banner  = $result['footer_banner_2'];
    $db_image            = $result['image'];

    if($elements->deleteelements('ui_elements', $id)){
        
        if(isset($db_header_banner)){
                                               
           	$path = "images/banner/$db_header_banner";
            unlink($path); 
        }

        if(isset($db_footer_1_banner)){
                                               
            $path = "images/banner/$db_footer_1_banner";
            unlink($path); 
        }

        if(isset($db_footer_2_banner)){
                                               
            $path = "images/banner/$db_footer_2_banner";
            unlink($path); 
        }

        if(isset($db_image)){
                                               
            $path = "images/banner/$db_image";
            unlink($path); 
        }

        header("Location:ui-element-lists.php");
    }
?>