import time
import threading
from mqtt_client import client, MQTT_TOPIC_STATUS
from mqtt_autodiscovery import publish_discovery_payloads
from mqtt_command_listener import start_command_listener, MQTT_TOPIC_COMMAND
from mqtt_sensors import periodic_update, publish_sensors, setup_subscriptions

def on_connect(client, userdata, flags, rc, *args):
    """Callback de connexion, lance les opérations post-connexion."""
    if rc == 0:
        print("Connecté à MQTT !")
        client.publish(MQTT_TOPIC_STATUS, "online", retain=True)
        
        # 1. Publier les configurations d'autodiscovery
        print("Publication des configurations MQTT Autodiscovery...")
        publish_discovery_payloads()

        # 2. Démarrer l'écoute des commandes MQTT
        print("Démarrage de l'écoute des commandes MQTT...")
        start_command_listener()

        # 2b. Démarrer l'écoute des autres topics (refresh, status HA)
        print("Démarrage de l'écoute des topics de statut et de rafraîchissement...")
        setup_subscriptions()

        # 3. Lancer la mise à jour périodique des capteurs dans un thread séparé
        print("Lancement de la mise à jour périodique des capteurs...")
        update_thread = threading.Thread(target=periodic_update, daemon=True)
        update_thread.start()

        # Publier une première fois les valeurs
        publish_sensors()
        print("Tous les services Python sont démarrés.")
    else:
        print(f"Échec de connexion, code {rc}")

def on_disconnect(client, userdata, rc, *args):
    """Callback de déconnexion."""
    print(f"Déconnecté de MQTT avec le code {rc}. Le client tentera de se reconnecter automatiquement.")

def main():
    """Point d'entrée principal pour les opérations MQTT."""
    print("Démarrage du script principal de l'add-on GSG...")

    client.on_connect = on_connect
    client.on_disconnect = on_disconnect

    try:
        # La connexion et la boucle sont gérées par Paho-MQTT en arrière-plan
        client.connect(client._host, client._port, 60)
        client.loop_forever()
    except Exception as e:
        print(f"Erreur de connexion MQTT : {e}")
        time.sleep(5)

if __name__ == "__main__":
    main()