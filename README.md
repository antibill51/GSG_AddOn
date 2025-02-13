# GSG_AddOn for Home Assistant

https://domotique-home.fr/gestion-de-chauffage-stock-de-granules-gsg/

Par rapport à la version GSG d'origine, ajout de la possibilité de créer un nouveau stock en début d'année n pour la saison n-1/n. 
(1ere installation)

Cet Addon a besoin d'un serveur SQL sur lequel un utilisateur spécifique est créé, associé a une base de donnée dédiée sur laquelle l'utilisateur a bien les droits nécessaire. 

Exemple avec l'addon mariadb : 
A rajouter dans chaque section de la configuration actuelle : 
databases:
  - gsg
logins:
  - password: gsg
    username: gsg
rights:
  - database: gsg
    username: gsg

Les valeurs peuvent être modifiées, mais doivent bien être identiques à celles renseignées sur cet addon.

Un petit bug persiste, entre la création d'un stock et la consommation du 1er sac, la période s'affiche mal dans le menu déroulant. 
Au 1er sac consommé, tout rentre dans l'ordre. 
Ce bug est lié à GSG, et pas à cet addon.


Exemple de configuration pour communiquer avec home assistant : (l'IP est celle de home assistant, le port celui paramétré dans l'addon, par defaut 9541)
sensor:
  - platform: rest
    resource: http://IP:PORT/json.php?json=1
    name: Sacs restants
    value_template: "{{ value_json.NbrSacRestant }}"
    scan_interval: 3600

command_line:
  switch:
    name: rajout 1 sac
    command_on: curl -k "http://IP:PORT/data_granulee.php?value=1"
