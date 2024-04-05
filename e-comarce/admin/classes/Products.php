<?php
	
	require_once ('Database.php');

	class Products extends Database{

		public $query, $error;

		public function addproduct($product_id,$parent_name,$name,$name_b,$p_category,$price,$price_b,$dis_check,$dis_price,$dis_price_b,$weight,$weight_b,$weight_type,$image_new_name,$description,$description_b,$short_description,$short_description_b,$info,$info_b){

			if($this->Insert('products',['product_id','parent_name','product_name','product_name_b','product_category','product_price','product_price_b','dis_check','discount_price','discount_price_b','product_weight','product_weight_b','product_weight_type','product_image','product_dec','product_dec_b','product_short_dec','product_short_dec_b','product_info','product_info_b'],[$product_id,$parent_name,$name,$name_b,$p_category,$price,$price_b,$dis_check,$dis_price,$dis_price_b,$weight,$weight_b,$weight_type,$image_new_name,$description,$description_b,$short_description,$short_description_b,$info,$info_b])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function getproduct($where = null){

			if($this->Select(['*'], 'products', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function updateproduct($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function deleteproduct($table, $where){

			if($this->Delete($table,['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}
	}
?>