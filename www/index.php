<?php

require_once "./model/pdo.php";

$tableauCode = getEnigmeCode(); // Récupère les codes 3 énigmes de la base de donnée

$en1 = $tableauCode[0]['en1']; // Récupère le code de l'énigmes 1 dans la base de donnée
$en2 = $tableauCode[0]['en2']; // Récupère le code de l' énigmes 2 dans la base de donnée

require_once "./view/index.php";