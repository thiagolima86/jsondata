<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jsonteste extends CI_Controller {

	public function __construct(){
		parent::__construct();


		$this->load->library('jsondata');
		
		
	}
	

public function index(){

	$fields = array("id", "fruta", "cor", "sabor", "preco");

	$this->jsondata->AUTO_INCREMENT("id");
	$this->jsondata->create("Demands", $fields);

}
public function drop(){

	$res = $this->jsondata->drop("Demands");


	if($res){
		echo "ok";
	}else{
		echo "vixe";
	}

}

public function get(){

	// $this->jsondata->select("fruta, cor");

	// $this->jsondata->where("sabor !=", "azedo");
	// $this->jsondata->where("sabor", "azedo");
	$this->jsondata->where("id", 17);
	$res = $this->jsondata->get("Demands");
	echo $res->num_rows();
// print_r($res->result());
	// $soma = $res->sum("preco");
	// $media = $res->average("preco");
	// $n_rows = $res->num_rows();
	// echo $soma. " - ".$media." / ".$n_rows;

	

}
public function sum(){

	$res = $this->jsondata->get("Demands");
	// $res = $this->jsondata->result();
	$soma = $res->sum("preco");
	echo "Soma " . $soma."<br>";

	$res = $this->jsondata->get("Demands");
	$average = $res->average("preco");
	echo "Média " . $average;

	// print_r($res);

}
public function result(){

	$this->jsondata->path("./tmp");
	$res = $this->jsondata->get("demand")->result();

	print_r($res);

}

public function num_rows(){

	// $this->jsondata->path("./tmp");
	$res = $this->jsondata->get("Demands");
	$num = $res->num_rows();

	echo $num;
	// print_r($res->result());

}

public function insert(){

	$data = array(array(
					"fruta" => "Limão",
					"cor" => "Verde",
					"sabor" => "Azedo"
					),
	array(
					"fruta" => "Azeitona",
					"cor" => "Oliva",
					"preco" => 2.45)
	);

	// $data = array( "fruta" => "Abacate",
	// 				"cor" => "Verde",
	// 				"preco" => 5.6,
	// 				"sabor" => "Doce");


	$res = $this->jsondata->insert("Demands", $data);
	echo $res;

}

public function update(){


	$data = array( "fruta" => "Tamarino",
					"cor" => "Marrom");

	$this->jsondata->where("sabor", "Azedo");
	// $this->jsondata->where("id", 3);
	$res = $this->jsondata->update("Demands", $data);
	echo $res;

}

public function delete(){

	// $this->jsondata->where("id", 1);
	$this->jsondata->where("sabor", "Azedo");
	$res = $this->jsondata->delete("Demands");

	echo $res;
	
}

}