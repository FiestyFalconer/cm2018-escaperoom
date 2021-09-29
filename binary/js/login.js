/*s
  Auteurs         : Soares Rodrigues Flavio, De Castilho E Sousa Rodrigo
  Description     : Fichier JS utilisé dans la page login.php

  Date            : 2021.09.16
  Version         : 1.0.0
*/

let boolPresser = false; // Voir si le bouton à déjà été pressé
let nbPresser = 0; // Nombre de fois qu'on a pressé un bouton

let nb1 = ""; // Premier nombre (lors du clique)
let nb2 = ""; // Deuxiemme nombre (lors du clique)

const NBTIME = 5000; // Nombre de secondes augmentée à chaque mauvaise tentatives

sessionStorage.setItem("login", false); // Stock l'état de connexion du client (connecté ou non)

// Met la valeur de time à 5000 si la session n'existe pas
if(!sessionStorage.getItem("time")){
  sessionStorage.setItem("time",5000);
}

// Afficher les nombres dans les "_"
function btnClick(nbLettre) {
  let nbAffichage1 = document.getElementById("valueEn1");
  let nbAffichage2 = document.getElementById("valueEn2");

  // Savoir si on a déjà cliqué une fois
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
  // Savoir si on a trouvé le code
  if (boolPresser) {
    verificationLogin(nb1, nb2)
  }
}

// Verification si on a bien trouvé le code
function verificationLogin(nb1, nb2) {
  if (nb1 == String(sol1) && nb2 == String(sol2)) {
    sessionStorage.setItem("login", true);
    document.location.href = "http://git/cm2018-escaperoom/binary/index.php"; // Aller dans la page d'accueil
  }
  else {
    travelListButtons(true);

    // Augmenter les secondes à chaque fois qu'on fait une erreur
    let timeSession = sessionStorage.getItem('time') // Session qui garde les secondes d'attentes (pénalité)

    console.log(timeSession); // Afficher timeSession dans la console

    setTimeout(deleteNbLogin, timeSession); // Appeler une fois la fonction 

    timeSession = parseInt(timeSession);

    timeSession += NBTIME; // Augmenter les secondes

    sessionStorage.setItem("time", timeSession); // Garder le nombre de secondes dans la session
  }
}

// Supprimer les données des variables et enlève le disabled des boutons
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
    let hexa = i.toString(16).toUpperCase(); //Converti les nombres décimal en hexadécimal et les met en majuscules (lettres)
    btnButtons[hexa].disabled = boolButtons;
  }
}