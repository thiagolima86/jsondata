<?php 

/**
 * Jsondata
 * 
 * @package	Jasondata
 * @author	Thiago lima
 * @business Budweb
 * @link	http://www.budweb.com.br
 *
 *
 *
 */



class Jsondata {

	private $path = "./tmp";
	private $get;
	private $where;
	public $filename;
	private $select;
	private $result;
	private $AUTO_INCREMENT;
	private $index;

	 function __construct(){

    }

    private function conditional($data, $fields){

		$wheres = $this->where;

		if($wheres == NULL){

			return $data;
		}else{

			$arg = TRUE;
			
			
		foreach ($data as $row) {

			foreach ($wheres as $where){
				$wfield = @$where["field"];
				$wvalue = @$where["value"];
				$op = @$where["operator"];
				$case = @$where["case"]; //case sensitive
				$logic = @$where["logic"]; //operador logic AND, OR
				$key_field = array_keys($fields, @$wfield);
				$key_field = @$key_field[0];
				
				$cell = $row[$key_field];

				if(!$case){
					$wvalue = ucwords($wvalue);
					$cell = ucwords($cell);						
				}
				
				if($logic == "and"){

					if($op == "=="){$arg &= (@$cell == @$wvalue);}
				elseif($op == ">" ){$arg &= (@$cell >  @$wvalue);}
				elseif($op == ">="){$arg &= (@$cell >= @$wvalue);}
				elseif($op == "<" ){$arg &= (@$cell <  @$wvalue);}
				elseif($op == "<="){$arg &= (@$cell <= @$wvalue);}
				elseif($op == "!="){$arg &= (@$cell != @$wvalue);}

				}elseif($logic == "or"){

					if($op == "=="){$arg |= (@$cell == @$wvalue);}
				elseif($op == ">" ){$arg |= (@$cell >  @$wvalue);}
				elseif($op == ">="){$arg |= (@$cell >= @$wvalue);}
				elseif($op == "<" ){$arg |= (@$cell <  @$wvalue);}
				elseif($op == "<="){$arg |= (@$cell <= @$wvalue);}
				elseif($op == "!="){$arg |= (@$cell != @$wvalue);}

				}elseif($logic == "xor"){

					if($op == "=="){$arg ^= (@$cell == @$wvalue);}
				elseif($op == ">" ){$arg ^= (@$cell >  @$wvalue);}
				elseif($op == ">="){$arg ^= (@$cell >= @$wvalue);}
				elseif($op == "<" ){$arg ^= (@$cell <  @$wvalue);}
				elseif($op == "<="){$arg ^= (@$cell <= @$wvalue);}
				elseif($op == "!="){$arg ^= (@$cell != @$wvalue);}

				}
				
				
			}
			// echo "(".$arg.")";

				if($arg){
				$ret[] = $row;
				}

			$arg = TRUE;
			
			}

		return @$ret;
		}
		
	}
	

	public function get_keyfield($key=FALSE){
		$string = $this->read_file($this->filename);
		$array = $this->decode($string);
		if(!$key){
			return $array->keyfield;
		}else{
			$key = array_keys($array->fields, $array->keyfield);
			return $key[0];
		}
	}
	private function get_index(){
		$string = $this->read_file($this->filename);
		$array = $this->decode($string);
		return $array->index;
	}
	public function get_fields(){
		$string = $this->read_file($this->filename);
		$array = $this->decode($string);
		return $array->fields;
	}
	private function get_key_field($field){
		$fields = $this->get_fields();
		$key = array_keys($fields, $field);
		return $key[0];
		
	}

	private function read_file($filename){
		$fp = fopen ($filename,"r");
		$string = fgets($fp);
		fclose($fp);

		return $string;
	}
	private function write_file($filename, $data){
		$fp = fopen($filename, "w");
		$write = fwrite($fp, $data);
		fclose($fp);
		if ( ! $write){
     		return FALSE;
		}else{
		    return TRUE;
		}
	}

