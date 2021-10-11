<?php
/*
  Auteur      : Soares Flavio, De Castilho E Sousa Rodrigo
  Description : Fonctions php 

  Date        : 10.2021
  Version     : 1.0
*/

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