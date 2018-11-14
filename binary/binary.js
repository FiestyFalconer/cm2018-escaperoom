/*
Auteur  : Lopes Miguel, Troller Fabian, Juling Guntram
Date    : 2018.11.06
Description : Code javascript cité des metiers
 */
const DEFAULT_CHAR = "_"; // caractere par defaut
var listBin = [DEFAULT_CHAR, DEFAULT_CHAR, DEFAULT_CHAR, DEFAULT_CHAR, DEFAULT_CHAR, DEFAULT_CHAR, DEFAULT_CHAR, DEFAULT_CHAR];// initialisation de la table des solutions binaires avec les caracteres par defaut
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
        }
        else {
            bin += listBin[i];
        }
    }

    // affichage binaire
    for (var i = 0; i < listBin.length; i++) {
        document.getElementById('value' + i).innerHTML = (listBin[i]);
    }

    // calcul de l'hexadecimal
    hex[0] = parseInt(bin.substring(0, 4), 2).toString(16).toUpperCase();
    hex[1] = parseInt(bin.substring(4), 2).toString(16).toUpperCase();

    // afiichage hexadecimal
    for (var i = 0; i < hex.length; i++) {
        document.getElementById('hex' + i).innerHTML = hex[i];
    }
    // si la valeur calculee correspond a la valeur attendue
    if (hex[0] == document.getElementById('sol0').innerHTML && hex[1] == document.getElementById('sol1').innerHTML) {
        Win();
    }
}

// Finis la partie
function Win() {

    var Address = ADDR + "/end.php";
    clearInterval(checkServerInterval);
	  req.open('GET', Address, false);
    req.send(null);
    if(req.status === 200 || req.status === 201)
    {
      document.getElementById("game").setAttribute("hidden",true);
      document.getElementById('endgame').removeAttribute("hidden");
    }
    checkNewGameInterval = setInterval(checkNewGame, 2000);

    console.log("GAGNÉ");
}

const req = new XMLHttpRequest();

function checkServer() {

    var  Address = ADDR + "/soluce.php";
	  req.open('GET', Address, false);
    req.send(null);

    if (req.status === 200) {
        var jsonData = JSON.parse(req.responseText);
        var step1Validated = false;
        var step2Validated = false;

        if (jsonData.step1 != null)
        {
            step1Validated = true;
            document.getElementById('sol0').innerHTML = jsonData.soluce1;
        } else {
          document.getElementById('sol0').innerHTML ="?";
        }

        if (jsonData.step2 != null)
        {
            step2Validated = true;
            document.getElementById('sol1').innerHTML = jsonData.soluce2;
        } else {
          document.getElementById('sol1').innerHTML ="?";
        }

        if (step1Validated && step2Validated)
        {
            document.getElementById('B0').removeAttribute("disabled");
            document.getElementById('B1').removeAttribute("disabled");
            document.getElementById('B2').removeAttribute("disabled");
            //clearInterval(checkServerInterval);
        }
        localStorage.setItem("oldIdGame", jsonData.idGame);
    }
}
function checkNewGame(){
    var  Address = ADDR + "/soluce.php";
	  req.open('GET', Address, false);
    req.send(null);

    if (req.status === 200) {
        var jsonData = JSON.parse(req.responseText);
        let oldIdGame = localStorage.getItem("oldIdGame");

        if (jsonData.idGame != oldIdGame && jsonData.step1 == null && jsonData.step2 == null && jsonData.end == null) {
          clearInterval(checkNewGameInterval);
          document.location.reload();
        }
    }

}
