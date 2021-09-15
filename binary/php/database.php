<?php
/*
    Auteur      : Soares Flavio, De Castilho E Sousa Rodrigo
    Description : Connexion à la base de données

    Date        : 2021.09.15
    Version     : 1.0
*/

require_once("config.php");

/*
 * Permet d'accéder à la base de données
 * retourne null si ne marche pas
 */
function db()
{
    static $myDb = null;
    if ($myDb === null) {
        try {
            $myDb = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                DB_USER,
                DB_PASSWORD
            );
            $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            return null;
        }
    }
    return $myDb;
}
