<?php

	require_once ('config.php');

	session_destroy();
	
	header("Refresh:1; url= index.php");
?>