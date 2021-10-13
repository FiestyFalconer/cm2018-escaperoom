<?php
    require_once "tools.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cité des métiers | Login</title>
    
    <link rel="stylesheet" type="text/css" href="../www/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../www/assets/css/login.css">
    <link rel="icon" href="../www/assets/img/login.ico"/>
</head>

<body>
    <img src="../www/assets/img/logo.png" id="logo" alt="logo">
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

<script src="../www/assets/js/login.js"></script>
<script>
    let sol1 = "<?=$en1?>"; // Enigme 1 
    let sol2 = "<?=$en2?>"; // Enigme 2
</script>
</html>