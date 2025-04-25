<?php

// Récupère les données du formulaire
$nom_utilisateur = $_POST['nom_utilisateur'];
$mdp = $_POST['mdp'];

// Informations de connexion
$servername = 'localhost'; // Adresse serveur
$username = 'root'; 
$password = ''; 
$dbname = 'Formula_One_fantasy_league'; // Nom de base de données

// Crée la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}
echo "Connexion réussie à la base de données";

$conn->close();

?>
