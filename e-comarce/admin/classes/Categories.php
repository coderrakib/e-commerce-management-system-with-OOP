<?php
	
	require_once ('Database.php');

	class Categories extends Database{

		public $query, $error;

		public function addcategories($parent, $name, $b_name){

			if($this->Insert('categories',['category_name','category_bangla','parent_name'],[$name,$b_name,$parent])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function getcategories($where = null){

			if($this->Select(['*'], 'categories', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function updatecategories($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function deletecategories($table, $where){

			if($this->Delete($table,['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}
	}
?>