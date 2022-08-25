# Cités des Métiers 2018 - Escape Room

Ce projet contient tous les fichiers qui ont été créés pour faire fonctionner l'Escape Room du stand Informatique du CFPT à la cité des métiers ayant eu lieu du 20 au 25 novembre 2018.

## But

Le but était de créer un escape game avec 3 énigmes qu'il faut résoudre avant le temps imparti de 15 minutes.

## Contexte

Les joueurs arrivent à l'école d'informatique pour venir s'inscrire, mais les élèves de l'école leur ont joué un tour en leurs disant que les inscriptions se passes dans la cave de l'école. Mais en arrivant à la cave les joueurs, on été piégés et ils doivent sortir de la cave avant la fin du compte à rebours de 15 minutes sinon ils arriveront en retard aux inscriptions.

## Les énigmes

### Première énigme - L'ordinateur

Cette énigme consiste à brancher un ordinateur pour pouvoir l'allumer.
Une fois celui-ci allumé les joueurs devront trouver le mot de passe pour déverrouiller le poste.
Lorsque celui-ci est déverrouiller, les utilisateurs devront trouver le premier code de sortie contenu dans un des fichiers affichés sur le bureau.
Ce code combiné à un autre permettra de débloquer la sortie dès qu'il sera indiqué dans la troisième énigme.

### Deuxième énigme - Le labyrinthe

Cette énigme consiste à indiquer le chemin de sortie à Raichu. Il faut lui donner des instructions sur ce qu'il doit faire pour trouver la sortie, il peut pivoter à gauche ou à droit ou avancer. Dès que Raichu à trouver la sortie, cela affiche la dernière partie du code qu'il faudra Dû fait de dire à Raichu comment trouver la sortie, cela permet de représenter comment la programmation marche du fait de donner des instructions à un programme.

### Troisième énigme - Le code hexadécimal

Lorsque la première et la deuxième énigme sont réussies, les joueurs obtiendront grâce à chaque énigmes un code hexadécimal qui leur sera utile pour accéder à la troisième énigme.
Lorsque le code est erroné les bouttons se désactivent temporairement, 5 secondes de plus à chaque tentatives erronées (exemple, 5s, 10s, 15s, etc..).
Lorsque la combinaison est la bonne ils sont redirigés vers la page d'index qui contient la troisième énigme.
Celle-ci consiste à convertire le code hexadécimal obtenu dans les 2 autres énigmes en code binaire.
Lorsque le code rentré est le bon, une image affichant un message de réussite s'affiche, celui-ci reste affiché un certain temps avant de rediriger les joueurs vers la première page (30-60 secondes à définir, permet d'automatiser pour les prochains joueurs).
