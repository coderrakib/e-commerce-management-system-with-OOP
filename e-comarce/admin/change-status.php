<?php
	
	require_once ('config.php');

	$id 	= (int) $_GET['id'];
	$value  = (int) $_GET['value'];
	$table  = (string) $_GET['table'];

	$data 	= array(

		'status', '=', $value,
	);

	$where 	= array(
		'id', '=', $id,
	);

	$update = new ChangeStatus;

	if($update->UpdateStatus($table,$data,$where)){

		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
?>