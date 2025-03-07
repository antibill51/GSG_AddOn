# import paho.mqtt.client as mqtt
# import os
# import time
# import uuid
# import logging


# # Configuration MQTT
# MQTT_BROKER = os.getenv("MQTT_HOST", "mqtt_broker")
# MQTT_PORT = int(os.getenv("MQTT_PORT", "1883"))
# MQTT_USER = os.getenv("MQTT_USER", "mqtt_user")
# MQTT_PASSWORD = os.getenv("MQTT_PASSWORD", "mqtt_password")
# MQTT_TOPIC_STATUS = "homeassistant/sensor/gsg/status"


# logging.basicConfig(level=logging.INFO)  # Niveau INFO pour réduire le bruit

# # Variable pour suivre l'état de connexion
# is_connected = False  

# # Création du client MQTT
# client_id = f"gsg_{uuid.uuid4().hex[:8]}"  # Ex: "gsg_a1b2c3d4"
# client = mqtt.Client(client_id=client_id, protocol=mqtt.MQTTv311, callback_api_version=mqtt.CallbackAPIVersion.VERSION2)
# client.enable_logger()

# # client = mqtt.Client(mqtt.CallbackAPIVersion.VERSION2)
# client.username_pw_set(MQTT_USER, MQTT_PASSWORD)

# # Définition du LWT (Last Will and Testament)
# client.will_set(MQTT_TOPIC_STATUS, "offline", retain=True)

# # Callback en cas de connexion réussie
# # def on_connect(client, userdata, flags, rc, *args):
# #     global is_connected
# #     if rc == 0:
# #         is_connected = True
# #         print("Connecté à MQTT !")
# #     else:
# #         print(f"Échec de connexion, code {rc}")
# def on_connect(client, userdata, flags, rc, *args):
#     global is_connected
#     try:
#         if rc == 0:
#             is_connected = True
#             print("Connecté à MQTT !")
#         else:
#             print(f"Échec de connexion, code {rc}")
#     except Exception as e:
#         print(f"Erreur dans on_connect : {e}")


# # Callback appelé en cas de déconnexion
# # def on_disconnect(client, userdata, rc, *args):
# #     """Gestion de la reconnexion automatique."""
# #     global is_connected
# #     is_connected = False
# #     print("Déconnecté de MQTT ! Tentative de reconnexion...")
# #     while True:
# #         try:
# #             client.reconnect()
# #             print("Reconnexion réussie !")
# #             client.publish(MQTT_TOPIC_STATUS, "online", retain=True)
# #             break  # Sort de la boucle une fois reconnecté
# #         except Exception as e:
# #             print(f"Reconnexion échouée : {e}")
# #             time.sleep(5)  # Attendre 5 secondes avant de réessayer

# def on_disconnect(client, userdata, rc, *args):
#     global is_connected
#     is_connected = False
#     print("Déconnecté de MQTT ! Code de retour :", rc)
#     if rc != 0:
#         print("Tentative de reconnexion automatique...")

# # Attacher les callback 
# client.on_connect = on_connect
# client.on_disconnect = on_disconnect

# # Connexion au broker avec gestion des erreurs
# # try:
# #     client.connect(MQTT_BROKER, MQTT_PORT, 300)
# #     client.publish(MQTT_TOPIC_STATUS, "online", retain=True)
# # except Exception as e:
# #     print(f"Erreur de connexion MQTT : {e}")
# #     time.sleep(5)

# try:
#     client.connect(MQTT_BROKER, MQTT_PORT, 60)
#     client.loop_start()  # Démarrer la gestion du réseau avant de publier

#     timeout = 10  # Temps d'attente max en secondes
#     start_time = time.time()

#     while not is_connected:
#         if time.time() - start_time > timeout:
#             raise TimeoutError("Échec de connexion MQTT après attente.")
#         print("Attente de connexion MQTT...")
#         time.sleep(1)

#     client.publish(MQTT_TOPIC_STATUS, "online", retain=True)
# except Exception as e:
#     print(f"Erreur de connexion MQTT : {e}")
#     time.sleep(5)

# # # Démarrer la boucle MQTT en arrière-plan
# # client.loop_start()



import paho.mqtt.client as mqtt
import os
import time
import uuid
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
client_id = f"gsg_{uuid.uuid4().hex[:8]}"  # Ex: "gsg_a1b2c3d4"
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
        time.sleep(1)

    client.publish(MQTT_TOPIC_STATUS, "online", retain=True)
except Exception as e:
    logging.error(f"Erreur de connexion MQTT : {e}")
    reconnect()
