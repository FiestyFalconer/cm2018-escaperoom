/*
  Auteur         : Lopes Miguel, Troller Fabian, Juling Guntram
  Date           : 2018.11.06
  Description    : Code javascript cité des metiers
 
  Modifications  :
  Auteurs        : Soares Flavio, De Castilho E Sousa Rodrigo
  Date           : 09.2021
*/

const DEFAULT_CHAR = "_"; // Caractère par defaut
const LIMIT_BIN = 8; // Taille limite de la liste binaire 

let checkVariablesInterval = setTimeout(checkVariables, 1000); // Appel la fonction checkVariables toutes le 1 secondes

// Initialisation de la table des solutions binaires avec les caracteres par defaut
var listBin = [
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR
];

let session = sessionStorage.getItem("login"); // Session

// Redirige l'utilisateur vers la page login.php si il n'est pas connecté
if(session == "false"){
  goToLogin();
}

// Redirige l'utilisateur vers la page login.php
function goToLogin(){
  document.location.href="http://git/cm2018-escaperoom/binary/login.php";
}

// Vérifie les variables
function checkVariables() {
  let solution1 = document.getElementById("sol1").innerHTML = sol1;
  let solution2 = document.getElementById("sol2").innerHTML = sol2;

  // Met les 3 buttons (0; 1; Effacer) en Enable
  let btn0 = document.getElementById("b0").removeAttribute("disabled");
  let btn1 = document.getElementById("b1").removeAttribute("disabled");
  let btn2 = document.getElementById("b2").removeAttribute("disabled");
}

// Permet d'inserer la valeur dans la liste en decalant la liste
function ListSetter(value) {
  listBin.push(value);
  while (listBin.length > LIMIT_BIN) {
    listBin.shift(listBin);
  }
  UpdateView(listBin);
  return listBin;
}

// Remet la liste par defaut
function ResetArray() {
  for (var i = 0; i < listBin.length; i++) {
    listBin[i] = "_";
  }
  UpdateView(listBin);
}

// Affiche les donnees sur la page
function UpdateView(listBin) {
  var bin = "";
  var hex = [];

  console.log(listBin);

  // Remplace les caracteres par defaut par des 0
  for (var i = 0; i < listBin.length; i++) {
    if (listBin[i] == "_") {
      bin += "0";
    } else {
      bin += listBin[i];
    }
  }

  // Affichage binaire
  for (var i = 0; i < listBin.length; i++) {
    document.getElementById("value" + i).innerHTML = listBin[i];
  }

  // Calcul de l'hexadecimal
  hex[0] = parseInt(bin.substring(0, 4), 2).toString(16).toUpperCase();
  hex[1] = parseInt(bin.substring(4), 2).toString(16).toUpperCase();

  // Afiichage hexadecimal
  for (var i = 0; i < hex.length; i++) {
    document.getElementById("hex" + i).innerHTML = hex[i];
  }

  // Si la valeur calculee correspond a la valeur attendue
  if (hex[0] == document.getElementById("sol1").innerHTML && hex[1] == document.getElementById("sol2").innerHTML)
  {
    Win();
  }
}

// Finis la partie
function Win() {
  let endGame = document.getElementById("endgame").removeAttribute("hidden"); // Enleve l'attribut hidden pour afficher l'image de fin de partie
  let game = document.getElementById("game").hidden = true; // Cache le jeu
  sessionStorage.setItem("time",5000);
  setTimeout(goToLogin,30000);
}