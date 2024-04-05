<?php
	
	require_once ('Database.php');

	class ChangeStatus extends Database{

		public $query, $error;

		public function UpdateStatus($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}
	}
?>