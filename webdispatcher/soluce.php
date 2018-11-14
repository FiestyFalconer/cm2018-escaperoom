<?php
error_reporting(E_ERROR | E_PARSE);
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
/*
Author      : Guillaume Pin
Date        : 25.09.2018
Description : data management
*/

require("pdo.php");
include('result.php');
$getInfoGameInProgress =  getInfoGameInProgress()[0];
$getInfoGameSet =  getInfoGameSet()[0];
$idGame = $getInfoGameInProgress['idgameinprogress'];
$start = $getInfoGameInProgress['timestart'];
$step1 = $getInfoGameInProgress['timefirststep'];
$step2 = $getInfoGameInProgress['timesecondestep'];
$end = $getInfoGameInProgress['timeend'];
$success = $getInfoGameInProgress['success'];
$nameCable = array();
foreach (getNameCable() as $key => $value)
$nameCable[] = $value['namecable'];
$cableSelect[] = $getInfoGameSet['cableselect1'];
$cableSelect[] = $getInfoGameSet['cableselect2'];
$cableSelect[] = $getInfoGameSet['cableselect3'];
$indice[] = $getInfoGameSet['indice1'];
$indice[] = $getInfoGameSet['indice2'];
$binary = $getInfoGameSet['binary'];

$master = ping('192.168.123.242', 80, 1);
$sensehat = ping('192.168.123.241', 80, 1);
$piface = ping('192.168.123.240', 80, 1);
$laby = ping('192.168.123.241', 80, 1);
// $master = ping('127.0.0.1', 80, 1);
// $sensehat = ping('127.0.0.1', 80, 1);
// $piface = ping('127.0.0.1', 80, 1);
// $laby = ping('127.0.0.1', 80, 1);

$result = new result($idGame,
$cableSelect[0],
$nameCable[0],
$cableSelect[1],
$nameCable[1],
$cableSelect[2],
$nameCable[2],
$indice[0],
$indice[1],
$binary,
$start,
$step1,
$step2,
$end,
$success,
$master,
$sensehat,
$piface,
$laby);

$resultJSON = json_encode($result);

print_r($resultJSON);

function ping($ip, $port, $timeout){
  $fp = fsockopen($ip, $port, $errno, $errstr, $timeout);
  if (!$fp) {
    return 0;
  } else {
    return 1;
  }
}
?>
