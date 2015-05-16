<?php

include "../jsondata.php";
$jsondata = new Jsondata();
$jsondata->path("../tmp");


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

	$res = $jsondata->insert("Demands", $data);
	echo $res;
