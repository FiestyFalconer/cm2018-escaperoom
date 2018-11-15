# Configuration d'apache pour l'exécution des scripts python

Par défaut l'utilisateur d’exécution d'apache est **_www-data_**, ce qui pose un problème lors de l’exécution des scripts **_Python_**.
Pour corriger ce problème, il faut que Apache ait les droits équivalents à l'utilisateur **_pi_** afin d'avoir les droits nécessaires.

Pour changer l'utilisateur par défaut, il faut se rendre dans le fichier **_envvars_** qui est présent dans le dossier **_/etc/apache2/_**.

Une fois dans ce fichier, il faut éditer les lignes suivantes :

```conf
export APACHE_RUN_USER=www-data
export APACHE_RUN_GROUP=www-data
```

Par :

```conf
export APACHE_RUN_USER=pi
export APACHE_RUN_GROUP=pi
```

Une fois les lignes éditées, il suffit de sauvegarder et quitter et ensuite redémarrer apache avec la commande :

```bash
sudo service apache2 restart
```
