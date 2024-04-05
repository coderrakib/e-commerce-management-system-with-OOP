<?php
	
	require_once ('Database.php');

	class Validation extends Database
	{
		public $errors 		= array();
		public $allowedType = array('jpeg','jpg','png','mp4','webm','mkv','3gp','gif');
		public $allowedsize = 1048576;
		public $hasErrorPassed = false;
		public $query;
		public $mysqli;

		public function validate($form_data){	

			foreach ($form_data as $key => $data) {

				if(isset($_POST[$data['field_name']])){

					if(isset($data['required']) && empty($_POST[$data['field_name']])){

						$this->errors[] = $data['name'].' is Required.';
					}
					if(!empty($_POST[$data['field_name']])){

						if(isset($data['min']) && strlen($_POST[$data['field_name']]) < $data['min']) {
						
							$this->errors[] = $data['name'].' Value Must be Greater Than '.$data['min'].
							' Characters Long';

						}if (isset($data['max']) && strlen(empty($_POST[$data['field_name']])) > $data['max']) {
						
							$this->errors[] = $data['name'].' Value Must be Less Than '.$data['max'].
							' Characters Long';

						}if (isset($data['matching']) && $_POST[$data['field_name']] != $data['matching']) {
						
							$this->errors[] = 'Password and Confirm Password is Not Match';

						}if (isset($data['unique']) && ($data['table']) && ($data['column']) && $_POST[$data['field_name']]){

							$field = $_POST[$data['field_name']];
							$table = $data['table'];
							$col   = $data['column'];
							$name  = $data['name'];

							$sql 	= "SELECT * FROM $table WHERE $col = '$field'";
							$query  = $this->mysqli->query($sql);

							while ($row = $query->fetch_assoc()) {
							
							$column = $row[$col];	
						}

							if(isset($column)){

								if($field == $column){

									$this->errors[] = "This $name is Already Taken. Try Another";
								}
							}	
						}

					}
				}

				if(isset($data['type']) && $data['type'] == 'file'){

					if(isset($data['required']) && empty($_FILES[$data['field_name']]['name'])){

						$this->errors[] = $data['name'].' is Required.';
					}
					
					if(!empty($_FILES[$data['field_name']]['name'])){

						$explode 	= explode('.', $_FILES[$data['field_name']]['name']);
						$extension  = strtolower(end($explode));
					
						if(!in_array($extension, $this->allowedType)){

							$this->errors[] = 'We are only accepting jpeg , jpg and png images and mp4, webm, mkv, 3gp, gif videos';
					
						}/*if($_FILES[$data['field_name']]['size'] > $this->allowedsize){

							$this->errors[] = 'We are only 1mb image size';
						}*/
					}	
				}
			}

			if(!empty($this->errors)){

				$_SESSION['messages'] 	= $this->errors;
				$_SESSION['class_name'] = 'alert-danger';

				require_once ('messages.php');

			}else{

				$this->hasErrorPassed = true;
			}
		}	
	}
?>