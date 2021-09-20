<?php

require_once "./php/pdo.php";

$tableauCode = getEnigmeCode(); // récupère les 3 énigmes de la db

$en1 = $tableauCode[0]['en1']; // récupère l' énigmes 1 de la db
$en2 = $tableauCode[0]['en2']; // récupère l' énigmes 2 de la db

function affichageButtons()
{
    $chaine = '<div class="btnContainer">';

    for ($i = 0; $i <= 15; $i++)
    {
        $hexa = strtoupper(dechex($i));
        $chaine .= "<input value=\"$hexa\" type=\"Button\" onclick=\"btnClick('$hexa')\" id=\"$hexa\" class=\"btn btn-primary\" />\n";
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
        <?= affichageButtons() ?>
    </div>
</body>
</html>