/*s
  Auteurs        : Soares Flavio, De Castilho E Sousa Rodrigo
  Date           : 2021.09.16
  version        : 1.0.0.0
*/

let boolTouche = false; // bool pour voir si on a deja taper 2 fois
let nbTouche = 0; // nombre de fois qu'on a taper

let nb1 = "";
let nb2 = "";

let time = 5000;
const NBTIME = 5000;

sessionStorage.setItem("boolLogin", false);

sessionStorage.setItem("time",5000);

function btnClick(nbLettre){
    let nbAffichage1 = document.getElementById("valueEn1");
    let nbAffichage2 = document.getElementById("valueEn2");

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

    if(boolTouche){
        verificationLogin(nb1,nb2)
    }
  }
  
  function verificationLogin(nb1,nb2){
    if(nb1 == String(sol1) && nb2 == String(sol2)){
        sessionStorage.setItem("boolLogin", true);
        document.location.href="http://git/cm2018-escaperoom/binary/index.php"; 
    }
    else{

        travelListButtons(true);
        
        let timeSession = sessionStorage.getItem('time')

        console.log(timeSession);
        setTimeout(deleteNbLogin,timeSession);
        
        timeSession = parseInt(timeSession);
        
        timeSession += NBTIME;

        sessionStorage.setItem("time",timeSession);
    }
  }
  
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

  function travelListButtons(boolButtons){
    let btnButtons = document.getElementsByTagName("input");
    for(let i = 0; i<16; i++){
      let hexa = i.toString(16).toUpperCase();
      btnButtons[hexa].disabled = boolButtons;
    }   
  } 