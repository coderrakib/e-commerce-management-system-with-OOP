<?php
	
	class Database{

		protected $mysqli,$query,$numRows,$affectedRow,$errors;

		public function __construct(){

			$this->mysqli = new mysqli('localhost', 'root', '', 'e-commerce');

			if($this->mysqli->connect_error){

				die("Database Connect Error");
			}
		}

		protected function Insert($table,$columnName,$columnValue){

			$columnName 	= implode(',', $columnName);

			$columnValues 	= array();

			foreach ($columnValue as $key => $value) {
				
				$columnValues[] = "'$value'";	
			}

			$columnValue = implode(',', $columnValues);
			
			$sql = "INSERT INTO $table ($columnName) VALUES ($columnValue)";
			
			if($this->mysqli->query($sql)){
				return true;

			}else{
				
				$this->errors = $this->mysqli->error;
				return false;
			}
			
		}

		protected function Select($columnName,$table,$where){

			$columnName = implode(',', $columnName);
			$sql = "SELECT $columnName FROM $table ";
			
			if($where){

				$sql .= " WHERE ";

				$chunk 		= array_chunk($where, 3);

				$whereCols 	= array();

				foreach ($chunk as $key => $value) {

					if (is_string($value[2])) {
						
						$value[2] = "'$value[2]'";
					}else{

						$value[2] = $value[2];
					}
					
					$whereCols[] = implode(' ', $value);
				}

				$sql .= implode(' AND ', $whereCols);
				
			}
			
			if($this->mysqli->query($sql)){

				$this->query 	= $this->mysqli->query($sql);
				$this->numRows 	= $this->query->num_rows;

				if($this->numRows > 0){
					return true;
				}else{
					return false;
				}
				
			}else{
				
				return false;
			}
		}

		protected function Update($table, $colAndValues, $where){

			if($table && $colAndValues){

				$sql =  "UPDATE $table SET ";

				$chunk 		= array_chunk($colAndValues, 3);

				$values  = array();

				foreach ($chunk as $key => $value) {
					
					if (is_string($value[2])) {
						
						$value[2] = "'$value[2]'";
					}else{

						$value[2] = $value[2];
					}

					$values[] = implode(' ', $value);
				}

				$sql .= $colAndValues = implode(', ', $values);

				if($where){

				$sql .= " WHERE ";

				$chunk 		= array_chunk($where, 3);

				$whereCols 	= array();

				foreach ($chunk as $key => $value) {
					
					$whereCols[] = implode(' ', $value);
				}

				$sql .= implode(' AND ', $whereCols);
				
				}

				if($this->mysqli->query($sql)){
					$this->affectedRow = $this->mysqli->affected_rows;
					return true;
				}else{
				
					return false;
				}
			}
		}

		protected function Delete($table,$where){

			$sql = "DELETE FROM $table";

			if($where){

				$sql .= " WHERE ";

				$chunk 		= array_chunk($where, 3);

				$whereCols 	= array();

				foreach ($chunk as $key => $value) {
					
					$whereCols[] = implode(' ', $value);
				}

				$sql .= implode(' AND ', $whereCols);
				
			}

			if($this->mysqli->query($sql)){
				$this->affectedRow = $this->mysqli->affected_rows;
				return true;
			}else{
				
				return false;
			}
		}

		protected function OrderBySelect($columnName,$table,$where,$orderByCol,$orderByValue){

			$columnName = implode(',', $columnName);
			$sql = "SELECT $columnName FROM $table ";
			
			if($where){

				$sql .= " WHERE ";

				$chunk 		= array_chunk($where, 3);

				$whereCols 	= array();

				foreach ($chunk as $key => $value) {

					if (is_string($value[2])) {
						
						$value[2] = "'$value[2]'";
					}else{

						$value[2] = $value[2];
					}
					
					$whereCols[] = implode(' ', $value);
				}

				$sql .= implode(' AND ', $whereCols);
				
			}

			$sql .= " ORDER BY $orderByCol $orderByValue";

			if($this->mysqli->query($sql)){

				$this->query 	= $this->mysqli->query($sql);
				$this->numRows 	= $this->query->num_rows;

				if($this->numRows > 0){
					return true;
				}else{
					return false;
				}
				
			}else{
				
				return false;
			}
		}

		protected function LimitSelect($columnName,$table,$where,$orderByCol,$orderByValue,$limit){

			$columnName = implode(',', $columnName);
			$sql = "SELECT $columnName FROM $table ";
			
			if($where){

				$sql .= " WHERE ";

				$chunk 		= array_chunk($where, 3);

				$whereCols 	= array();

				foreach ($chunk as $key => $value) {

					if (is_string($value[2])) {
						
						$value[2] = "'$value[2]'";
					}else{

						$value[2] = $value[2];
					}
					
					$whereCols[] = implode(' ', $value);
				}

				$sql .= implode(' AND ', $whereCols);
				
			}

			$sql .= " ORDER BY $orderByCol $orderByValue LIMIT $limit";

			
			if($this->mysqli->query($sql)){

				$this->query 	= $this->mysqli->query($sql);
				$this->numRows 	= $this->query->num_rows;

				if($this->numRows > 0){
					return true;
				}else{
					return false;
				}
				
			}else{
				
				return false;
			}
		}

		protected function LikeSelect($columnName,$table,$where,$like){

			$columnName = implode(',', $columnName);
			$sql = "SELECT $columnName FROM $table ";
			
			if($where){

				$sql .= " WHERE ";

				$chunk 		= array_chunk($where, 3);

				$whereCols 	= array();

				foreach ($chunk as $key => $value) {

					if (is_string($value[2])) {
						
						$value[2] = "'$value[2]'";
					}else{

						$value[2] = $value[2];
					}
					
					$whereCols[] = implode(' ', $value);
				}

				$sql .= implode(' AND ', $whereCols);
				
			}

			$sql .= " LIKE '__%$like'";

			echo $sql;

			if($this->mysqli->query($sql)){

				$this->query 	= $this->mysqli->query($sql);
				$this->numRows 	= $this->query->num_rows;

				if($this->numRows > 0){
					return true;
				}else{
					return false;
				}
				
			}else{
				
				return false;
			}
		}
	}
?>