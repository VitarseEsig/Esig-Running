<?php
// Démarrer la session
session_start();

// Paramètres de connexion à la base de données
require_once("param.inc.php"); 

// Création de la connexion avec mysqli
$conn = new mysqli($host, $login, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des valeurs du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'email existe dans la base de données
    $stmt = $conn->prepare("SELECT id_utilisateur, mot_de_passe, nom, prenom FROM utilisateur WHERE email = ?");
    if ($stmt === false) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Vérification si l'email existe
    if ($stmt->num_rows > 0) {
        // Récupérer le mot de passe haché et l'id de l'utilisateur
        $stmt->bind_result($id_utilisateur, $hashedPassword, $nom, $prenom);
        $stmt->fetch();

        // Vérifier si le mot de passe est correct
        if (password_verify($password, $hashedPassword)) {
            // Mot de passe valide, démarrer une session
            $_SESSION['id_utilisateur'] = $id_utilisateur;
            $_SESSION['email'] = $email;
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;

            // Rediriger vers la page d'accueil ou tableau de bord
            header("Location: compte.php");
            exit();
        } else {
            // Mot de passe incorrect
            $message = "Mot de passe incorrect. Veuillez réessayer.";
        }
    } else {
        // Email non trouvé
        $message = "Email non trouvé. Veuillez vérifier votre email ou vous inscrire.";
    }

    // Fermeture du statement
    $stmt->close();
}

// Fermeture de la connexion
$conn->close();
?>

<?php
// Afficher le message d'erreur s'il existe
if ($message !== '') {
    echo "<p style='color: red;'>$message</p>";
}
?>

