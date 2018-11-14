<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
/*
  Author      : Guillaume Pin
  Date        : 25.09.2018
  Description : data management
*/
require("pdo.php");
validEndStep();
$result = "game finished";
$resultJSON = json_encode($result);

print_r($resultJSON);
?>
