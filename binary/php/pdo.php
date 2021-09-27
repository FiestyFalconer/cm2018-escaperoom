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

    $query = getConnexion()->prepare("
      SELECT `solution`.`en1`, `solution`.`en2`, `solution`.`en3` 
      FROM `escapegame_2021`.`solution` 
      WHERE `solution`.`jour` = ?
    ");
    $query->execute([$today]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
  }
}