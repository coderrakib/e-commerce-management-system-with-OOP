<?php
    
    require_once ('config.php');

    $id = (int) $_GET['id'];

    $gSettings 	= new Settings;
    $gSettings->GetGeneralSetting(['id', '=', $id]);
    $query 		= $gSettings->query;
    $result     = $query->fetch_assoc();
    $db_logo    = $result['logo'];

    if($gSettings->DeleteGeneralSetting('general_setting', $id)){
        
        if(isset($db_logo)){
                                               
           	$path = "images/logo/$db_logo";
            unlink($path); 
        }

        header("Location:general-setting.php");
    }
?>