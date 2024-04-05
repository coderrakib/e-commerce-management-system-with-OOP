<?php
	
	require_once ('Database.php');

	class Settings extends Database{

		public $query, $error;

		public function AddGeneralSetting($header,$footer,$new_name){

			if($this->Insert('general_setting',['header_text','footer_text','logo'],[$header,$footer,$new_name])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function GetGeneralSetting($where = null){

			if($this->Select(['*'], 'general_setting', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function UpdateGeneralSetting($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function DeleteGeneralSetting($table, $where){

			if($this->Delete($table,['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		/* End general setting function */


		/* Start contact setting function */

		public function AddContactSetting($address,$open_time,$email, $phone, $facebook, $twitter, $linkedin, $pinterest, $instagram, $youtube){

			if($this->insert('contact_setting',['address','open_time','email','phone','facebook','twitter','linkedin','pinterest','instagram','youtube'],[$address,$open_time,$email,$phone,$facebook,$twitter,$linkedin,$pinterest,$instagram,$youtube])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function GetContactSetting($where = null){

			if($this->Select(['*'], 'contact_setting', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function UpdateContactSetting($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function DeleteContactSetting($table, $where){

			if($this->Delete($table,['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}
	}
?>