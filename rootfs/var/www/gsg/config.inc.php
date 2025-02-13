<?php
$hostname = "localhost";
$username = "gsg_user";
$password = "gsg_password";
$database = "gsg_db";

// Connexion à MySQL
$conn = new mysqli($hostname, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("<h1 style='color: red;'>❌ ERREUR: Connexion MySQL échouée: " . $conn->connect_error . "</h1>");
}
?>
