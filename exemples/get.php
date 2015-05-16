<?php

include "../jsondata.php";
$jsondata = new Jsondata();
$jsondata->path("../tmp");

// $jsondata->where("id", 1);
$res = $jsondata->get("Demands");
print_r($res->result());