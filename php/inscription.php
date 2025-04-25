
<?php
// Connexion à la base de données
$servername = "localhost"; // Serveur Local Xmanpp
$username = " "; // 
$password = " "; // 
$dbname = "Formula_One_fantasy_league";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$pays = $_POST['pays'];
$ville = $_POST['ville'];
$age = $_POST['age'];
$tel = $_POST['tel'];
$code_postal = $_POST['code_postal'];
$pseudo = $_POST['pseudo'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hash le mot de passe

// Préparer et exécuter la requête SQL
$sql = "INSERT INTO utilisateurs (nom, prenom, email, pays, ville, age, tel, code_postal, pseudo, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssss", $nom, $prenom, $email, $pays, $ville, $age, $tel, $code_postal, $pseudo, $mot_de_passe);

if ($stmt->execute()) {
    echo "Inscription réussie!";
} else {
    echo "Erreur: " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
