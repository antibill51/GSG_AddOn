# GSG_AddOn for Home Assistant

[![Home Assistant](https://img.shields.io/badge/Home%20Assistant-Addon-blue)](https://www.home-assistant.io/)
[![Version](https://img.shields.io/badge/Version-1.0.1-brightgreen)](https://github.com/antibill51/gsg-addon)
[![License](https://img.shields.io/badge/License-MIT-blue)](LICENSE)

## 🔥 Gestion du Stock de Granulés (GSG) pour Home Assistant

📌 **Addon Home Assistant** permettant la gestion du stock de granulés avec **MQTT et MySQL**.  
🔗 Plus d'infos sur GSG (R.Syrek) : [domotique-home.fr](https://domotique-home.fr/gestion-de-chauffage-stock-de-granules-gsg/)

### 📌 **Améliorations par rapport à la version GSG d'origine**
- **Ajout de la possibilité de créer un nouveau stock** en début d'année `n` pour la saison `n-1/n`. *(1ère installation)*
- **Intégration MQTT** : Communication avec Home Assistant.
- **Paramétrage dynamique** du serveur SQL et MQTT via l'interface de configuration de l'addon.

---

## ⚙️ **Pré-requis**
### 🛠️ **Base de données MySQL/MariaDB**
Cet addon nécessite un **serveur SQL** avec un **utilisateur dédié** ayant les droits sur une base spécifique.  

#### **Exemple de configuration avec l'addon MariaDB :**
Ajoutez ceci dans votre fichier **configuration.yaml** de MariaDB :  
```yaml
databases:
  - gsg
logins:
  - username: gsg
    password: gsg
rights:
  - username: gsg
    database: gsg
```
**⚠️ Note :**  
Les valeurs peuvent être modifiées, mais elles doivent **correspondre à celles configurées dans cet addon**.

### 🛠️ **Serveur MQTT**
Un **broker MQTT** est nécessaire pour remonter les informations dans Home Assistant.  
L'addon a été testé avec **Mosquitto broker**.

---

## 🚀 **Installation**
### 🏠 **Depuis Home Assistant**
1. Allez dans **Paramètres → Add-ons → Ajouter un dépôt**  
2. Entrez l’URL du dépôt GitHub :  
   ```
   https://github.com/antibill51/gsg-addon
   ```
3. Installez l’addon **GSG Gestion Stock Granulés**
4. Configurez **les accès MySQL et MQTT**
5. Activez **Démarrage automatique** et **Afficher dans la barre latérale** (optionnel)
6. Démarrez l’addon 🚀

---

## 🔧 **Configuration de l’addon**
### 🗃️ **Exemple de configuration dans Home Assistant**
Une fois l’addon installé, configurez-le depuis l’interface Home Assistant :  
```yaml
mqtt_host: "core-mosquitto"
mqtt_port: 1883
mqtt_user: "homeassistant"
mqtt_password: "password"
mqtt_delay: "300"
mysql_host: "core-mariadb"
mysql_user: "gsg"
mysql_password: "gsg"
mysql_database: "gsg"
```

---

## 💼 **Intégration Home Assistant**
L'addon utilise **MQTT Discovery** pour enregistrer automatiquement les entités dans Home Assistant.

### 📍 **Entités disponibles**
| Type         | ID MQTT | Description |
|-------------|-------------|-------------|
| Sensor | `sensor.gestion_stock_granules_sacs_restants` | Nombre de sacs restants |
| Sensor | `sensor.gestion_stock_granules_sacs_consommes` | Nombre de sacs consommés |
| Sensor | `sensor.gestion_stock_granules_cout_de_la_consommation` | Coût total de la consommation |
| Sensor | `sensor.gestion_stock_granules_consommation_septembre` → `aout` | Consommation mensuelle |
| Button | `button.gestion_stock_granules_ajouter_un_sac` | Ajout d'un sac |
| Number | `number.gestion_stock_granules_ajouter_x_sacs` | Ajouter plusieurs sacs (1 à 3) |

---

## ⚠️ **Bugs connus**
🐛 **Affichage incorrect de la période avant consommation du 1er sac**  
- Lors de la **création d'un nouveau stock**, la période peut s'afficher de manière incorrecte sur l'interface.  
- **Dès qu'un premier sac est consommé, tout rentre dans l'ordre.**  
- Ce bug vient de **GSG** lui-même et non de cet addon.

---

## 🛠️ **Développement et Contributions**
👨‍💻 **Développeur** : [Antibill51](https://github.com/antibill51)  
💡 **Contributions** : Pull Requests et Issues bienvenues !  
👨‍💻 **GSG** (R.Syrek) : [domotique-home.fr](https://domotique-home.fr/gestion-de-chauffage-stock-de-granules-gsg/)  
💜 **Licence :** [MIT](LICENSE)  
📧 **Contact :** remi.kiragossian@gmail.com  

---

## 🌟 **Support et Remerciements**
💬 **Merci aux contributeurs de la communauté Home Assistant !**  
📢 **Besoin d’aide ?** Ouvrez un ticket sur [GitHub Issues](https://github.com/antibill51/gsg-addon/issues) !

