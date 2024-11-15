<?php
// Paramètres de connexion à la base de données
require_once("param.inc.php"); 
// Création de la connexion avec mysqli
$conn = new mysqli($host,$login,$password,$dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Initialisation du message de retour
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des valeurs du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'email existe déjà
    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
    if ($stmt === false) {
        die('Erreur de préparation de la requête : ' . $conn->error); // Afficher l'erreur de préparation
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message = "Cet email est déjà utilisé.";
    } else {
        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Date de création du compte
        $date_creation = date('Y-m-d H:i:s');

        // Insertion du nouvel utilisateur
        $stmt = $conn->prepare("INSERT INTO utilisateur (date_creation, email, mot_de_passe, nom, prenom) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die('Erreur de préparation de la requête : ' . $conn->error); // Afficher l'erreur de préparation
        }

        // Lier les paramètres
        $stmt->bind_param("sssss", $date_creation, $email, $hashedPassword, $nom, $prenom);

        if ($stmt->execute()) {
            $message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        } else {
            $message = "Une erreur est survenue lors de l'inscription : " . $stmt->error;
        }
    }

    // Fermeture du statement et de la connexion
    $stmt->close();
    $conn->close();

    // Rediriger vers la page d'inscription avec un message
    header("Location: inscription.php?message=" . urlencode($message));
    exit();
}
?>