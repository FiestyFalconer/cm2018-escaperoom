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

////////////////////////////////////////////////////////////////////////
function showDash($carreDeDeux){
  $string = " <div class='row'>";

  $string .="    <p class='carreDeDeux'>
                  &nbsp;2<sup>3</sup>&nbsp;
                  &nbsp;2<sup>2</sup>&nbsp;
                  &nbsp;2<sup>1</sup>&nbsp;
                  &nbsp;2<sup>0</sup>&nbsp;
                </p>
              </div>
              <div class='row binary'>
                 <hr>";
    
  if($carreDeDeux){
    for ($i = 0; $i < 4; $i++){
      $string .= '&nbsp;<span id="value' . $i . '">_</span>&nbsp;';
    };
  }
  else{
    for ($i = 4; $i < 8; $i++){
      $string .= '&nbsp;<span id="value' . $i . '">_</span>&nbsp;';
    };          
  }
  
  $string .=" <hr>
            </div>";
  return $string;            
}