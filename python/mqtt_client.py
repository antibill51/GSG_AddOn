import paho.mqtt.client as mqtt
import os
import time

# Configuration MQTT
MQTT_HOST = os.getenv("MQTT_HOST", "core-mosquitto")
MQTT_PORT = int(os.getenv("MQTT_PORT", "1883"))
MQTT_USER = os.getenv("MQTT_USER", "homeassistant")
MQTT_PASSWORD = os.getenv("MQTT_PASSWORD", "")
MQTT_TOPIC_STATUS = "homeassistant/sensor/gsg/status"

# Création du client MQTT
client = mqtt.Client(mqtt.CallbackAPIVersion.VERSION2)
client.username_pw_set(MQTT_USER, MQTT_PASSWORD)

# Stocker les infos de connexion pour une reconnexion facile
client._host = MQTT_HOST
client._port = MQTT_PORT

# Définition du LWT (Last Will and Testament)
client.will_set(MQTT_TOPIC_STATUS, "offline", retain=True)

# La connexion et la boucle sont maintenant gérées dans main.py
