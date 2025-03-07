from mqtt_client import client, is_connected
# import paho.mqtt.client as mqtt
import json
import os
import time
import requests


# Configuration MQTT
MQTT_TOPIC = "homeassistant/sensor/gsg"
LWT_TOPIC = "homeassistant/sensor/gsg/status"

MQTT_DELAY = int(os.getenv("MQTT_DELAY", "mqtt_delay"))


# Attendre que la connexion soit établie
while not is_connected:
    print("AUTODISCOVERY En attente de la connexion MQTT...")
    time.sleep(10)

print("Connexion MQTT établie, démarrage du script AUTODISCOVERY...")

# Récupération du SUPERVISOR_TOKEN pour interroger l'API Home Assistant
SUPERVISOR_TOKEN = os.getenv("SUPERVISOR_TOKEN")
ADDON_ID = None
HASS_URL = None

if SUPERVISOR_TOKEN:
    headers = {"Authorization": f"Bearer {SUPERVISOR_TOKEN}", "Content-Type": "application/json"}
    try:
        # Récupérer l'addon_id
        response = requests.get("http://supervisor/addons/self/info", headers=headers, timeout=5)
        if response.status_code == 200:
            data = response.json()
            ADDON_ID = data.get("data", {}).get("slug")  # L'addon ID correspond au "slug"

        # Récupérer l'URL de Home Assistant
        response = requests.get("http://supervisor/core/info", headers=headers, timeout=5)
        if response.status_code == 200:
            data = response.json()
            HASS_URL = data.get("data", {}).get("external_url") or data.get("data", {}).get("internal_url")
            if HASS_URL:
                HASS_URL = HASS_URL.rstrip("/")  # Supprime le "/" final pour éviter les doubles slashs

    except requests.RequestException as e:
        print(f"Erreur lors de la récupération des informations Supervisor : {e}")

# Construire l'URL Ingress avec l'URL correcte
CONFIGURATION_URL = f"{HASS_URL}/hassio/ingress/{ADDON_ID}/" if HASS_URL and ADDON_ID else None

# Liste des capteurs
sensors = {
    "sacs_restants": {
        "name": "Sacs Restants",
        "unit_of_measurement": "sac(s)",
        "icon": "mdi:bag-suitcase"
    },
    "sacs_consommes": {
        "name": "Sacs Consommés",
        "unit_of_measurement": "sac(s)",
        "icon": "mdi:fire"
    },
    "cout_conso": {
        "name": "Coût de la Consommation",
        "unit_of_measurement": "€",
        "icon": "mdi:currency-eur"
    }
}


# Dictionnaire de correspondance des mois en français
mois_noms = {
    1: "Janvier", 2: "Février", 3: "Mars", 4: "Avril",
    5: "Mai", 6: "Juin", 7: "Juillet", 8: "Août",
    9: "Septembre", 10: "Octobre", 11: "Novembre", 12: "Décembre"
}

# Ajout des consommations mensuelles avec le nom du mois en français
for mois in range(1, 13):
    sensors[f"mois_{mois:02d}"] = {
        "name": f"Consommation {mois_noms[mois]}",
        "unit_of_measurement": "sac(s)",
        "icon": "mdi:calendar"
    }

# Liste des commandes
commands = {
    "ajouter_sac": {
        "name": "Ajouter un Sac",
        "icon": "mdi:plus-box",
        "command_topic": f"{MQTT_TOPIC}/command",
        "payload_press": '{"action": "ajouter_sac"}'
    # },
    # "maj_entretien_1": {
    #     "name": "Mise à Jour Entretien régulier",
    #     "command_topic": f"{MQTT_TOPIC}/command",
    #     "payload_press": '{"action": "maj_entretien", "type": 1}',
    #     "icon": "mdi:calendar-refresh"
    # },
    # "maj_entretien_2": {
    #     "name": "Mise à Jour Entretien mensuel",
    #     "command_topic": f"{MQTT_TOPIC}/command",
    #     "payload_press": '{"action": "maj_entretien", "type": 2}',
    #     "icon": "mdi:calendar-refresh"
    # },
    # "maj_entretien_3": {
    #     "name": "Mise à Jour Entretien annuel",
    #     "command_topic": f"{MQTT_TOPIC}/command",
    #     "payload_press": '{"action": "maj_entretien", "type": 3}',
    #     "icon": "mdi:calendar-refresh"
    }
}

