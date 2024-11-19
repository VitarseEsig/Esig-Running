<?php
// Inclure la configuration pour se connecter à la base de données
session_start();

require_once("param.inc.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    echo("Vous devez être connecté pour vous inscrire à un entraînement.");
    header("Refresh: 5; url=compte.php");
}

// Vérifier si l'ID de l'entraînement est fourni via POST
if (!isset($_POST['id_entrainement_choisi']) || empty($_POST['id_entrainement_choisi'])) {
    echo("L'ID de l'entraînement est requis.");
    header("Refresh: 5; url=compte.php");
}

// Récupérer l'ID utilisateur depuis la session et l'ID de l'entraînement depuis POST
$user_id = (int) $_SESSION['id_utilisateur'];
$id_entrainement = (int) $_POST['id_entrainement_choisi'];

// Connexion à la base de données avec MySQLi
$conn = new mysqli($host, $login, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    echo("Erreur de connexion : " . $conn->connect_error);
    header("Refresh: 5; url=compte.php");
}

// Vérifier si l'utilisateur est déjà inscrit à cet entraînement
$sql_check = "SELECT COUNT(*) AS count FROM Inscription WHERE utilisateur_id = ? AND entrainement_id = ?";
$stmt_check = $conn->prepare($sql_check);
if (!$stmt_check) {
    echo("Erreur de préparation de la requête : " . $conn->error);
    header("Refresh: 5; url=compte.php");
}
$stmt_check->bind_param("ii", $user_id, $id_entrainement);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$row_check = $result_check->fetch_assoc();

if ($row_check['count'] > 0) {
    echo("Vous êtes déjà inscrit à cet entraînement.");
    header("Refresh: 5; url=compte.php");
}
$stmt_check->close();

// Insérer une nouvelle inscription
$sql_insert = "INSERT INTO Inscription (utilisateur_id, entrainement_id) VALUES (?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
if (!$stmt_insert) {
    echo("Erreur de préparation de la requête d'insertion : " . $conn->error);
    header("Refresh: 5; url=compte.php");
}
$stmt_insert->bind_param("ii", $user_id, $id_entrainement);

// Exécuter la requête d'insertion
if ($stmt_insert->execute()) {
    echo "Inscription réussie !";
    header("Refresh: 5; url=compte.php");
} else {
    echo "Erreur lors de l'inscription : " . $stmt_insert->error;
    header("Refresh: 5; url=compte.php");
}

// Fermer la connexion
$stmt_insert->close();
$conn->close();


?>