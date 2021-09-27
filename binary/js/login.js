/*s
  Auteurs        : Soares Flavio, De Castilho E Sousa Rodrigo
  Date           : 2021.09.16
  version        : 1.0.0.0
*/

let boolTouche = false; // bool pour voir si on a deja taper 2 fois
let nbTouche = 0; // nombre de fois qu'on a taper

let nb1 = ""; //premier nombre choisi
let nb2 = ""; //deuxiemme nombre choisi

let time = 5000; //nombre de secondes a attendre
const NBTIME = 5000; //nombre de secondes que vont augmnter

if(!sessionStorage.getItem("time")){
  sessionStorage.setItem("time",5000);
}

if(!sessionStorage.getItem("boolLogin")){
  sessionStorage.setItem("boolLogin", false);
}

//afficher les nombres dans les "_"
function btnClick(nbLettre){
    let nbAffichage1 = document.getElementById("valueEn1");
    let nbAffichage2 = document.getElementById("valueEn2");
    //savoir si on a deja cliquer une fois
    if(nbTouche == 0){
      nb1 = nbLettre;
      nbTouche += 1;
      nbAffichage1.innerHTML = nb1;
    }
    else if(nbTouche == 1){
      nb2 = nbLettre;
      nbTouche += 1;
      nbAffichage2.innerHTML = nb2;
      boolTouche = true;
    }
    //savoir si on a trouver le code
    if(boolTouche){
        verificationLogin(nb1,nb2)
    }
  }
  //verification si on a bien trouver le code
  function verificationLogin(nb1,nb2){
    if(nb1 == String(sol1) && nb2 == String(sol2)){
        sessionStorage.setItem("boolLogin", true);
        document.location.href="http://git/cm2018-escaperoom/binary/index.php"; //aller dans la page d'accuille
    }
    else{

        travelListButtons(true);
        
        /*augmenter les secondes a chaque fois qu'on fait un erreur*/
        let timeSession = sessionStorage.getItem('time')// session pour garder les secondes d'attends

        console.log(timeSession);//afficher

        setTimeout(deleteNbLogin,timeSession);//appeller une fois la fonction 
        
        timeSession = parseInt(timeSession);
        
        timeSession += NBTIME;// augmenter les secondes

        sessionStorage.setItem("time",timeSession);// garder le nombre de secondes dans la session
    }
  }
  //suprimer les donnees des variables et enlever le disabled des boutons
  function deleteNbLogin(){
    let nbAffichage1 = document.getElementById("valueEn1");
    let nbAffichage2 = document.getElementById("valueEn2");
    nbAffichage1.innerHTML = "_";
    nbAffichage2.innerHTML = "_";
    nb1 = "";
    nb2 = "";
    nbTouche = 0;
    boolTouche = false;
    travelListButtons(false);
  }
  //mettre les boutons en "disabled"
  function travelListButtons(boolButtons){
    let btnButtons = document.getElementsByTagName("input");
    for(let i = 0; i<16; i++){
      let hexa = i.toString(16).toUpperCase();//Converti les nombres décimal en hexadécimal et les met en majuscules (lettres)
      btnButtons[hexa].disabled = boolButtons;
    }   
  } 