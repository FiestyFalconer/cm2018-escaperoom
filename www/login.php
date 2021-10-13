<?php
/*
    Auteur      : Soares Flavio, De Castilho E Sousa Rodrigo
    Description : Page de login

    Date        : 09.2021
    Version     : 1.0
*/

require_once "./model/pdo.php";

$tableauCode = getEnigmeCode(); // Récupère les codes 3 énigmes de la base de donnée

$en1 = $tableauCode[0]['en1']; // Récupère le code de l'énigmes 1 dans la base de donnée
$en2 = $tableauCode[0]['en2']; // Récupère le code de l' énigmes 2 dans la base de donnée

require_once "./view/login.php";