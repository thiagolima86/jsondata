<?php

include "jsondata.php";
$jsondata = new Jsondata();

$name = $_POST["pathname"];
$path = $_POST["path"];

if(!file_exists ($path)){
	mkdir($path, 0777);
}
$jsondata->path("./");
$jsondata->insert("paths", array("path_name" => $name, "path" => $path));

header('location: index.php');    