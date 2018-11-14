

#  Moniteur de surveillance de l'escaperoom (à distance)

## Contexte

Le but était de créer un tableau de bord accessible depuis le web pour voir l'état de la partie en cours, le tout en temps réel. Le tableau de bord affiche l'avancée (les énigmes résolues) des joueurs actuellement présents dans l'escaperoom. Il est également possible d'interrompre une partie et d'en démarrer une nouvelle.

## Installation

### Webdispatcher

Le tableau de bord met à jour son interface automatiquement grâce aux données renvoyées par le [**webdispatcher**](https://github.com/CFPTI/cm2018-escaperoom/tree/master/webdispatcher).
- Il faut donc modifier la constante [`API_ENDPOINT`](https://github.com/CFPTI/cm2018-escaperoom/blob/master/monitoring/app.js#L30) dans le fichier `app.js` à la racine pour indiquer le serveur et le répertoire dans le quel se trouve le webdispatcher (ex: `http://192.168.0.20/webdispatcher` sans le `/` à la fin !)

### Sensehat & Piface2
C'est également le tableau de bord qui communique avec le sensehat et le piface2 des raspberry pour afficher le nom des câbles et valider que le branchement soit correcte. Il faut donc :

 - modifier la constante [`SENSEHAT_ENDPOINT`](https://github.com/CFPTI/cm2018-escaperoom/blob/master/monitoring/app.js#L31-L31) afin d'indiquer l'URL complète d'accès au serveur web du sensehat (ex: `http://192.168.0.21` sans le `/` à la fin !)

 - modifier la constante [`PIFACE2_ENDPOINT`](https://github.com/CFPTI/cm2018-escaperoom/blob/master/monitoring/app.js#L32) afin d'indiquer l'URL complète d'accès au serveur web du piface2 (ex: `http://192.168.0.22` sans le `/` à la fin !)
 
 ### Vidéo
 Lorsqu'une nouvelle partie est lancée, la vidéo démarre au même moment. La vidéo est une page HTML avec la vidéo en plein écran.

Il faut donc également indiquer l'adresse du [webdispatcher](https://github.com/CFPTI/cm2018-escaperoom/tree/master/webdispatcher) pour que la vidéo puisse connaître son propre état.

 - Pour cela, il faut modifier la constante [`SERVER_ENDPOINT`](https://github.com/CFPTI/cm2018-escaperoom/blob/master/monitoring/video/index.html#L37) dans le fichier `/video/index.html`  (ex: `http://192.168.0.20/webdispatcher` sans le `/` à la fin !)

 
## Prérequis pour la vidéo / ! \

1.  Se rendre à l'adresse suivante dans chrome : [chrome://flags/#autoplay-policy](chrome://flags/#autoplay-policy)

2.  Définir l'option `Autoplay policy` sur `No user gesture is required`

Cette manipulation est **obligatoire** pour lancer la vidéo automatiquement dans l'escaperoom depuis le tableau de bord (clique nouvelle partie) sans l'accord de l'utilisateur.

Plus d'informations : [https://www.chromium.org/audio-video/autoplay](https://www.chromium.org/audio-video/autoplay)

## Auteur
Valentin Hutter [valh1996](https://github.com/valh1996)