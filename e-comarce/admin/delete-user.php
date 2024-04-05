<?php
    
    require_once ('config.php');

    $id = (int) $_GET['id'];

    $users = new Users;
    $users->getUsers(['id', '=', $id]);
    $query = $users->query;

    $result = $query->fetch_assoc();
    $db_image  = $result['image'];

    if($users->deleteUsers('users', $id)){

    	if(isset($db_image)){
                                               
           	$path = "images/users/$db_image";
            unlink($path); 
        }

        header("Location:user-lists.php");
    }
?>