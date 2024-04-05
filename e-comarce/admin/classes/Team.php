<?php
	
	require_once ('Database.php');

	class Team extends Database{

		public $query, $error;

		public function addteam($name, $name_b, $title, $title_b, $fb, $tw, $in, $pn, $new_name){

			if($this->Insert('team',['name','name_bangla','title','title_bangla','facebook','twitter','linkedin','pinterest','image'],[$name, $name_b, $title, $title_b, $fb, $tw, $in, $pn, $new_name])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function getteam($where = null){

			if($this->Select(['*'], 'team', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function updateteam($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function deleteteam($table, $where){

			if($this->Delete($table,['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}
	}
?>