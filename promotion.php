<?php
// Paramètres de connexion à la base de données
session_start();
require_once("param.inc.php"); 
// Création de la connexion avec mysqli
$conn = new mysqli($host,$login,$password,$dbname);
$conn->set_charset('utf8mb4');

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Initialisation du message de retour
date_default_timezone_set('Europe/Paris');

$message = '';
$id_utilisateur = $_POST['id_utilisateur_a_promouvoir'];
$role = "membre_association";


$stmt = $conn->prepare( "UPDATE utilisateur SET role = ? WHERE id_utilisateur = ?");
if ($stmt === false) {
    echo "probleme";
    die('Erreur de préparation de la requête : ' . $conn->error); // Afficher l'erreur de préparation
}
$stmt->bind_param("si",$role,$id_utilisateur);

if($stmt->execute()){
    $_SESSION['messagePromotion'] = "Promotion de l'utilisateur réussie !";
    $_SESSION['couleurMessagePromotion'] = "alert-success";
    
}
else{
    $_SESSION['messagePromotion'] = "Echec de la promotion de l'utilisateur !";
    $_SESSION['couleurMessagePromotion'] = "alert-danger";
    echo "Erreur d'exécution : " . $stmt->error;
}
$stmt->close();
$conn->close();
header("Location: ./compte.php");

?>