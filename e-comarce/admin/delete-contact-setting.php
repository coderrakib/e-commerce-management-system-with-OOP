<?php
    
    require_once ('config.php');

    $id = (int) $_GET['id'];

    $conSettings 	= new Settings;
   
    if($conSettings->DeleteContactSetting('contact_setting', $id)){

        header("Location:contact-setting.php");
    }
?>