<?php
/*
    Auteur      : Soares Flavio, De Castilho E Sousa Rodrigo
    Description : Connexion à la base de données

    Date        : 09.2021
    Version     : 1.0
*/

require_once("config.php");

// Permet d'accéder à la base de données
function  getConnexion(){
    static $myDb = null;
    if($myDb === null){
        try{
            $myDb = new PDO(
            "mysql:host=". DB_HOST. ";dbname=". DB_NAME. ";charset=utf8",
            DB_USER, DB_PASSWORD
            );
            $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch(PDOException $e){
            die("Erreur :" .$e->getMessage());
        }
    }
    return $myDb;
}