<?php
session_start();

// Définir le titre de la page
$titre_page = "Compte";

// Paramètres de connexion à la base de données
require_once("param.inc.php");

// Création de la connexion avec mysqli
$conn = new mysqli($host, $login, $password, $dbname);
$conn->set_charset('utf8mb4');
date_default_timezone_set('Europe/Paris');

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Inclure les fichiers d'en-tête et de navigation
include 'header.inc.php';
include 'navbars.inc.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_utilisateur'])) {
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $role = $_SESSION['role'];
    $id_utilisateur = $_SESSION['id_utilisateur'];
} else {
    header("Location: ./connexion.php");
    exit();
}

echo "<div class='centre' id='bienvenue'>
<h2 class='ombre-bleue'>Bienvenue $prenom</h2></div>";

if(isset($_SESSION['messagePromotion'])){
    echo "<div class='alert ".$_SESSION['couleurMessagePromotion']."'>"
                .$_SESSION['messagePromotion']."
            </div>";
    unset($_SESSION['messagePromotion']);
    unset($_SESSION['couleurMessagePromotion']);
}

// Récupérer les entraînements à venir de l'utilisateur connecté
$sql = "
    SELECT 
        e.id_entrainement,
        e.titre,
        DATE_FORMAT(e.date, '%W %d %M %Y') AS date_formattee,
        TIME_FORMAT(e.heure, '%Hh%i') AS heure_formattee,
        (SELECT COUNT(*) FROM Inscription i WHERE i.entrainement_id = e.id_entrainement) AS nb_participants
    FROM 
        Inscription ins
    INNER JOIN 
        Entrainement e ON ins.entrainement_id = e.id_entrainement
    WHERE 
        ins.utilisateur_id = ?
    AND 
        e.date <= CURDATE()
    ORDER BY 
        e.date ASC, e.heure ASC
";

// Préparer la requête
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Erreur lors de la préparation de la requête : " . $conn->error);
}

// Lier les paramètres
$stmt->bind_param("i", $id_utilisateur);

// Exécuter la requête
$stmt->execute();
$result = $stmt->get_result();

// Stocker les résultats dans un tableau
$liste_entrainements_avenir = [];
while ($row = $result->fetch_assoc()) {
    $liste_entrainements_avenir[] = [
        'id' => $row['id_entrainement'],
        'titre' => $row['titre'],
        'date' => $row['date_formattee'],
        'heure' => $row['heure_formattee'],
        'participants' => $row['nb_participants']
    ];
}

$stmt->close();
?>

<?php
// Préparer la requête pour l'affichage des entraînements disponibles
$sql = "
    SELECT 
        e.id_entrainement,
        e.titre,
        DATE_FORMAT(e.date, '%W %d %M %Y') AS date_formattee,
        TIME_FORMAT(e.heure, '%Hh%i') AS heure_formattee,
        (SELECT COUNT(*) FROM Inscription i WHERE i.entrainement_id = e.id_entrainement) AS nb_participants,
        e.description,
        e.categorie
    FROM 
        Entrainement e
    WHERE 
        e.date <= CURDATE()
    ORDER BY 
        e.date ASC, e.heure ASC
";

$result = $conn->query($sql);
$liste_entrainements = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $liste_entrainements[$row['id_entrainement']] = [
            "titre" => $row['titre'],
            "date" => $row['date_formattee'],
            "heure" => $row['heure_formattee'],
            "participants" => $row['nb_participants'],
            "description" => $row['description'],
            "categorie" => $row['categorie']
        ];
    }
}
?>


<?php
if($role == "utilisateur"){
    include 'utilisateur.inc.php';
}
if($role == "membre_association"){
    include 'membre.inc.php';
    $conn->close();
}?>

<?php include 'footer.inc.php'; ?>