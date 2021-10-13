<?php

$page = 'index.php';

// si on demande la page de login, on change la valeur de $page
if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'login.php')) {
    $page = 'login.php';
}

die(var_dump($page));

// on fait un require de la page demandée
require $page;