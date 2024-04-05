<?php
    
    require_once ('config.php');

    $id = (int) $_GET['id'];

    $menu = new Menus;
    
    $menu->DeleteHeaderMenus('menus', $id);

    header("Location:header-menus.php"); 
?>