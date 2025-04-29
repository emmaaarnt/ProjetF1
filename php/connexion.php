<?php

// Pour verifier si j'ai des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // ouverture de la session 

// Connexion sur la base de donnée 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Formula_One_fantasy_league";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    throw new Exception("Connexion échouée: " . $conn->connect_error);
}

// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pseudo']) && isset($_POST['password'])) {
        $pseudo = $_POST['pseudo'];
        $mot_de_passe = $_POST['password'];
        // Accède à ma base de donnée pour verifier les informations d'authentification 
        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
        $stmt->bind_param("s", $pseudo);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifie si le mot de passe est haché 
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // si oui le reconvertie en mdp de base saisie par utilisateur  verifie  et se connecte si OK 
            if (password_verify($mot_de_passe, $row['mdp'])) {
                $_SESSION['pseudo'] = $pseudo;
                echo "<script>alert('Connexion réussie !'); window.location.href='../html/accueil.html';</script>";
                //exit;
            } else {
                echo "<script>alert('Mot de passe incorrect !');</script>";
            }
        } else {
            echo "<script>alert('Nom d\'utilisateur incorrect.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Veuillez remplir tous les champs.');</script>";
    }
}

$conn->close();
?>