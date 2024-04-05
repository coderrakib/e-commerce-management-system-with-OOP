<?php
	
	require_once ('Database.php');

	class OrderByLimit extends Database{

		public $query, $error;

		public function GetLimitCategory($where = null, $orderByCol, $orderByValue, $limit){

			if($this->LimitSelect(['*'], 'categories', $where, $orderByCol, $orderByValue, $limit)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function GetOrderByProduct($where = null, $orderByCol, $orderByValue){

			if($this->OrderBySelect(['*'], 'products', $where, $orderByCol, $orderByValue)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function GetLimitProduct($where = null, $orderByCol, $orderByValue, $limit){

			if($this->LimitSelect(['*'], 'products', $where, $orderByCol, $orderByValue, $limit)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}
	}
?>