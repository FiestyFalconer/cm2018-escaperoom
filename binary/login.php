<?php
/*
    Auteur      : Soares Flavio, De Castilho E Sousa Rodrigo
    Description : Connexion à la base de données

    Date        : 2021.09.15
    Version     : 1.0
*/

require_once "./php/pdo.php";

$tableauCode = getEnigmeCode(); // récupère les codes 3 énigmes de la db

$en1 = $tableauCode[0]['en1']; // récupère le code de l'énigmes 1 de la db
$en2 = $tableauCode[0]['en2']; // récupère le code de l' énigmes 2 de la db

//afficher les boutons
function showButtons()
{
    $chaine = '<div class="btnContainer">';

    for ($i = 0; $i <= 15; $i++)
    {
        $hexa = strtoupper(dechex($i)); // Converti les nombres décimal en hexadécimal et les met en majuscules (lettres)
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
        var sol1 = <?=$en1?>; // Enigme 1 
        var sol2 = "<?=$en2?>"; // Enigme 2
    </script>
</head>

<body>
    <h1 class="text-primary">Saisissez le code secret</h1>
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