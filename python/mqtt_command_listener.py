from mqtt_client import client
import json
from datetime import datetime
import requests
import os

# Configuration MQTT
MQTT_TOPIC_COMMAND = "homeassistant/sensor/gsg/command"
MQTT_TOPIC = "homeassistant/sensor/gsg"

# Callback lors de la réception d'un message MQTT
def on_message(client, userdata, msg):
    try:
        payload = json.loads(msg.payload.decode("utf-8"))
        if payload.get("action"):  # Vérifie si une commande d'action est envoyée
            action = payload.get("action")
            if action == "ajouter_sac":
                ajouter_sac()
            elif action == "ajouter_x_sacs":
                ajouter_x_sacs(payload.get("value", 1))
            elif action == "maj_entretien":
                maj_entretien(payload.get("type", 1))
            client.publish(f"{MQTT_TOPIC}/refresh", json.dumps({"refresh": True}), retain=False)

    except Exception as e:
        print(f"Erreur traitement MQTT: {e}")

def ajouter_sac():
    url = f"http://127.0.0.1:9541/data_granulee.php?value=1"
    try:
        response = requests.get(url, verify=False)  # `verify=False` pour ignorer les erreurs SSL
        if response.status_code == 200:
            print("Un sac ajouté avec succès")
            # client.publish(f"{MQTT_TOPIC}/command", json.dumps({"refresh": True}), retain=False)
        else:
            print(f"Erreur lors de l'ajout du sac: {response.status_code} - {response.text}")
    except requests.exceptions.RequestException as e:
        print(f"Erreur de connexion: {e}")

def ajouter_x_sacs(nombre):
    try:
        nombre = int(nombre)
        for _ in range(nombre):
            ajouter_sac()
            # time.sleep(0.5)
        print(f"{nombre} sacs ajoutés")
        # client.publish(f"{MQTT_TOPIC}/ajouter_x_sacs/state", json.dumps({"value": 0}), retain=True)
        # time.sleep(1)  # Ajout d'un délai de 1s
        # client.publish(f"{MQTT_TOPIC}/command", json.dumps({"refresh": True}), retain=False)

    except ValueError:
        print("Valeur invalide pour ajouter_x_sacs")


# Fonction pour mettre à jour la date d'entretien
def maj_entretien(type_entretien):
    url = f"http://127.0.0.1:9541/data_granulee.php?value=" + str(1 + int(type_entretien))
    try:
        response = requests.get(url, verify=False)  # `verify=False` pour ignorer les erreurs SSL
        if response.status_code == 200:
            print(f"Entretien {type_entretien} mis à jour")
            # client.publish(f"{MQTT_TOPIC}/command", json.dumps({"refresh": True}), retain=False)

        else:
            print(f"Erreur lors de l'ajout du sac: {response.status_code} - {response.text}")
    except requests.exceptions.RequestException as e:
        print(f"Erreur de connexion: {e}")

def start_command_listener():
    """S'abonne au topic de commande et attache le callback."""
    client.subscribe(MQTT_TOPIC_COMMAND)
    # Note: on_message sera attaché à un autre topic dans mqtt_sensors.py
    # Paho-MQTT ne supporte qu'un seul on_message global.
    # Nous allons donc créer un dispatcher dans mqtt_sensors.py
    print("Prêt à recevoir des commandes MQTT...")
