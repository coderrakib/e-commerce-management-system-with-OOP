<?php
    
    require_once ('config.php');

    $id = (int) $_GET['id'];

    $menu = new Menus;
    
    $menu->DeleteFooterMenus('footer_menus', $id);

    header("Location:footer-menus.php"); 
?>