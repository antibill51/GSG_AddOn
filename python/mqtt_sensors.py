from mqtt_client import client, is_connected
import json
import time
import os
import requests
from datetime import datetime
import threading

# Configuration MQTT
MQTT_TOPIC = "homeassistant/sensor/gsg"

# Lire les paramètres depuis les variables d’environnement
MQTT_DELAY = int(os.getenv("MQTT_DELAY", "mqtt_delay"))


# Attendre que la connexion soit établie
while not is_connected:
    print("SENSORS En attente de la connexion MQTT...")
    time.sleep(10)

print("Connexion MQTT établie, démarrage du script SENSORS...")

def get_data():
    try:
        response = requests.get("http://127.0.0.1:9541/json.php?json=1", timeout=5)
        response.raise_for_status()
        data = response.json()
        # print("Données récupérées:", data)  # Debugging

        sacs_restants = int(data.get("NbrSacRestant", 0))
        sacs_consommes = int(data.get("NbrSacConso", 0))
        prix_sac = float(data.get("PrixSac", 0))
        cout_conso = float(data.get("CoutConsome", 0))

        current_year = datetime.now().year
        previous_year = current_year - 1
        heating_years = (previous_year, current_year) if datetime.now().month < 9 else (current_year, current_year + 1)

        consommation_mensuelle = {}
        month_mapping = {
            "Janvier": 1, "Fevrier": 2, "Mars": 3, "Avril": 4, "Mai": 5, "Juin": 6,
            "Juillet": 7, "Aout": 8, "Septembre": 9, "Octobre": 10, "Novembre": 11, "Decembre": 12
        }

        for key, value in data.items():
            for year in heating_years:
                if str(year) in key:
                    month_name = key.split()[0]
                    month_number = month_mapping.get(month_name.capitalize())
                    if month_number:
                        consommation_mensuelle[month_number] = int(value)

        return {
            "sacs_restants": sacs_restants,
            "sacs_consommes": sacs_consommes,
            "cout_conso": cout_conso,
            "consommation_mensuelle": consommation_mensuelle
        }

    except requests.RequestException as e:
        print(f"Erreur lors de la récupération des données: {e}")
        return None


def publish_sensors():
    """Publie toutes les valeurs des sensors immédiatement."""
    data = get_data()
    if data:
        client.publish(f"{MQTT_TOPIC}/ajouter_x_sacs", str(0), retain=False)
        client.publish(f"{MQTT_TOPIC}/sacs_restants", str(data["sacs_restants"]), retain=False)
        client.publish(f"{MQTT_TOPIC}/sacs_consommes", str(data["sacs_consommes"]), retain=False)
        client.publish(f"{MQTT_TOPIC}/cout_conso", str(round(data["cout_conso"], 2)), retain=False)

        for mois, valeur in data["consommation_mensuelle"].items():
            client.publish(f"{MQTT_TOPIC}/mois_{mois:02d}", str(valeur), retain=False)

    
# Callback pour recevoir les messages MQTT
def on_message(client, userdata, msg):
    try:
        payload = json.loads(msg.payload.decode("utf-8"))
        if payload.get("refresh"):  # Vérifie si une commande de rafraîchissement est envoyée
            print("Commande de rafraîchissement reçue. Mise à jour immédiate des capteurs.")
            publish_sensors()
    except json.JSONDecodeError:
        print(f"Message MQTT non reconnu : {msg.payload.decode('utf-8')}")



# Abonnement aux commandes
client.subscribe(f"{MQTT_TOPIC}/refresh")
client.subscribe("homeassistant/status")
client.on_message = on_message

def periodic_update():
    """Exécute publish_sensors() périodiquement sans bloquer MQTT."""
    publish_sensors()
    threading.Timer(MQTT_DELAY, periodic_update).start()  # Relance après MQTT_DELAY secondes

# Démarrer la mise à jour périodique sans bloquer MQTT
periodic_update()
