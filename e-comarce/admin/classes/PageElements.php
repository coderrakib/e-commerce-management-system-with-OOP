<?php
	
	require_once ('Database.php');

	class PageElements extends Database{

		public $query, $error;

		public function addelements($title, $b_title, $desc, $b_desc, $h_banner_new_name, $f_banner_1_new_name, $f_banner_2_new_name, $header_text, $header_text_b, $footer_text, $footer_text_b, $feature_image_new_name, $page_name ){

			if($this->Insert('ui_elements',['banner_title','banner_title_bangla','banner_desc','banner_desc_bangla','header_banner','footer_banner_1','footer_banner_2', 'header_text', 'header_text_b', 'footer_text', 'footer_text_b', 'image', 'page_id'],[$title, $b_title, $desc, $b_desc, $h_banner_new_name, $f_banner_1_new_name, $f_banner_2_new_name, $header_text, $header_text_b, $footer_text, $footer_text_b, $feature_image_new_name, $page_name])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function getelements($where = null){

			if($this->Select(['*'], 'ui_elements', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function updateelements($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function deleteelements($table, $where){

			if($this->Delete($table,['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}
	}
?>