    public function path($path){

		$this->path = $path;
		return $this;

	}

	public function AUTO_INCREMENT($field){

		$this->AUTO_INCREMENT = array(0, $field);
		return $this;

	}

	 public function select($fields){

		$this->select = explode(",", $fields);
		return $this;
	}

	public function where($field, $value=NULL, $case=FALSE, $logic="and"){
		// encontrar operações
		$pos = strpos($field, " ");

		if($pos === FALSE){

			$operator = "==";
		}else{
			$operator = substr($field, $pos+1);
			$field = substr($field, 0, $pos);
		}

		$array = array(	"field" => $field,
						"value" => $value,
						"operator" => $operator,
						"case" => $case,
						"logic" => $logic);
		if($this->where == NULL){
			$this->where = array($array);
		}else{
			array_push($this->where, $array);
		}
		return $this;

	}

	public function where_or($field, $value, $case=FALSE){
		$this->where($field, $value, $case, $logic="or");
	}

	public function where_xor($field, $value, $case=FALSE){
		$this->where($field, $value, $case, $logic="xor");
	}

	private function new_file($name, $data=NULL, $index=NULL){
		$filename = $this->path."/".$name.".json";


		$new_data = array("name" => $name,
			"index" => $index != NULL ? $index : $this->get_index(),
			"keyfield" =>  $this->get_keyfield(),
			"fields" => $this->get_fields(),
			"data" => $data);
		$data = $this->encode($new_data);

		if ( ! $this->write_file($filename, $data)){
     		return FALSE;
		}else{
		    return TRUE;
		}

	}

	public function create($name, $fields){
		$filename = $this->path."/".$name.".json";

		list($index, $keyfield) = $this->AUTO_INCREMENT;
		if($this->AUTO_INCREMENT != NULL){
			$fields = $this->encode($fields);
			$data = '{"name":"'.$name.'", "index" : '.$index.' , "keyfield" : "'.$keyfield.'", "fields" : '.$fields.', "data":[]}';
		
		// return $write;

		if ( ! $this->write_file($filename, $data)){
     		return FALSE;
		}else{
		    return TRUE;
		}
		}else{
			return FALSE;
		}
		

	}



	public function drop($name, $local=NULL){
		$local = $local == NULL ? $this->path : $local;

		$filename = $local."/".$name.".json";
		@unlink($filename);

		if (file_exists($filename)) {
    		return FALSE;
		}else{
		    return TRUE;
		}
	}

	

	public function get($name){
		$filename = $this->path."/".$name.".json";
		$this->filename = $filename;
		$string = $this->read_file($filename);
		$this->get = $string;

		return $this;

	}


	
	public function result(){
		if($this->get != ""):
		$data = $this->result_array();


		$data = $this->decode( $this->encode($data), FALSE);
		$data = (object) $data;
		
		$this->result = $data;
		return $data;
		endif;
	}


	public function result_array(){
		if($this->get != ""):
		$array = $this->decode($this->get, TRUE);
		$fields = $array["fields"];
		$data = $array["data"];

		$data = $this->conditional($data, $fields);//where
		if(!($data === NULL)){
			foreach ($data as $row) {
				foreach ($fields as $key => $field) {
					$col[$field] = @$row[$key] ;
				}
				$ret[] = $col;
				$col = NULL;

			}

			$this->result = @$ret;
			return $this->result;
		}else{
			$this->result = FALSE;
			return $this->result;
		}
		endif;
	}




	public function row(){
		
		$res = $this->result();
		foreach ($res as $value) {
			$row = $value;
		}
		return $row;
	}
	public function row_array(){
		
		$res = $this->result_array();
		foreach ($res as $value) {
			$row = $value;
		}
		return $row;
	}
	


