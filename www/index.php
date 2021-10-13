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
require_once "./php/tools.php";

$tableauCode = getEnigmeCode(); // Récupère les 3 énigmes de la db

$en1 = $tableauCode[0]['en1']; // Récupère l' énigmes 1 de la db
$en2 = $tableauCode[0]['en2']; // Récupère l' énigmes 2 de la db

?>
<!DOCTYPE html>
<html>

<head>

    <title>Cité des métiers | Enigme 3</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./img/3_icon.ico" />

</head>

<body class="text-center">
    <main id="endgame" hidden>
        <img id="winImage" src="./img/cadena_ouvert.png" alt="winImg">
    </main>
    <main id="game" class="container-fluid">
        <img src="./img/logo.png" id="logo" alt="logo">
        <section class="col-xs-6">
            <div class="col-xs-6">
                <div class="row">
                    <span class="solutions" id="sol1">?</span>
                </div>

                <?=showDash(true)?>

                <div class="row hexadecimal">
                    <span id="hex0">0</span>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="row">
                    <span class="solutions" id="sol2">?</span>
                </div>

                <?=showDash(false)?>

                <div class="row hexadecimal">
                    <span id="hex1">0</span>
                </div>
            </div>
        </section>
        <section class="col-xs-6">
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
                                <input disabled value="0" type="Button" onclick="ListSetter(0)" id="btn0" class="btn btnBinaire btn-primary" />
                            </div>
                            <div class="col-xs-6">
                                <input disabled value="1" type="Button" onclick="ListSetter(1)" id="btn1" class="btn btnBinaire btn-primary" />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <input disabled value="Effacer" type="Button" onclick="ResetArray()" id="btnEffacer" class="btn btn-danger" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
<script>
    let sol1 = "<?= $en1 ?>"; // Enigme 1 
    let sol2 = "<?= $en2 ?>"; // Enigme 2
</script>

<script src="js/index.js"></script>

</html>