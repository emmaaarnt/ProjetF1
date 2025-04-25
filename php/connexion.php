<?php

// Informations de connexion
$servername = "localhost"; // Adresse serveur
$username = "votre_nom_utilisateur"; 
$password = "votre_mot_de_passe"; 
$dbname = "Formula_One_fantasy_league"; // Nom de base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}
echo "Connexion réussie à la base de données";

$conn->close();

?>