# Définition du `number` pour "ajouter X sacs"
number_entities = {
    "ajouter_x_sacs": {
        "name": "Ajouter X Sacs",
        "command_topic": f"{MQTT_TOPIC}/command",
        "state_topic": f"{MQTT_TOPIC}/ajouter_x_sacs",
        "cmd_tpl": '{"action": "ajouter_x_sacs", "value": {{value}}}',
        "min": 0,
        "max": 3,
        "step": 1,
        "mode": "slider",
        "icon": "mdi:plus-multiple"
    }
}

# Publication des capteurs MQTT Discovery
for sensor_id, sensor_info in sensors.items():
    discovery_payload = {
        "name": sensor_info["name"],
        "state_topic": f"{MQTT_TOPIC}/{sensor_id}",
        "unique_id": f"gsg_{sensor_id}",
        "device": {
            "name": "Gestion Stock Granulés",
            "identifiers": ["gsg"],
            "manufacturer": "R.Syrek/Antibill51",
            "model": "GSG"
        },
        "availability_topic": LWT_TOPIC,  # Ajout de l'availability topic
        "expire_after": (MQTT_DELAY + 60)  # L'entité devient "unavailable" après MQTT_DELAY + 1 minute sans mise à jour
    }
    
    if "unit_of_measurement" in sensor_info:
        discovery_payload["unit_of_measurement"] = sensor_info["unit_of_measurement"]
    
    if "icon" in sensor_info:
        discovery_payload["icon"] = sensor_info["icon"]

    # Ajouter l'URL de configuration seulement si l'ID est récupéré
    if CONFIGURATION_URL:
        discovery_payload["device"]["configuration_url"] = CONFIGURATION_URL

    client.publish(f"homeassistant/sensor/gsg_{sensor_id}/config", json.dumps(discovery_payload), retain=True)

# Publication des commandes MQTT Discovery
for command_id, command_info in commands.items():
    discovery_payload = {
        "name": command_info["name"],
        "command_topic": command_info["command_topic"],
        "unique_id": f"gsg_{command_id}",
        "device": {
            "name": "Gestion Stock Granulés",
            "identifiers": ["gsg"],
            "manufacturer": "R.Syrek/Antibill51",
            "model": "GSG"
        },
        "icon": command_info["icon"],
        "payload_press": command_info["payload_press"],
        "availability_topic": LWT_TOPIC  # Ajout de l'availability topic
    }

    # Ajouter l'URL de configuration seulement si l'ID est récupéré
    if CONFIGURATION_URL:
        discovery_payload["device"]["configuration_url"] = CONFIGURATION_URL


    client.publish(f"homeassistant/button/gsg_{command_id}/config", json.dumps(discovery_payload), retain=True)

# Publication du `number` MQTT Discovery pour "ajouter X sacs"
for number_id, number_info in number_entities.items():
    discovery_payload = {
        "name": number_info["name"],
        "command_topic": number_info["command_topic"],
        "state_topic": number_info["state_topic"],
        "cmd_tpl": number_info["cmd_tpl"],
        "unique_id": f"gsg_{number_id}",
        "device": {
            "name": "Gestion Stock Granulés",
            "identifiers": ["gsg"],
            "manufacturer": "R.Syrek/Antibill51",
            "model": "GSG"
        },
        "min": number_info["min"],
        "max": number_info["max"],
        "step": number_info["step"],
        "mode": number_info["mode"],
        "icon": number_info["icon"],
        "availability_topic": LWT_TOPIC,  # Ajout de l'availability topic
        "optimistic": True
    }

    # Ajouter l'URL de configuration seulement si l'ID est récupéré
    if CONFIGURATION_URL:
        discovery_payload["device"]["configuration_url"] = CONFIGURATION_URL

    client.publish(f"homeassistant/number/gsg_{number_id}/config", json.dumps(discovery_payload), retain=True)

# Publier que l'addon est en ligne
print("Autodiscovery MQTT publié")