<?php
/*
    Auteurs          : Lopes Miguel, Troller Fabian, Juling Guntram
    Date             : 2018.11.06
    Description      : Enigme 3 escape game

    Modifications    :
    Auteurs          : Soares Flavio, De Castilho E Sousa Rodrigo
    Date             : 09.2021
*/

require_once "./php/pdo.php";

$tableauCode = getEnigmeCode(); // récupère les 3 énigmes de la db

$en1 = $tableauCode[0]['en1']; // récupère l' énigmes 1 de la db
$en2 = $tableauCode[0]['en2']; // récupère l' énigmes 2 de la db

?>
<!DOCTYPE html>
<html>
<head>

    <title>Cité des métiers | Binary</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        let sol1 = "<?=$en1?>"; // Enigme 1 
        let sol2 = "<?=$en2?>"; // Enigme 2
    </script>

    <script src="js/binary.js"></script>
</head>

<body class="text-center" style="font-size: 2.5em;">
<main id="endgame" hidden><div class="winImage"></div></main>
<main id="game" class="container-fluid">
    <section class="col-xs-6">
        <div class="col-xs-6">
            <div class="row">
                <span class="solutions" id="sol1">?</span>
            </div>
            <div class="row">
                <p style="font-size:18px;">
                    &nbsp;2<sup>3</sup>&nbsp;
                    &nbsp;2<sup>2</sup>&nbsp;
                    &nbsp;2<sup>1</sup>&nbsp;
                    &nbsp;2<sup>0</sup>&nbsp;
                </p>
            </div>
            <div class="row binary">
                <hr>
                <?php
                for ($i = 0; $i < 4; $i++)
                    echo '&nbsp;<span id="value' . $i . '">_</span>&nbsp;';
                ?>
                <hr>
            </div>
            <div class="row hexadecimal">
                <span id="hex0">0</span>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="row">
                <span class="solutions" id="sol2">?</span>
            </div>
            <div class="row">
                <p style="font-size:18px;">
                    &nbsp;2<sup>3</sup>&nbsp;
                    &nbsp;2<sup>2</sup>&nbsp;
                    &nbsp;2<sup>1</sup>&nbsp;
                    &nbsp;2<sup>0</sup>&nbsp;
                </p>
            </div>
            <div class="row binary">
                <hr>
                <?php
                for ($i = 4; $i < 8; $i++)
                    echo '&nbsp;<span id="value' . $i . '">_</span>&nbsp;';
                ?>
                <hr>
            </div>
            <div class="row hexadecimal">
                <span id="hex1">0</span>
            </div>
        </div>
    </section>
    <section class="col-xs-6">
        <div class="row">
            <br>
        </div>
        <br>
        <div class="row">
            <span id="message">Veuillez entrer le code</span>
        </div>
        <br>
        <div class="row">
            <form method="post" action="">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="row">
                        <div class="col-xs-6">
                            <input disabled value="0" type="Button" style="height: 100px" onclick="ListSetter(0)" id="b0" class="btn btn-lg btn-block btn-primary"/>
                        </div>
                        <div class="col-xs-6">
                            <input disabled value="1" type="Button" style="height: 100px" onclick="ListSetter(1)" id="b1" class="btn btn-lg btn-block btn-primary"/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12">
                            <input disabled value="Effacer" type="Button" style="height: 50px" onclick="ResetArray()" id="b2" class="btn btn-lg btn-block btn-danger"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
</body>

</html>
