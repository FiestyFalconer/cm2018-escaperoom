<?php
/*
    Auteur      : Soares Flavio, De Castilho E Sousa Rodrigo
    Description : Page de login

    Date        : 09.2021
    Version     : 1.0
*/

require_once "./php/pdo.php";

$tableauCode = getEnigmeCode(); // Récupère les codes 3 énigmes de la base de donnée

$en1 = $tableauCode[0]['en1']; // Récupère le code de l'énigmes 1 dans la base de donnée
$en2 = $tableauCode[0]['en2']; // Récupère le code de l' énigmes 2 dans la base de donnée

// Afficher les bouttons
function showButtons()
{
    $chaine = '<div class="btnContainer">';

    for ($i = 0; $i <= 15; $i++)
    {
        $hexa = strtoupper(dechex($i)); // Converti les nombres décimal en hexadécimal, met en majuscule (lettre alphabet)
        $chaine .= "<input value=\"$hexa\" type=\"Button\" onclick=\"btnClick('$hexa')\" id=\"$hexa\" class=\"btn btn-primary\" />";
    }
    return $chaine;
}
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

    <script src="js/login.js"></script>
    <script>
        let sol1 = "<?=$en1?>"; // Enigme 1 
        let sol2 = "<?=$en2?>"; // Enigme 2
    </script>
</head>

<body>
    <h1 class="text-primary">Saisissez le code secret</h1>
    <p id="nbTime" hidden></p>
    <p class="text-primary">
        <span id="valueEn1">_</span>
        &nbsp;
        <span id="valueEn2">_</span>
    </p>
    <div>
        <?= showButtons() ?>
    </div>
</body>
</html>