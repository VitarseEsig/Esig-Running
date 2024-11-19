<?php
session_start();

// Définir le titre de la page
$titre_page = "Compte";

// Paramètres de connexion à la base de données
require_once("param.inc.php");

// Création de la connexion avec mysqli
$conn = new mysqli($host, $login, $password, $dbname);

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
    $id_utilisateur = $_SESSION['id_utilisateur'];
} else {
    header("Location: ./connexion.php");
    exit();
}

echo "<div class='centre' id='bienvenue'>
<h2 class='ombre-bleue'>Bienvenue $prenom</h2></div>";

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
        e.date >= CURDATE()
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

<section class='d-flex flex-column'>
    <div class='row align-items-start' id='tab-bord'>
        <h2 class='ombre-bleue offset-1'>Tableau de bord</h2>
    </div>
    <div class='row offset-2'>
        <div class='col-7 g-0 offset-2 d-flex align-items-center justify-content-start' id='entrainements-a-venir'>
            <h4 class='offset-4'>Entraînements à venir</h4>
            <button class='offset-3' id='btn-horloge'><img src='./assets/img/horloge.png' alt='horloge bleue' id='horloge'></button>
        </div>
    </div>
    <div class='row offset-2'>
        <div class='row col-9 g-0 gap-5 justify-content-evenly align-items-center' id='div-training'>
            <?php foreach ($liste_entrainements_avenir as $details): ?>
                <div class='col-5 d-flex flex-column align-items-start relief-training'>
                    <?php if (!empty($details['date']) && !empty($details['heure'])): ?>
                        <h5><?= htmlspecialchars($details['date']) ?> à <?= htmlspecialchars($details['heure']) ?></h5>
                    <?php endif; ?>
                    <?php if (!empty($details['titre'])): ?>
                        <h5><?= htmlspecialchars($details['titre']) ?></h5>
                    <?php endif; ?>
                    <?php if (isset($details['participants'])): ?>
                        <h5>Participants : <?= htmlspecialchars($details['participants']) ?></h5>
                    <?php endif; ?>

                    <!-- Bouton de désinscription -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDesinscription<?= $details['id'] ?>">
                        Se désinscrire
                    </button>

                    <!-- Modal de confirmation de désinscription -->
                    <div class="modal fade" id="modalDesinscription<?= $details['id'] ?>" tabindex="-1" aria-labelledby="modalDesinscriptionLabel<?= $details['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDesinscriptionLabel<?= $details['id'] ?>">Confirmation de désinscription</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir vous désinscrire de cet entraînement ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <form method="POST" action="desinscription.php">
                                        <button type="submit" class="btn btn-danger">Se désinscrire</button>
                                        <!-- Passer l'ID de l'entraînement dans un champ caché -->
                                        <input type="hidden" name="id_entrainement" value="<?= $details['id'] ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


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
        e.date >= CURDATE()
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
$conn->close();
?>

<section id='inscriptions' class='col-9 offset-0 d-flex flex-column gap-4 align-items-center'>
    <div class='d-flex justify-content-center align-items-center col-8 offset-0' id='div-titre-inscription'>
        <h3 class='col-8 offset-1'>S'inscrire à un entraînement</h3>
    </div>
    <div class='d-flex flex-column offset-0 gap-5' id='div-liste-training'>
        <?php foreach ($liste_entrainements as $id => $details): ?>
            <button type='button' data-bs-toggle='modal' data-bs-target='#details<?= $id ?>' class='d-flex align-items-center btn-inscription-training'>
                <h3><?= htmlspecialchars($details['titre']) ?></h3>
                <h4 class='offset-1'><?= htmlspecialchars($details["date"]) ?> à <?= htmlspecialchars($details['heure']) ?></h4>
            </button>
            <div class='modal fade' id='details<?= $id ?>' tabindex='-1' aria-labelledby='exampleModalLabel<?= $id ?>' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-scrollable'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5 modal-titre' id='exampleModalLabel<?= $id ?>'><?= htmlspecialchars($details['titre']) ?></h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body p-modal'>
                            <h4>Date : <?= htmlspecialchars($details['date']) ?></h4>
                            <h4>Heure : <?= htmlspecialchars($details['heure']) ?></h4>
                            <div class='d-flex flex-column'>
                                <h4>Description :</h4>
                                <p><?= htmlspecialchars($details['description']) ?></p>
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Annuler</button>
                            <form method='POST' action='inscription_entrainement.php'>
                                <button type='submit' class='btn btn-primary'>S'inscrire</button>
                                <input type='hidden' name='id_entrainement_choisi' value='<?= $id ?>'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'footer.inc.php'; ?>