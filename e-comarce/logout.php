<?php

	require_once ('admin/config.php');

	session_destroy();
	
	header("Refresh:1; url= index.php");
?>