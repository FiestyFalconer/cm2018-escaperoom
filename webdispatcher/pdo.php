<?php
/*
  Author      : Guillaume Pin
  Date        : 30.10.2018
  Description : data management
*/

// Variable pour la connexion à la base de données
DEFINE('DB_HOST', "127.0.0.1");
DEFINE('DB_NAME', "escapegame");
DEFINE('DB_USER', "root");
DEFINE('DB_PASS', "");

// Méthode qui permet de créer une variable static pour la connexion à la base de données
function getConnexion(){
  static $dbb = null;
  try{
    if($dbb === null)
    {
      $connectionString="mysql:host=".DB_HOST.";dbname=".DB_NAME.'';
      $dbb = new PDO($connectionString, DB_USER, DB_PASS);
      $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  }
  catch(PDOException $e)
  {
    die("Erreur : ".$e->getMEssage());
  }
  return $dbb;
}

// Méthode qui permet de savoir le nombre de partie différente
function getNbGame(){
  $connexion = getConnexion();
  $requete = $connexion->prepare("SELECT count(idgame) FROM gameset");
  $requete->execute();
  $nbGame = $requete->fetch(PDO::FETCH_ASSOC);
  return $nbGame['count(idgame)'];
}

// Méthode qui permet de démarrer une nouvelle partie
function startNewGame(){
  $rnd = rand(1, getNbGame());
  $connexion = getConnexion();
  try{
    $connexion->beginTransaction();
    $requete = $connexion->prepare('INSERT INTO `gameinprogress` (`timestart`, `timefirststep`, `timesecondestep`, `timeend`, `idgame`) VALUES (now(), NULL, NULL, NULL,  :id);');
    $requete->bindParam(':id', $rnd, PDO::PARAM_INT);
    $requete->execute();
    $connexion->commit();
  }
  catch (Exception $e)
  {
    $connexion->rollback();
    echo "Error -> ".$e;
  }
}

// Méthode qui permet de trouver la partie qui est actuellement en cours
// Pour cela on regarde la dernière partie commencé dans la base
function findgameinprogress(){
  $connexion = getConnexion();
  $requete = $connexion->prepare("SELECT idgameinprogress FROM gameinprogress ORDER BY idgameinprogress DESC LIMIT 1");
  $requete->execute();
  $idgameinprogress = $requete->fetch(PDO::FETCH_ASSOC);
  return $idgameinprogress['idgameinprogress'];
}

// Méthode qui permet de valider la première étape
function validFirstStep(){
  $idgameinprogress = findgameinprogress();
  $connexion = getConnexion();
  try{
    $connexion->beginTransaction();
    $requete = $connexion->prepare('UPDATE `gameinprogress` SET `timefirststep` = now() WHERE `idgameinprogress` = :id');
    $requete->bindParam(':id', $idgameinprogress, PDO::PARAM_INT);
    $requete->execute();
    $connexion->commit();
  }
  catch (Exception $e)
  {
    $connexion->rollback();
    echo "Error -> ".$e;
  }
}

// Méthode qui permet de valider la deuxième étape
function validSecondeStep(){
  $idgameinprogress = findgameinprogress();
  $connexion = getConnexion();
  try{
    $connexion->beginTransaction();
    $requete = $connexion->prepare('UPDATE `gameinprogress` SET `timesecondestep` = now() WHERE `idgameinprogress` = :id');
    $requete->bindParam(':id', $idgameinprogress, PDO::PARAM_INT);
    $requete->execute();
    $connexion->commit();
  }
  catch (Exception $e)
  {
    $connexion->rollback();
    echo "Error -> ".$e;
  }
}

// Méthode qui permet de valider la dernière étape
function validEndStep(){
  $idgameinprogress = findgameinprogress();
  $connexion = getConnexion();
  try{
    $connexion->beginTransaction();
    $requete = $connexion->prepare('UPDATE `gameinprogress` SET `timeend` = now() WHERE `idgameinprogress` = :id');
    $requete->bindParam(':id', $idgameinprogress, PDO::PARAM_INT);
    $requete->execute();
    $connexion->commit();
  }
  catch (Exception $e)
  {
    $connexion->rollback();
    echo "Error -> ".$e;
  }
  checkTime();
}

// Méthode qui permet de récuperer les informations de la partie en cours
function getInfogameinprogress(){
  $connexion = getConnexion();
  $idgameinprogress= findgameinprogress();
    $requete = $connexion->prepare('SELECT * FROM gameinprogress WHERE idgameinprogress	 = :id');
  $requete->bindParam(':id', $idgameinprogress, PDO::PARAM_INT);
  $requete->execute();
  $infogameinprogress = $requete->fetchAll(PDO::FETCH_ASSOC);
  return $infogameinprogress;
}

// Méthode qui permet de déclarer une défaite
// Pour cela il y a dans la table gameinprogress la valeur de success à 0
function giveUp(){
  $connexion = getConnexion();
  $idgameinprogress= findgameinprogress();
  try{
    $connexion->beginTransaction();
    $requete = $connexion->prepare('UPDATE `gameinprogress` SET `success` = 0 WHERE `idgameinprogress` = :id');
    $requete->bindParam(':id', $idgameinprogress, PDO::PARAM_INT);
    $requete->execute();
    $connexion->commit();
  }
  catch (Exception $e)
  {
    $connexion->rollback();
    echo "Error -> ".$e;
  }
}

// Méthode qui permet de vérifier la différence de temps entre le début et la fin de l'escape game
function checkTime(){
  $infogameinprogress = getInfogameinprogress();
  foreach (getInfogameinprogress() as $key => $donnees)
  {
      $timestart = $donnees['timestart'];
      $timeend = $donnees['timeend'];
  }
  $timestart = new DateTime($timestart);
  $timeend = new DateTime($timeend);
  $diff = 15 * 60;
  if($timeend->getTimeStamp() - $timestart->getTimeStamp() > $diff)
    giveUp();
}

// Méthode qui permet de recuperer les informations du template de partie
function getInfoGameSet(){
  $connexion = getConnexion();
  $idgameinprogress = findgameinprogress();
  foreach (getInfogameinprogress() as $key => $donnees)
  {
      $idgame = $donnees['idgame'];
  }
  $requete = $connexion->prepare('SELECT * FROM gameset WHERE idgame = :id');
  $requete->bindParam(':id', $idgame, PDO::PARAM_INT);
  $requete->execute();
  $infogameinprogress = $requete->fetchAll(PDO::FETCH_ASSOC);
  return $infogameinprogress;
}

// Méthode qui permet de récupérer les noms des câbles
function getNameCable(){
  $connexion = getConnexion();
  $tableCable = array();
  $result = array();
  foreach (getInfoGameSet() as $key => $value) {
    $tableCable[] = $value['cableselect1'];
    $tableCable[] = $value['cableselect2'];
    $tableCable[] = $value['cableselect3'];
  }
  foreach ($tableCable as $value) {
    $requete = $connexion->prepare('SELECT namecable FROM cables WHERE idCable = :idCable');
    $requete->bindParam(':idCable', $value, PDO::PARAM_INT);
    $requete->execute();
    $result[]  = $requete->fetch(PDO::FETCH_ASSOC);
  }
  return $result;
}

// Méthode qui retourne l'état de la vidéo
function getInfoVideo(){
  $connexion = getConnexion();
  $idgameinprogress = findgameinprogress();
  $requete = $connexion->prepare("SELECT isvideoplayed FROM gameinprogress WHERE idgameinprogress = :id");
  $requete->bindParam(':id', $idgameinprogress, PDO::PARAM_INT);
  $requete->execute();
  $result = $requete->fetch(PDO::FETCH_ASSOC);
  return $result['isvideoplayed'];
}

// Méthode qui change l'état de la vidéo dans la base de données
function switchVideo($isVideoPlayed){
  $idgameinprogress = findgameinprogress();
  $connexion = getConnexion();
  try{
    $connexion->beginTransaction();
    $requete = $connexion->prepare('UPDATE `gameinprogress` SET `isvideoplayed` = :isVideoPlayed WHERE `idgameinprogress` = :id');
    $requete->bindParam(':isVideoPlayed', $isVideoPlayed, PDO::PARAM_INT);
    $requete->bindParam(':id', $idgameinprogress, PDO::PARAM_INT);
    $error = $requete->execute();
    $connexion->commit();
  }
  catch (Exception $e)
  {
    $connexion->rollback();
    echo "Error -> ".$e;
  }
  return json_encode([
    'status' => $error,
    'isVideoPlayed' => $isVideoPlayed,
  ]);
}
?>
