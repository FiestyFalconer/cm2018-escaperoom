/*
  Auteur  : Lopes Miguel, Troller Fabian, Juling Guntram
  Date    : 2018.11.06
  Description : Code javascript cité des metiers
 
  Modifications  :
  Auteurs        : Soares Flavio, De Castilho E Sousa Rodrigo
  Date           : 2021.09.16
*/

let boolTouche = false; // bool pour voir si on a deja taper 2 fois
let nbTouche = 0; // nombre de fois qu'on a taper

let nb1 = "";
let nb2 = "";

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
        document.location.href="http://git/cm2018-escaperoom/binary/index.php"; 
    }
    else{
        setInterval(deleteNbLogin,2000);
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
  }