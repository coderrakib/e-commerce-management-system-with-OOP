<?php
	
	$class_name = $_SESSION['class_name'];

	foreach ($_SESSION['messages'] as $message) {
		
		echo "<div class='alert $class_name alert-dismissible fade show mb-4 mt-4' role='alert'>
  			<strong>$message</strong>
  			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    			<span aria-hidden='true'>&times;</span>
  			</button>
		</div>";
	}
?>