<?php
/*
  Auteur      : Soares Flavio, De Castilho E Sousa Rodrigo
  Description : Requêtes SQL (PDO)

  Date        : 09.2021
  Version     : 1.0
*/

require_once "database.php";

// Récuperer les donnees contenu dans la base de donnée
function getEnigmeCode(){
  try{
    $today = "2021-11-23"; //date("Y-m-d");

    $days = getDate();

    foreach($days as $value){
      foreach($value as $day){
        if($day == date("Y-m-d")){
          $today = date("Y-m-d");
        }
        else{
          $today = "0000-00-00";
        }
      }
    }
    $query = getConnexion()->prepare("
      SELECT `solution`.`en1`, `solution`.`en2`, `solution`.`en3` 
      FROM `x22f6_escape21`.`solution` 
      WHERE `solution`.`jour` = ?
    ");
    $query->execute([$today]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
  }
}

function getDate(){
  try{
    $query = getConnexion()->prepare("
      SELECT `solution`.`jour`
      FROM `x22f6_escape21`.`solution`
    ");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

  }catch(PDOException $e){
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
  }
}
