<?php

include "../jsondata.php";
$jsondata = new Jsondata();
$jsondata->path("../tmp");

$fields = array("id", "fruta", "cor", "sabor", "preco");

$jsondata->AUTO_INCREMENT("id");
echo $jsondata->create("Demands", $fields);