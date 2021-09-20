<?php
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
</head>

<body>
    <h1>Saisissez le code secret</h1>
    <p>
        <span id="valueEn1">_</span>
        &nbsp;
        <span id="valueEn2">_</span>
    </p>
    <div>
        <?= affichageButtons() ?>
    </div>
</body>
</html>