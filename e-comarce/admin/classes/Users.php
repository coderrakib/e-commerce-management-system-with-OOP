<?php
	
	require_once ('Database.php');

	class Users extends Database{

		public $query, $error;

		public function addusers($name,$email,$hash_pass,$type,$new_name){

			if($this->Insert('users',['user_name','email','password','type','image','status'],[$name,$email,$hash_pass,$type,$new_name,0])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function getUsers($where = null){

			if($this->Select(['*'], 'users', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function updateUsers($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function deleteUsers($table, $where){

			if($this->Delete('users',['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}
	}
?>