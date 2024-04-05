<?php
	
	require_once ('Database.php');

	class Pages extends Database{

		public $query, $error;

		public function addpages($name, $title, $slug, $description){

			if($this->Insert('pages',['page_name','page_title','page_slug','page_description'],[$name, $title, $slug, $description])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function getpages($where = null){

			if($this->Select(['*'], 'pages', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function updatepages($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function deletepages($table, $where){

			if($this->Delete('pages',['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}
	}
?>