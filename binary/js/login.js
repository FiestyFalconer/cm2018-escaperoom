/*s
  Auteurs         : Soares Rodrigues Flavio, De Castilho E Sousa Rodrigo
  Description     : Fichier JS utilisé dans la page login.php

  Date            : 2021.09
  Version         : 1.0.0
*/

let boolPress = false; // Pour savoir si le button à déjà été pressé
let nbPress = 0; // Nombre de fois qu'on a pressé un button

let nb1 = ""; // Premier nombre (lors du clique)
let nb2 = ""; // Deuxième nombre (lors du clique)

let interval;

// Nombre de secondes augmenté à chaque mauvaise tentative
const NBTIME = 5000;

// Set la valeur de "login" à false
sessionStorage.setItem("login", false);

// Crée la variable "time" dans la session si elle n'existe pas 
if(!sessionStorage.getItem("time"))
{
  sessionStorage.setItem("time",5000); 
}

// Crée la variable "countTime" dans la session si elle n'existe pas 
if(!sessionStorage.getItem("countTime")){
  sessionStorage.setItem("countTime",0); 
}

// Récupère la variable countTime stocké dans la session
let countTime = sessionStorage.getItem("countTime");

// Affiche les nombres dans les "_"
function btnClick(nbLettre) {
  let nbAffichage1 = document.getElementById("valueEn1");
  let nbAffichage2 = document.getElementById("valueEn2");

  // Savoir si on a déjà cliqué une fois
  if (nbPress == 0) {
    nb1 = nbLettre;
    nbPress += 1;
    nbAffichage1.innerHTML = nb1;
  }
  else if (nbPress == 1) {
    nb2 = nbLettre;
    nbPress += 1;
    nbAffichage2.innerHTML = nb2;
    boolPress = true;
  }
  // Savoir si on a trouvé le code
  if (boolPress) {
    verificationLogin(nb1, nb2);
  }
}

// Vérification du login
function verificationLogin(nb1, nb2) {
  
  // Connecte l'utilisateur et le redirige vers une autre page
  if (nb1 == String(sol1) && nb2 == String(sol2)) {
    sessionStorage.setItem("login", true);
    document.location.href = "http://git/cm2018-escaperoom/binary/index.php"; // Redirige le client vers la page "index.php"
  }
  // Lance le timer (pénalité)
  else {
    beginTimer();
  }
}

// Lance le timer
function beginTimer(){

  travelListButtons(true);

  // Récupère la variable "time" stocké dans la session
  let timeSession = sessionStorage.getItem('time')

  // Timer (1000 millisecondes)
  interval = setInterval(showTimer, 1000);

  // Converti en int
  timeSession = parseInt(timeSession); 
  
  // Converti en secondes
  sessionStorage.setItem("countTime",(parseInt(timeSession)/1000));
  
  // Augmenter les secondes
  timeSession += NBTIME;

  // Garder le nombre de secondes dans la session
  sessionStorage.setItem("time", timeSession);
}

// Supprimer les données des variables et enlève le disabled des boutons
function deleteNbLogin() {
  let nbAffichage1 = document.getElementById("valueEn1");
  let nbAffichage2 = document.getElementById("valueEn2");
  nbAffichage1.innerHTML = "_";
  nbAffichage2.innerHTML = "_";
  nb1 = "";
  nb2 = "";
  nbPress = 0;
  boolPress = false;
  travelListButtons(false);
}

// Mettre les boutons en "disabled"
function travelListButtons(boolBtn) {

  let btn = document.getElementsByTagName("input");

  for (let i = 0; i < 16; i++) {

    // Converti les nombres décimal en hexadécimal et les met en majuscule
    let hexa = i.toString(16).toUpperCase();

    btn[hexa].disabled = boolBtn;
  }
}

// Permet d'afficher le timer
function showTimer(){

  countTime = sessionStorage.getItem("countTime");

  // Affichage du timer
  let nbTime = document.getElementById('nbTime');

  nbTime.innerHTML = String(countTime); // Converti countTime en string pour l'afficher sur la page
  console.log(countTime); // Affichage du timer dans la console
  countTime = countTime - 1; // Décrémente de 1
  sessionStorage.setItem("countTime", countTime); // Stock la valeur dans la session
  nbTime.hidden = false; // Affiche le timer

  // Condition pour arrêter le timer
  if(countTime < 0){
    deleteNbLogin();
    clearInterval(interval);
    nbTime.hidden = true;
  }
}

// Garde l'état d'avant lors ce qu'on rafraichit la page
if(sessionStorage.getItem("countTime") > 0){
  clearInterval(interval);
  beginTimer();
}