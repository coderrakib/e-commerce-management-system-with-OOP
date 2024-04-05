<?php
	
	require_once ('Database.php');

	class Menus extends Database{

		public $query, $error;

		public function AddHeaderMenus($name,$bangla,$page){

			if($this->Insert('menus',['menu_item_name','menu_item_bangla','page_id'],[$name,$bangla,$page])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function GetHeaderMenus($where = null){

			if($this->Select(['*'], 'menus', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function UpdateHeaderMenus($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function DeleteHeaderMenus($table, $where){

			if($this->Delete($table,['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		/* footer menus */

		public function AddFooterMenus($name,$bangla,$page){

			if($this->insert('footer_menus',['menu_item_name','menu_item_bangla','page_id'],[$name,$bangla,$page])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function GetFooterMenus($where = null){

			if($this->Select(['*'], 'footer_menus', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function UpdateFooterMenus($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function DeleteFooterMenus($table, $where){

			if($this->Delete($table,['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

	}
?>