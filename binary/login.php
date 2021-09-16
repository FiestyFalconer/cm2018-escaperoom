<?php
function affichageButtons()
{
    $chaine = '<div class="btnContainer">';

    for ($i = 0; $i < 10; $i++) {
        $chaine .= "<input value=\"$i\" type=\"Button\" onclick=\"\" id=\"$i\" class=\"btn btn-lg btn-primary\" />";
    }
    $chaine .= '
            <input value="A" type="Button" onclick="" id="A" class="btn btn-lg btn-primary" />
            <input value="B" type="Button" onclick="" id="B" class="btn btn-lg btn-primary" />
            <input value="C" type="Button" onclick="" id="C" class="btn btn-lg btn-primary" />
            <input value="D" type="Button" onclick="" id="D" class="btn btn-lg btn-primary" />
            <input value="E" type="Button" onclick="" id="E" class="btn btn-lg btn-primary" />
            <input value="F" type="Button" onclick="" id="F" class="btn btn-lg btn-primary" />
    ';
    return $chaine;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <h1>LOGIN</h1>
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