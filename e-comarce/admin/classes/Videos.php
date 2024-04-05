<?php
	
	require_once ('Database.php');

	class Videos extends Database{

		public $query, $error;

		public function addvideo($title, $title_b, $thumb_new_name, $video_new_name){

			if($this->Insert('video',['video_title','video_title_b','video_thumbnail','video'],[$title, $title_b, $thumb_new_name, $video_new_name])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function getvideo($where = null){

			if($this->Select(['*'], 'video', $where)){

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