# Web Dispatcher

## Prérequis

- Un serveur apache (exemple: [laragon](https://laragon.org/), [easyPhp](http://www.easyphp.org/))
- Une base de données MySql

## Installation

- Créer la base de données avec l'aide du script [SQL installation script](database.sql)
- Modifier les informations concernant la connexion à la base de données dans les constantes du fichier [pdo.php](pdo.php)

```php
DEFINE('DB_HOST', "127.0.0.1");
DEFINE('DB_NAME', "escapegame");
DEFINE('DB_USER', "root");
DEFINE('DB_PASS', "raspberry");
```

- Modifier les adresses IP et les ports des raspberrys utilisés pour l'escaperoom sur la page [soluce.php](soluce.php) à la ligne (31-33) pour avoir connaissance si les raspberrys sont bien connectés sur le réseau

```php
$master = ping('192.168.123.242', 80, 1);
$sensehat = ping('192.168.123.241', 80, 1);
$piface = ping('192.168.123.240', 80, 1);
$laby = ping('192.168.123.241', 80, 1);
```

- Ajouter les fichiers PHP sur le serveur WEB

## Utilisation

Le webdispatcher permet de gérer l'escaperoom, puisqu'il donne toutes les données concernant la partie en cours sur la page [soluce.php](soluce.php) et pour avoir la connaissance de l'état de la vidéo de présentation sur la page [video.php](video.php).

## Récuperation des données

### soluce.php

Exemple du json retourné par soluce.php

```json
{
  "idGame": "1",
  "idCable1": "5",
  "nameCable1": "USB",
  "idCable2": "1",
  "nameCable2": "VGA",
  "idCable3": "3",
  "nameCable3": "HDMI",
  "soluce1": "8",
  "soluce2": "0",
  "start": "2018-11-14 00:00:00",
  "step1": "2018-11-14 00:05:00",
  "step2": "2018-11-14 00:10:00",
  "end": "2018-11-14 00:15:00",
  "success": "1",
  "master_up": 1,
  "sensehat_up": 1,
  "piface_up": 1,
  "laby_up": 1,
  "binary": "10000000"
}
```

### video.php

#### Modifier l'état de la vidéo

Pour lancer la vidéo, il faut envoyer une requête à la page [video.php](video.php) avec un paramètre `1` ou `0` exemple **video.php?play=1** et attendre la réponse en json :

```json
{ "status": true, "isVideoPlayed": "1" }
```

ou

```json
{ "status": true, "isVideoPlayed": "0" }
```

#### Récupérer les informations sur la vidéo

Pour avoir l'information sur l'état de la vidéo, il suffit d'envoyer une requête sur cette page sans paramètre et elle retournera `1` si la vidéo est en cours de lecture ou `0` si la vidéo n'est pas lancée.

### index.php

Cette page permet d'avoir une vision globale de l'état de la partie actuelle, elle ne doit pas être utilisée pour la production

## Lancement d'une partie

Pour commencer une nouvelle partie, il faut envoyé une requête sur la page [**start.php**](start.php). Cette page doit retourner un json contenant :

```json
"game started"
```

## Validation d'étapes

Pour valider une étape, il faut également envoyé une requête à une page :

- Pour l'étape 1: il faut envoyer une requête sur la page [**step1.php**](step1.php) et attendre la réponse en json

```json
"step1 validated"
```

- Pour l'étape 2: il faut envoyer une requête sur la page [**step2.php**](step2.php) et attendre la réponse en json

```json
"step2 validated"
```

- Pour l'étape 3: il faut envoyer une requête sur la page [**end.php**](end.php) et attendre la réponse en json

```json
"game finished"
```

## Abandonner une partie

Pour abandonner la partie en cours, il faut envoyer une requête sur la page [**giveup.php**](giveup.php) et attendre la réponse en json

```json
"game over"
```

## Auteur

**Guillaume Pin** [(pinginfo)](https://github.com/pinginfo)
