<?php
/*
 * Auteur  : Troller Fabian, Juling Guntram, Lopes Miguel
 * Date    : 2018.11.06
 * Description : Code PHP cité des metiers
 */

const ADDR = "http://192.168.123.242/webdispatcher";// ip du serveur
const DEFAULT_VALUE = ["A", "9"];// solutions par defaut

// recupere les solutions du serveur sous forme de JSON
function getSolutionJSON()
{
    $ping = curl_init(ADDR . "/soluce.php");// prepare l'adresse a atteidre
    curl_setopt($ping, CURLOPT_RETURNTRANSFER, true);
    if (curl_exec($ping) == true)// verifie si l'adresse est atteignable
    {
        $json = file_get_contents(ADDR . "/soluce.php");
        $obj = json_decode($json);

        if ($obj != null)
            $Table = [$obj->soluce1, $obj->soluce2];// ajoute les donnees de soluce1 et soluce 2 dans la table qui est a retourner
        else
            $Table = DEFAULT_VALUE;
    } else {
        $Table = DEFAULT_VALUE;
    }
    return $Table;// retourne les solutions sous forme de table
}
?>
