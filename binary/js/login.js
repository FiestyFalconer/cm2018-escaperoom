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

let time = 5000; // Nombre de secondes de penalité
const NBTIME = 5000; // Nombre de secondes augmenté à chaque movaise tentative

sessionStorage.setItem("boolLogin", false); // Ajoute dans la session une variable qui permet de savoir si l'utilisateur est connecté

// sessionStorage.setItem("time", 5000); // Ajoute dans la session une variable qui permet de garder la valeur de la penalité

//afficher les nombres dans les "_"
function btnClick(nbLettre) {
  let nbAffichage1 = document.getElementById("valueEn1");
  let nbAffichage2 = document.getElementById("valueEn2");

  //savoir si on a deja cliquer une fois
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
  //savoir si on a trouver le code
  if (boolPresser) {
    verificationLogin(nb1, nb2)
  }
}
//verification si on a bien trouver le code
function verificationLogin(nb1, nb2) {
  if (nb1 == String(sol1) && nb2 == String(sol2)) {
    sessionStorage.setItem("boolLogin", true);
    document.location.href = "http://git/cm2018-escaperoom/binary/index.php"; //aller dans la page d'accuille
  }
  else {

    travelListButtons(true);

    /*augmenter les secondes a chaque fois qu'on fait un erreur*/
    let timeSession = sessionStorage.getItem('time')// session pour garder les secondes d'attends

    console.log(timeSession);//afficher

    setTimeout(deleteNbLogin, timeSession);//appeller une fois la fonction 

    timeSession = parseInt(timeSession);

    timeSession += NBTIME;// augmenter les secondes

    sessionStorage.setItem("time", timeSession);// garder le nombre de secondes dans la session
  }
}
//suprimer les donnees des variables et enlever le disabled des boutons
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
//mettre les boutons en "disabled"
function travelListButtons(boolButtons) {
  let btnButtons = document.getElementsByTagName("input");
  for (let i = 0; i < 16; i++) {
    let hexa = i.toString(16).toUpperCase();//Converti les nombres décimal en hexadécimal et les met en majuscules (lettres)
    btnButtons[hexa].disabled = boolButtons;
  }
}