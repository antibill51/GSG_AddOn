import paho.mqtt.client as mqtt
import os
import time

# Configuration MQTT
MQTT_BROKER = os.getenv("MQTT_HOST", "mqtt_broker")
MQTT_PORT = int(os.getenv("MQTT_PORT", "1883"))
MQTT_USER = os.getenv("MQTT_USER", "mqtt_user")
MQTT_PASSWORD = os.getenv("MQTT_PASSWORD", "mqtt_password")
MQTT_TOPIC_STATUS = "homeassistant/sensor/gsg/status"

# Création du client MQTT
client = mqtt.Client(mqtt.CallbackAPIVersion.VERSION2)
client.username_pw_set(MQTT_USER, MQTT_PASSWORD)

# Définition du LWT (Last Will and Testament)
client.will_set(MQTT_TOPIC_STATUS, "offline", retain=True)

# Callback appelé en cas de déconnexion
def on_disconnect(client, userdata, rc):
    """Gestion de la reconnexion automatique."""
    print("Déconnecté de MQTT ! Tentative de reconnexion...")
    while True:
        try:
            client.reconnect()
            print("Reconnexion réussie !")
            client.publish(MQTT_TOPIC_STATUS, "online", retain=True)
            break  # Sort de la boucle une fois reconnecté
        except Exception as e:
            print(f"Reconnexion échouée : {e}")
            time.sleep(5)  # Attendre 5 secondes avant de réessayer

# Attacher le callback de déconnexion
client.on_disconnect = on_disconnect

# Connexion au broker avec gestion des erreurs
try:
    client.connect(MQTT_BROKER, MQTT_PORT, 60)
    client.publish(MQTT_TOPIC_STATUS, "online", retain=True)
except Exception as e:
    print(f"Erreur de connexion MQTT : {e}")
    time.sleep(5)

# Démarrer la boucle MQTT en arrière-plan
client.loop_start()
