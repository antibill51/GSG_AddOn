import paho.mqtt.client as mqtt
import os
import time
import logging

# Configuration des logs
logging.basicConfig(level=logging.INFO, format="%(asctime)s - %(levelname)s - %(message)s")

# Configuration MQTT
MQTT_BROKER = os.getenv("MQTT_HOST", "mqtt_broker")
MQTT_PORT = int(os.getenv("MQTT_PORT", "1883"))
MQTT_USER = os.getenv("MQTT_USER", "mqtt_user")
MQTT_PASSWORD = os.getenv("MQTT_PASSWORD", "mqtt_password")
MQTT_TOPIC_STATUS = "homeassistant/sensor/gsg/status"

# Variable pour suivre l'état de connexion
is_connected = False  

# Création du client MQTT
client_id = "gsg"
client = mqtt.Client(client_id=client_id, protocol=mqtt.MQTTv311, callback_api_version=mqtt.CallbackAPIVersion.VERSION2)
client.enable_logger()

# Authentification MQTT
client.username_pw_set(MQTT_USER, MQTT_PASSWORD)

# Définition du Last Will and Testament (LWT)
client.will_set(MQTT_TOPIC_STATUS, "offline", retain=True)

# Callback en cas de connexion réussie
def on_connect(client, userdata, flags, rc, *args):
    global is_connected
    if rc == 0:
        is_connected = True
        logging.info("Connecté à MQTT !")
    else:
        logging.error(f"Échec de connexion MQTT, code {rc}")

# Callback en cas de déconnexion
def on_disconnect(client, userdata, rc, *args):
    global is_connected
    is_connected = False
    logging.warning(f"Déconnecté de MQTT (code {rc}). Tentative de reconnexion...")
    reconnect()

# Fonction de reconnexion automatique
def reconnect():
    """Essaie de se reconnecter en boucle avec un délai progressif."""
    attempts = 0
    while not is_connected:
        try:
            client.reconnect()
            logging.info("Reconnexion réussie !")
            return
        except Exception as e:
            attempts += 1
            wait_time = min(5 * attempts, 60)  # Augmenter progressivement le délai jusqu'à 60s max
            logging.error(f"Échec de reconnexion ({attempts} tentative(s)) : {e}. Nouvelle tentative dans {wait_time}s...")
            time.sleep(wait_time)

# Attacher les callbacks 
client.on_connect = on_connect
client.on_disconnect = on_disconnect

# Connexion au broker avec gestion des erreurs
try:
    client.connect(MQTT_BROKER, MQTT_PORT, 60)
    client.loop_start()  # Démarrer la gestion du réseau avant de publier

    timeout = 10  # Temps d'attente max en secondes
    start_time = time.time()

    while not is_connected:
        if time.time() - start_time > timeout:
            raise TimeoutError("Échec de connexion MQTT après attente.")
        logging.info("Attente de connexion MQTT...")
        time.sleep(10)

    client.publish(MQTT_TOPIC_STATUS, "online", retain=True)
except Exception as e:
    logging.error(f"Erreur de connexion MQTT : {e}")
    reconnect()
