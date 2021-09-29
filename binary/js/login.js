/*s
  Auteurs         : Soares Rodrigues Flavio, De Castilho E Sousa Rodrigo
  Description     : Fichier JS utilisé dans la page login.php

  Date            : 2021.09.16
  Version         : 1.0.0
*/

let boolPresser = false; // Pour savoir si le button à déjà été pressé
let nbPresser = 0; // Nombre de fois qu'on a pressé un button

let nb1 = ""; // Premier nombre (lors du clique)
let nb2 = ""; // Deuxiemme nombre (lors dz clique)

const NBTIME = 5000; // Nombre de secondes augmenté à chaque movaise tentative

sessionStorage.setItem("login", false);

// Crée la session si elle n'existe pas 
if(!sessionStorage.getItem("time")){
  sessionStorage.setItem("time",5000); 
}
if(!sessionStorage.getItem("countTime")){
  sessionStorage.setItem("countTime",5); 
}

// Afficher les nombres dans les "_"
function btnClick(nbLettre) {
  let nbAffichage1 = document.getElementById("valueEn1");
  let nbAffichage2 = document.getElementById("valueEn2");

  // Savoir si on a deja cliquer une fois
  if (nbPresser == 0) {
    nb1 = nbLettre;
    nbPresser += 1;
    nbAffichage1.innerHTML = nb1;
  }
  else if (nbPresser == 1) {
    nb2 = nbLettre;
    nbPresser += 1;
    nbAffichage2.innerHTML = nb2;
    boolPresser = true;
  }
  // Savoir si on a trouver le code
  if (boolPresser) {
    verificationLogin(nb1, nb2)
  }
}

// Vérification si on a bien trouver le code
function verificationLogin(nb1, nb2) {
  if (nb1 == String(sol1) && nb2 == String(sol2)) {
    sessionStorage.setItem("login", true);
    document.location.href = "http://git/cm2018-escaperoom/binary/index.php"; //aller dans la page d'accuille
  }
  else {
    beginTimer();
  }
}
let interval;

// Lance le timer
function beginTimer(){

  travelListButtons(true);

  // Session pour garder les secondes d'attends
  let timeSession = sessionStorage.getItem('time')

  interval = setInterval(showTimer, 1000); // Timer (1000 miliseconde)

  // Converti en int
  timeSession = parseInt(timeSession); 
  
  sessionStorage.setItem("countTime",(parseInt(timeSession)/1000));
  
  // Augmenter les secondes
  timeSession += NBTIME;

  // Garder le nombre de secondes dans la session
  sessionStorage.setItem("time", timeSession);
}

// Supprimer les données des variables et enlever le disabled des boutons
function deleteNbLogin() {
  let nbAffichage1 = document.getElementById("valueEn1");
  let nbAffichage2 = document.getElementById("valueEn2");
  nbAffichage1.innerHTML = "_";
  nbAffichage2.innerHTML = "_";
  nb1 = "";
  nb2 = "";
  nbPresser = 0;
  boolPresser = false;
  travelListButtons(false);
}

// Mettre les boutons en "disabled"
function travelListButtons(boolButtons) {
  let btnButtons = document.getElementsByTagName("input");
  for (let i = 0; i < 16; i++) {
    let hexa = i.toString(16).toUpperCase(); // Converti les nombres décimal en hexadécimal et les met en majuscules (lettres)
    btnButtons[hexa].disabled = boolButtons;
  }
}

// Afficher le timer
function showTimer(){

  // Avoir les données de la session
  let countTime = sessionStorage.getItem("countTime")

  // Affichage du timer
  let nbTime = document.getElementById('nbTime');
  nbTime.hidden = false; // Montrer le timer

  nbTime.innerHTML = String(countTime); // Affichage des nombres dans le timer
  console.log(countTime); // Affichage des nombres dans la console
  countTime = countTime - 1; // Soustracion du timer
  sessionStorage.setItem("countTime", countTime); // Garder le valeur dans la session

  // Condition pour arreter le timer
  if(countTime <= -1){
    deleteNbLogin();
    clearInterval(interval);
    nbTime.hidden = true;
  }
}
