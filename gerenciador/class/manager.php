<?php

include "jsondata.php";

class Manager extends Jsondata{


	public function get_paths(){

		$this->path("./");
		$res = $this->get("paths");

		return $res->result();
	}

	public function get_one_path($path){

		$paths = $this->get_paths();
		foreach ($paths as $row) {
			if($row->id == $path){
				$dir = $row->path;
				break;
			}
		}
		return $dir;
	}


	public function scan_folder($path){
		$dir = $this->get_one_path($path);
		
		$files = scandir($dir);
		foreach ($files as $key => $value) {
			$filename = pathinfo($value);
			$extension = @$filename['extension'];
			if($key != 0 AND $key != 1 AND  @$extension == "json"){
				$file_arr[] = $value;
			}
		}
		$files = $file_arr;
		// unset($files[0]);unset($files[1]);
		return $files;
	}

	public function actions(){

				// create
		if(@$_GET["action"] == "create"){
			$name = @$_POST["name"];
			$dir = @$_POST["dir"];
			$fields = @$_POST["fields"];
			$key = @$_POST["key"];
			if(!file_exists ($dir)){
				return "no_exists";
				exit();
			}
			if(!is_writable($dir)){
				return "no_writable";
				exit();
			}
			if($key == NULL or $dir == NULL){
				return "no_field";
				exit();
			}




			if(file_exists ($dir) AND is_writable($dir)){
				$this->path($dir);
				$this->AUTO_INCREMENT($key);
				return $this->create($name, $fields);
			}else{
				return FALSE;
			}

		}
		// end create
			// Insert
		if(@$_GET["action"] == "insert"){
			$data = $_POST;
			unset($data["save"]);

			$this->path($this->get_one_path($_GET["path"]));
			return $this->insert($_GET["file"], $data);

		}
		// end insert

			// Insert
		if(@$_GET["action"] == "update"){
			$where = explode(",", $_GET["where"]);

			$this->path($this->get_one_path($_GET["path"]));
			$this->where($where[0], $where[1]);
			$this->update($_GET["file"], $_POST);

			return 1;

		}
		// end update

		// Delete
		if(@$_GET["action"] == "delete"){

			$where = explode(",", $_GET["where"]);
			$this->path($this->get_one_path($_GET["path"]));
			$this->where($where[0], $where[1]);
			$this->delete($_GET["file"]);


		}
		// end delete
	}


}