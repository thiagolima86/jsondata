<?php

include "jsondata.php";
$jsondata = new Jsondata();


$jsondata->path("./");
$jsondata->where("id", $_GET["id"]);
$jsondata->delete("paths");

header('location: index.php');    