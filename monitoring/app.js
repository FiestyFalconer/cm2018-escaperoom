document.getElementById("playParty").addEventListener("click", function (e) {
  StartTimer();
  
  NewGame()
    .then(response => {
      console.log(response)
      StartVideo();

      //Get the launched game
      fetch(`${API_ENDPOINT}/soluce.php`, {
        method: 'GET'
      })
      .then(response => {
        response.json()
          .then(json => {
            server_data = json
            cablesProcessing();
            detectCables(server_data.idCable1, server_data.idCable2, server_data.idCable3);
          })
        })
    })
    .catch(err => console.log(err));
});

document.getElementById("resetParty").addEventListener("click", function (e) {
  EndTimer();
  StartVideo(false);
});

const API_ENDPOINT = 'http://192.168.123.242/webdispatcher';
const SENSEHAT_ENDPOINT = 'http://192.168.123.241';
const PIFACE2_ENDPOINT = 'http://192.168.123.240';

let cablesProcessingInterval = null;
let server_data = null;

//timer
const TIMETOWORK = 60 * 15;
const ONESECOND = 1;

let time = TIMETOWORK;
let timer;
let start = 0;
DisplayTimer(TIMETOWORK);

function StartTimer() {
  if (!start) {
    timer = setInterval(NewTime, 1000);
    start = 1;
  }
}

function EndTimer() {
  clearInterval(timer);
  clearInterval(cablesProcessingInterval);

  time = TIMETOWORK;
  start = 0;
  DisplayTimer(TIMETOWORK);
}

function StopTimer() {
  clearInterval(timer);
  start = 0;
}

function NewTime() {
  if (time > 0) {
    time -= ONESECOND;
    DisplayTimer(time);
  } else {
    //The time has expired
    EndTimer();
    StartVideo(false);
  }
}

function DisplayTimer(ActualTime) {
  let seconds = Math.floor(ActualTime % 60).toString();
  let minutes = Math.floor(ActualTime / 60).toString();
  if (seconds.length === 1) {
    seconds = '0' + seconds;
  }

  document.getElementById("timer").innerHTML = minutes + ':' + seconds;
}

/**
 * Requête HTTP asynchrone pour démarrer la vidéo de présentation de l'escaperoom
 * @param {boolean} pause 
 */
function StartVideo(pause = true) {
  let isPaused = +pause;
  fetch(`${API_ENDPOINT}/video.php?play=${isPaused}`, {
      method: 'GET'
    })
    .then(response => {
      response.json()
        .then(json => {
          console.log(json);
        });
    })
    .catch(err => console.log(err));
}

/**
 * Requête asynchrone pour créer une nouvelle partie
 */
function NewGame() {
  return fetch(`${API_ENDPOINT}/start.php`, {
    method: 'GET'
  })
}

/**
 * Requête HTTP asynchrone pour récupérer les informations de la partie en cours
 */
function GetGameInfo() {
  return fetch(`${API_ENDPOINT}/soluce.php`, {
      method: 'GET'
    })
    .then(response => {
      response.json()
        .then(json => {
          server_data = json

          if (server_data.step1) {
            clearInterval(cablesProcessingInterval)
            displaySensehatSolution(server_data.soluce1)
          }

          RefreshView(server_data);

          return server_data;
        });
    })
    .catch(err => console.log(err));
}

/**
 * Requête HTTP pour afficher les câbles sur le sensehat du raspberry
 */
function displaySensehatMessage(cable1, cable2, cable3) {
  if (cable1, cable2, cable3) {
    fetch(`${SENSEHAT_ENDPOINT}/python/sensehat_message.py?text=${cable1} ${cable2} ${cable3}`, {
        method: 'GET'
      })
      .then(response => {
        //
      })
      .catch(err => console.log(err));
  }
}

/**
 * Requête HTTP pour afficher la solution sur le sensehat lorsque les câbles sont correctement branchées
 * @param {string} solution 
 */
function displaySensehatSolution(solution) {

  if (solution) {
    fetch(`${SENSEHAT_ENDPOINT}/python/sensehat_letter.py?letter=${solution}`, {
        method: 'GET'
      })
      .then(response => {
        //
      })
      .catch(err => console.log(err));
  }
}

/**
 * Requête HTTP pour lancer la détection des câbles
 * @param {int} firstId 
 * @param {int} secondId 
 * @param {int} thirdId 
 */
