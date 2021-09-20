<?php
function affichageButtons()
{
    $chaine = '<div class="btnContainer">';

    for ($i = 0; $i < 10; $i++) {
        $chaine .= "<input value=\"$i\" type=\"Button\" onclick=\"btnClick($i)\" id=\"$i\" class=\"btn btn-lg btn-primary\" />";
    }
    $chaine .= '
            <input value="A" type="Button" onclick="btnClick("A")" id="A" class="btn btn-lg btn-primary"/>
            <input value="B" type="Button" onclick="btnClick("B")" id="B" class="btn btn-lg btn-primary"/>
            <input value="C" type="Button" onclick="btnClick("C")" id="C" class="btn btn-lg btn-primary"/>
            <input value="D" type="Button" onclick="btnClick("D")" id="D" class="btn btn-lg btn-primary"/>
            <input value="E" type="Button" onclick="btnClick("E")" id="E" class="btn btn-lg btn-primary"/>
            <input value="F" type="Button" onclick="btnClick("F")" id="F" class="btn btn-lg btn-primary"/>
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

    <script src="js/binary.js"></script>
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