	public function sum($field){
		$this->result_array();
		$q = $this->result;
		$total = 0;
		foreach ($q as $value){
			$total += $value[$field];
		}
		return $total;	
	}
	public function average($field){
		$this->result_array();
		$q = $this->result;
		$parc = count($q);
		$total = 0;
		foreach ($q as $value){
			$total += $value[$field];
		}
		$average = $total / $parc;
		return $average;	
	}

	public function num_rows(){
		$get = $this->result_array();
		if($get==NULL){
			return 0;
		}else{
			return count($get);
		}
	}

	public function insert($name, $datas){
		$get = $this->get($name)->result_array();

		// verifica se os dados a serem inseridos 
		// é um array simples ou multidimensional
		foreach ($datas as $data) {
			if(is_array($data)){
				break;
			}else{
				$datas = array($datas);
				break; 
			}

		}

		
		$fields = $this->get_fields();
		// insere nova linha
		$index = $this->get_index();
		$keyfield = $this->get_keyfield(TRUE);
		$keyfield_name = $this->get_keyfield();
		foreach ($datas as $row) {
			$new_row[$keyfield] = $index;
			
			foreach ($fields as $key => $value) {
				if($keyfield_name == $value){ // verifica se é o id
					$row[$value] = $index;
				}
				if(@$row[$value] === NULL){ // verifica se existe algum field não definido
					$row[$value] = NULL;
				}

				$new_row[$key] =  $row[$value];
			}
			ksort($new_row); //organiza as colunas na ordem certa
			$get[] = $new_row; //insere nova linha
			$new_row = NULL;
			$index++;			

		}
		ksort($get); //organiza as linha na ordem certa


		
		// Retira o a chave do array
		foreach ($get as $row) {
			foreach ($row as $value) {
				$new_row[] = $value;
			}
			$new_array[] = $new_row;
			$new_row = NULL;
		}
		$this->new_file($name, $new_array, $index);		
	}

	public function update($name, $data){
		$get = $this->get($name)->result_array();
		if($get != NULL){
		// pega os ids
		$keyfield = $this->get_keyfield();
		foreach ($get as $array) {
			$ids[] = $array[$keyfield];
		}

		// Pega todas as linhas
		$this->where = NULL;
		$getAll = $this->get($name)->result_array();

		$array = NULL;		
		foreach ($getAll as $row) {
			foreach ($ids as $id) {
				if($row[$keyfield] == $id){
					foreach ($data as $key => $value) {
						$row[$key] = $value;
					}
				}				
			}
			$array[] = $row;
			
		}
		// Retira o a chave do array
		$row = NULL;
		foreach ($array as $row) {
			foreach ($row as $value) {
				$new_row[] = $value;
			}
			$new_array[] = $new_row;
			$new_row = NULL;
		}
		
		// echo $this->encode($new_array);
		$this->new_file($name, $new_array);

		}else{
			return FALSE;
		}
	}


	public function delete($name){
		$get = $this->get($name)->result_array();
		if($get != NULL){
		// pega os ids
		$keyfield = $this->get_keyfield();
			foreach ($get as $array) {
				$ids[] = $array[$keyfield];
			}
		

		// Pega todas as linhas
		$this->where = NULL;
		$getAll = $this->get($name)->result_array();

		$array = NULL;	
		$arg = NULL;	
		foreach ($getAll as $row) {
			foreach ($ids as $id) {
				$arg |= ($row[$keyfield] == $id);				
			}
			if(!$arg){
				$array[] = $row;
			}
			$arg = NULL;		
			
		}

		// Retira o a chave do array
		$row = NULL;
		foreach ($array as $row) {
			foreach ($row as $value) {
				$new_row[] = $value;
			}
			$new_array[] = $new_row;
			$new_row = NULL;
		}
		// print_r($new_array);
		$this->new_file($name, $new_array);
		}else{
			return FALSE;
		}
	}


	
	public function encode($array){
		
		return	json_encode($array);
	
	}
	public function decode($json, $array = FALSE){
		
		return json_decode($json, $array);

	}
}