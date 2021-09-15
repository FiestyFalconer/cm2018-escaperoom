/*
 * Auteur  : Lopes Miguel, Troller Fabian, Juling Guntram
 * Date    : 2018.11.06
 * Description : Code javascript cité des metiers
 */
const DEFAULT_CHAR = "_"; // caractere par defaut
var listBin = [
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR,
  DEFAULT_CHAR
]; // initialisation de la table des solutions binaires avec les caracteres par defaut
const LIMIT_BIN = 8; // taille limite de la liste binaire

let checkServerInterval = setInterval(checkServer, 2000);
let checkNewGameInterval = null;
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

  // remplace les caracteres par defaut par des 0
  for (var i = 0; i < listBin.length; i++) {
    if (listBin[i] == "_") {
      bin += "0";
    } else {
      bin += listBin[i];
    }
  }

  // affichage binaire
  for (var i = 0; i < listBin.length; i++) {
    document.getElementById("value" + i).innerHTML = listBin[i];
  }

  // calcul de l'hexadecimal
  hex[0] = parseInt(bin.substring(0, 4), 2)
    .toString(16)
    .toUpperCase();
  hex[1] = parseInt(bin.substring(4), 2)
    .toString(16)
    .toUpperCase();

  // afiichage hexadecimal
  for (var i = 0; i < hex.length; i++) {
    document.getElementById("hex" + i).innerHTML = hex[i];
  }
  // si la valeur calculee correspond a la valeur attendue
  if (
    hex[0] == document.getElementById("sol0").innerHTML &&
    hex[1] == document.getElementById("sol1").innerHTML
  ) {
    Win();
  }
}

// Finis la partie
function Win() {

}

function checkServer() {
  document.getElementById("sol0").innerHTML = sol0;
  document.getElementById("sol1").innerHTML = sol1;

  document.getElementById("B0").removeAttribute("disabled");
  document.getElementById("B1").removeAttribute("disabled");
  document.getElementById("B2").removeAttribute("disabled");
}

function checkNewGame() {

}
