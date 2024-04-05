<?php
	
	require_once ('Database.php');

	class Customers extends Database{

		public $query, $error;

		public function addcustomer($customer_id, $phone, $hash_pass){

			if($this->Insert('customers',['customer_id','phone','password'],[$customer_id, $phone, $hash_pass])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function getcustomer($where = null){

			if($this->Select(['*'], 'customers', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function updatecustomer($table, $columnValue, $where){

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

		public function customerLogin($log_phone, $log_hash_pass){

			if($this->Select(['*'], 'customers', ['phone', '=', $log_phone, 'password', '=',
			$log_hash_pass, 'status', '=', 1])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}
	}
?>