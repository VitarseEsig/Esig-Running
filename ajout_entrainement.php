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
date_default_timezone_set('Europe/Paris');

$message = '';
$titre = $_POST['titreEntrainement'];
$date =$_POST['dateEntrainement'];
$heure = $_POST['heureEntrainement'];
$maxParticipants = $_POST['maxParticipantsEntrainement'];
$date_creation = date('Y-m-d H:i:s');

switch($titre){
    case '1' :
        $titre = "Fartlek";
        $description = "L'entraînement Fartlek, qui signifie \"jeu de vitesse\" en suédois, est une méthode variée et ludique pour améliorer à la fois votre endurance et votre vitesse. Il consiste à alterner des phases de course rapide et des phases de récupération active, sans suivre un schéma strict. Contrairement aux intervalles classiques, le Fartlek se base sur vos sensations et l'environnement : accélérez en montée, ralentissez en descente, ou alternez des sprints et des joggings selon votre forme. C'est un entraînement flexible qui casse la monotonie et vous aide à progresser tout en vous amusant.";
        $categorie="Fractionné";
        break;
    case '2' :
        $titre = "Spécial VMA";
        $description = "L'entraînement de VMA (Vitesse Maximale Aérobie) est conçu pour améliorer votre capacité à courir plus vite sur de longues distances. Il alterne des périodes d'effort intense, où vous courez à votre votre vitesse maximale, et des temps de récupération. Les exercices incluent des répétitions de courtes distances (ex : 200m, 400m), ou des intervalles de 30/30 (30 secondes de course rapide, 30 secondes de récupération). Cet entraînement optimise votre endurance et votre vitesse, idéal pour progresser et performer lors de vos courses.";
        $categorie="Fractionné";
        break;
    case '3' :
        $titre = "Footing en aisance";
        $description = "Le footing en aisance est une séance de course à un rythme confortable, où vous devez être capable de parler sans difficulté pendant l'effort. Cet entraînement, souvent réalisé à allure modérée, permet de travailler l'endurance de base tout en récupérant des séances plus intenses. Il est idéal pour renforcer votre condition physique sans forcer et pour habituer votre corps à courir plus longtemps sans stress. Accessible à tous les niveaux, le footing en aisance est essentiel pour progresser durablement et courir avec plaisir.";
        break;
        $categorie="Footing";

    case '4' :
        $titre = "Footing actif";
        $description = "Le footing actif est un entraînement à allure modérée à soutenue, situé entre le footing en aisance et les séances plus intenses. L'objectif est de courir à un rythme dynamique, mais toujours contrôlé, tout en restant à une intensité qui vous permet de maintenir l'effort sur une durée prolongée. Ce type de séance permet d'améliorer l'endurance, de renforcer le cardio, et de préparer votre corps à des efforts plus rapides. Idéal pour ceux qui souhaitent monter en puissance sans basculer dans l'intensité maximale, le footing actif vous aide à progresser en toute efficacité.";
        $categorie="Footing";
        break;
    default:
        $titre = "Entraînement inconnu";
        $description ="Pas de description";
        $categorie="Footing";
        break;
}
echo $titre;

$stmt = $conn->prepare("INSERT INTO Entrainement (createur_id, date_creation, titre, categorie, description, date, heure, nb_max_participants) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die('Erreur de préparation de la requête : ' . $conn->error); // Afficher l'erreur de préparation
    echo "probleme";
}
$stmt->bind_param("issssssi",$_SESSION['id_utilisateur'],$date_creation,$titre,$categorie,$description,$date,$heure,$maxParticipants);

if($stmt->execute()){
    echo "reussite";
    // $_SESSION['message'] = "Entrainement ajouté avec succès !";
    // $_SESSION['couleurMessage'] = "alert-success";
    
}
else{
    // $_SESSION['message'] = "Echec de l'ajout de l'entraînement !";
    // $_SESSION['couleurMessage'] = "alert-danger";
    echo "echec";
}
$stmt->close();
$conn->close();
// header("Location: ./compte membre.php#ajoutEntrainement");

?>