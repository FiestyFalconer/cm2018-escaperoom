<?php
/*
    Auteur      : Soares Flavio, De Castilho E Sousa Rodrigo
    Description : Page de login

    Date        : 09.2021
    Version     : 1.0
*/

require_once "./php/pdo.php";
require_once "./php/tools.php";

$tableauCode = getEnigmeCode(); // Récupère les codes 3 énigmes de la base de donnée

$en1 = $tableauCode[0]['en1']; // Récupère le code de l'énigmes 1 dans la base de donnée
$en2 = $tableauCode[0]['en2']; // Récupère le code de l' énigmes 2 dans la base de donnée

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <img src="./img/logo.png" id="logo" alt="logo">
    <h1 class="text-primary">Saisissez le code secret</h1>
    <p class="text-primary" id="nbTime" hidden></p>
    <p class="text-primary">
        <span id="valueEn1">_</span>
        &nbsp;
        <span id="valueEn2">_</span>
    </p>
    <div>
        <?= showButtons() ?>
    </div>
</body>

<script src="js/login.js"></script>
<script>
    let sol1 = "<?=$en1?>"; // Enigme 1 
    let sol2 = "<?=$en2?>"; // Enigme 2
</script>
</html>