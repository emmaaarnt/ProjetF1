<?php
// Connexion à la base de données
$servername = "localhost"; // Serveur Local XAMPP
$username = "root";
$password = "";
$dbname = "Formula_One_fantasy_league";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    throw new Exception("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pays = $_POST['pays'];
    $ville = $_POST['ville'];
    $date_naissance = $_POST['date_naissance'];
    $tel = $_POST['tel'];
    $rue = $_POST['rue'];
    $numero = $_POST['numero'];
    $code_postal = $_POST['code_postal'];
    $pseudo = $_POST['pseudo'];
    $mot_de_passe = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // coversion date de naissance en fragment 
    // Extraire le jour
    $jour = date("d", strtotime($date_naissance));

    // Extraire le mois
    $mois = date("m", strtotime($date_naissance));

    // Extraire l'année
    $annee = date("Y", strtotime($date_naissance));

    // Préparer et exécuter la requête SQL
    $sql = "INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, email, pays, ville, jour_naissance_utilisateur, mois_naissance_utilisateur, annee_naissance_utilisateur, Tel_utilisateur, nomrue, numrue, code_postal, id_utilisateur, mdp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Erreur de préparation : " . $conn->error);
    }

    $stmt->bind_param("sssssiiissssss", $nom, $prenom, $email, $pays, $ville, $jour, $mois, $annee, $tel, $Rue,$Numero, $code_postal, $pseudo, $mot_de_passe);

    if ($stmt->execute()) {
        echo "Inscription réussie!";
    } else {
        echo "Erreur lors de l'inscription : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
