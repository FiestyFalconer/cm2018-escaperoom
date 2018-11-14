<?php
/*
  Author      : Guillaume Pin
  Date        : 25.09.2018
  Description : data management
*/
require("pdo.php");
giveUp();
$result = "game over";
$resultJSON = json_encode($result);

print_r($resultJSON);
?>