function detectCables(firstId, secondId, thirdId) {
  if (firstId && secondId && thirdId) {
    console.log(`${PIFACE2_ENDPOINT}/python/cables_detector.py?first=${firstId}&second=${secondId}&third=${thirdId}`)
    fetch(`${PIFACE2_ENDPOINT}/python/cables_detector.py?first=${firstId}&second=${secondId}&third=${thirdId}`, {
        method: 'GET'
      })
      .then(response => {
        //
      })
      .catch(err => console.log(err));
  }
}

/**
 * Affiche les câbles sur le sensehat (refresh toutes les 20 secondes par défaut)
 * lorsque les câbles sont correctement branchés, affiche la première solution
 */
function cablesProcessing() {
  if (server_data.step1 == null) {
    displaySensehatMessage(server_data.nameCable1, server_data.nameCable2, server_data.nameCable3)

    cablesProcessingInterval = setInterval(function () {
      displaySensehatMessage(server_data.nameCable1, server_data.nameCable2, server_data.nameCable3)
    }, 20000) //every 20 seconds
  }
}

/**
 * Affiche le statut d'un raspberry
 * @param {string} selector 
 * @param {string} prefix
 * @param {boolean} status 
 */
function displayStatus(selector, prefix = '', status) {
  if (status) {
    document.querySelector(selector).innerHTML = `${prefix} <i class="fas fa-check-circle done"></i>`
  } else {
    document.querySelector(selector).innerHTML = `${prefix} <i class="fas fa-times-circle error"></i>`
  }
}

/**
 * Affiche si l'énigme a commencée ou non (si oui, heure affichée)
 * @param {string} selector 
 * @param {string} date 
 */
function displayStepDate(selector, date) {
  if (date) {
    let riddle = new Date(date.replace(/\s/, 'T') + 'Z')
    let minutes = riddle.getMinutes();

    if (minutes < 10) {
      minutes = `0${minutes}`
    }

    document.querySelector(selector).innerHTML = `commencée à <b>${riddle.getHours()-1}h${minutes}</b>`
  } else {
    document.querySelector(selector).innerHTML = `énigme pas commencée`
  }
}

/**
 * Affiche un spinner (in progress) dans la div souhaitée
 * @param {string} selector 
 */
function displayInProgress(selector) {
  if (selector) {
    let inProgress = `<i class="fas fa-spinner fa-spin in-progress"></i>`
    if(document.querySelector(selector).innerHTML != inProgress) {
      document.querySelector(selector).innerHTML = inProgress
    }
  }
}

/**
 * Cette fonction s'occupe de mettre à jour toute la vue 
 * du dashboard en récupérant les données du serveur
 * @param {*} json 
 */
function RefreshView(json) {

  //piface
  document.querySelector('#cables-tofind').innerHTML = `${json.nameCable1}-${json.nameCable2}-${json.nameCable3}`

  //hexacodes
  document.querySelector('#first-hexacode-tofind').innerHTML = `"${json.soluce1}"`
  document.querySelector('#second-hexacode-tofind').innerHTML = `"${json.soluce2}"`

  //game identifier
  document.querySelector('#game-number').innerHTML = `Partie n°${json.idGame}`

  //Date of the game
  let date = new Date(json.start.replace(/\s/, 'T') + 'Z')
  if (date) {
    document.querySelector('#game-date > b').innerHTML = `${date.getUTCDate()}.${date.getMonth() + 1}.${date.getFullYear()}`
  }

  displayStepDate('#riddle1-beginning', json.start)
  displayStepDate('#riddle2-beginning', json.step1)
  displayStepDate('#riddle3-beginning', json.step2)

  //hex to binary
  document.querySelector('#masterBerry').innerHTML = `0x${json.soluce1}${json.soluce2} > ${json.binary}`

  //ping
  displayStatus('.piface-riddle1', 'Piface', json.piface_up)
  displayStatus('.piface-riddle2', 'Piface', json.piface_up)
  displayStatus('.sensehat', 'Sensehat', json.sensehat_up)
  displayStatus('.laby', 'Labyrinthe', json.laby_up)

  //laby status
  if (json.step2) {
    document.querySelector('#laby-status').innerHTML = `Labyrinthe réussi !`
  } else {
    displayInProgress('#laby-status')
  }

  //is party finish
  if (json.end) {
    document.querySelector('#party-finish').innerHTML = `La partie est terminée !`
    EndTimer();
    StartVideo(false);
  } else {
    displayInProgress('#party-finish')
  }
}

//interval(s)
setInterval(GetGameInfo, 1000);