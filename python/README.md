# Scripts python pour le SenseHat et le Piface2

## Contexte

Le but était de créer 3 scripts python permettant de gèrer la première énigme de l'escape game.

## Matériel utilisé

- Raspberry Pi 3 - 2x
- Piface Digital 2 - 1x
- SenseHat - 1x
- Différents cables
- Un boitier PC
- Un peu d'électronique pour brancher la masse des câbles sur le Piface

## Les scripts

### Script de détection de câbles : [**_cables_detector.py_**](https://github.com/CFPTI/cm2018-escaperoom/blob/master/python/cables_detector.py)

Ce script permet de détecter si les 3 câbles indiqués en paramètres sont brancher. Au début le script va désactiver un relais qui empechera le courant d'alimenter l'écran affichant la deuxième énigme. Puis le script va attendre que les 3 câbles soient branchés. Une fois cette étape reussi le script va faire un appel sur un fichier php dénommer **_step1.php_** sur le [**webdispatcher**](https://github.com/CFPTI/cm2018-escaperoom/tree/master/webdispatcher), puis il activera le relais ce qui permettra d'allumer l'écran de la deuxième énigme.

> Ce script se trouve sur le Raspberry Pi ayant le Piface

### Script d'affichage N°1 : [**_sensehat_message.py_**](https://github.com/CFPTI/cm2018-escaperoom/blob/master/python/sensehat_message.py)

Ce script permet d'afficher un message sur le SenseHat, il est utilisé pour afficher les noms des câbles qu'il faut brancher.

> Ce script se trouve sur le Raspberry Pi ayant le SenseHat

### Script d'affichage N°2 : [**_sensehat_letter.py_**](https://github.com/CFPTI/cm2018-escaperoom/blob/master/python/sensehat_letter.py)

Ce script permet d'afficher une lettre sur le SenseHat, il est utilisé pour afficher le code de la première étape après que tous les câbles aient été branchés.

> Ce script se trouve sur le Raspberry Pi ayant le SenseHat

## Auteur

**Miguel Lopes Borges** [(miguellpsbr)](https://github.com/miguellpsbr)
