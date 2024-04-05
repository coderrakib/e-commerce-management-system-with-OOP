<?php
    
    require_once ('config.php');

    $id = (int) $_GET['id'];

    $team 	= new Team;
    $team->getteam(['id', '=', $id]);
    $query 		= $team->query;
    $result     = $query->fetch_assoc();
    $db_image   = $result['image'];

    if($team->deleteteam('team', $id)){
        
        if(isset($db_image)){
                                               
           	$path = "images/team/$db_image";
            unlink($path); 
        }

        header("Location:team.php");
    }
?>