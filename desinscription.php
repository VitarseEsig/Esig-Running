<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php"); // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    exit();
}

// Vérifier si l'ID de l'entraînement a été passé par POST
if (isset($_POST['id_entrainement'])) {
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $id_entrainement = $_POST['id_entrainement'];

    // Paramètres de connexion à la base de données
    require_once("param.inc.php");

    // Créer la connexion à la base de données
    $conn = new mysqli($host, $login, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    // Préparer la requête de désinscription
    $sql = "DELETE FROM Inscription WHERE utilisateur_id = ? AND entrainement_id = ?";

    // Préparer la requête
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }

    // Lier les paramètres et exécuter la requête
    $stmt->bind_param("ii", $id_utilisateur, $id_entrainement);
    $stmt->execute();

    // Vérifier si la désinscription a réussi
    if ($stmt->affected_rows > 0) {
        // Rediriger l'utilisateur vers la page de confirmation ou tableau de bord
        header("Location: compte.php?message=Desinscription réussie");
    } else {
        // Rediriger l'utilisateur vers la page de tableau de bord avec un message d'erreur
        header("Location: compte.php?message=Erreur lors de la désinscription");
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
} else {
    // Si l'ID de l'entraînement n'est pas fourni, rediriger
    header("Location: compte.php?message=Paramètre manquant");
    exit();
}
?>
