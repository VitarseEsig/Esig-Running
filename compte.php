<?php
session_start();

// Définir le titre de la page
$titre_page = "Compte";

// Inclure les fichiers d'en-tête et de navigation
include 'header.inc.php';
include 'navbars.inc.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_utilisateur'])) {
    // Récupérer les informations de l'utilisateur depuis la session
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
} else {
    // Redirection vers la page de connexion si aucune session active
    header("Location: ./connexion.php");
    exit();
}

echo "<div class="."centre"." id="."bienvenue".">
<h2 class='ombre-bleue'>Bienvenue ".$prenom."</h2></div>";

/* Du coup j'ai besoin que tu récupères les informations de chaque entrainement à venir pour un utilisateur dans la bdd. Il me faut le titre, la date, l'heure et le nombre de participants. Tu dois donc faire une requete du genre à choper l'id de chaque entraînement où l'utilisateur concerné (en utilisant la table inscription exemple : SELECT id_entrainement FROM inscription WHERE id_utilisateur = $_SESSION['id_utilisateur])
Ensuite une fois que tu as stocké chaque id_entrainement qui nous intéresse dans un tableau, tu fais un truc du genre (juste à titre indicatif, la synthaxe peut ne pas être bonne)
for element $liste_id_entrainement{
    $details=[SELECT titre, date, heure, participants FROM entrainements WHERE id_entrainement = element] en gros tu les stocke dans cette liste
    $liste_entrainements_avenir[$element]= ["titre" => $details[0],"date" => $details[1],"heure" =>$details[2],"participants" => $details[3]]
}
    BREF tu vois un peu le principe ? Je te laisse gérer pour la synthaxe etc mais en tout cas moi j'ai fait en sorte de récupérer et afficher les informations contenues dans un dictionnaire qui ressemble à l'exemple ci-dessous
*/

$liste_entrainements_avenir=[
    "1"=> [
        "titre"=> "Fartlek",
        "date"=> "Lundi 11 novembre 2024",
        "heure"=> "16h30",
        "participants"=> "10",
    ],
    "2"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Jeudi 14 novembre 2024",
        "heure" => "10h00",
        "participants"=> "5",
        ],
    "3"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Jeudi 14 novembre 2024",
        "heure" => "10h00",
        "participants"=> "5",
        ],
    "4"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Jeudi 14 novembre 2024",
        "heure" => "10h00",
        "participants"=> "5",
        ], 
    "5"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Jeudi 14 novembre 2024",
        "heure" => "10h00",
        "participants"=> "5",
        ],
    "6"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Jeudi 14 novembre 2024",
        "heure" => "10h00",
        "participants"=> "5",
        ]
];
//à suivre

echo "<section class='d-flex flex-column'>

    <div class='row align-items-start' id='tab-bord'>
        <h2 class='ombre-bleue offset-1'>Tableau de bord</h2>
    </div>

    <div class='row offset-2'>

        <div class='col-7 g-0 offset-2 d-flex align-items-center justify-content-start' id='entrainements-a-venir'>
            <h4 class='offset-4'>Entraînements à venir</h4>
            <button class='offset-3' id='btn-horloge'><img src='./assets/img/horloge.png' alt='horloge bleue' id='horloge'></button>
        </div>

        <div class='col-3 g-0'>
            <button type='button' class='btn btn-danger' id='btn-rouge'><h4>Se désinscrire</h4></button>
        </div>

    </div>
    <div class='row offset-2'>
        <div class='row col-9  g-0 gap-5 justify-content-evenly align-items-center' id='div-training'>";

                foreach($liste_entrainements_avenir as $entrainement => $details) {
                    echo "<div class='col-5 d-flex flex-column align-items-start relief-training'>";
                        if(isset($details['date']) && isset($details['heure'])){
                            echo "<h5>".$details['date']." à ".$details['heure']."</h5>";
                        }
                        if(isset($details['titre'])){
                            echo "<h5>".$details['titre']."</h5>";
                        }
                        if(isset($details['participants'])){
                            echo "<h5>Participants : ".$details['participants']."</h5>";
                        }
                    echo "</div>";
                }


        echo "</div>
        <div id='div-vide'><div>
    </div>
    </section>";

/* Il faut faire la même chose pour cette liste mais en récupérant toutes ces infos de chaque entrainement qui se trouve dans la bdd (avec pour seul filtrage de choisir les entrainements dont le maximum de participants n'a pas été atteint : il faudra regarder la table inscription pour vérifier cela)
*/
$liste_entrainements=[
    "1"=> [
        "titre"=> "Fartlek",
        "date"=> "Lundi 11 novembre 2024",
        "heure"=> "16h30",
        "participants"=> "10",
        "description" => "L'entraînement Fartlek, qui signifie \"jeu de vitesse\" en suédois, est une méthode variée et ludique pour améliorer à la fois votre endurance et votre vitesse. Il consiste à alterner des phases de course rapide et des phases de récupération active, sans suivre un schéma strict. Contrairement aux intervalles classiques, le Fartlek se base sur vos sensations et l'environnement : accélérez en montée, ralentissez en descente, ou alternez des sprints et des joggings selon votre forme. C'est un entraînement flexible qui casse la monotonie et vous aide à progresser tout en vous amusant.",
        "catégorie" => "Fractionné"
    ],
    "2"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Mercredi 13 novembre 2024",
        "heure" => "13h00",
        "participants"=> "5",
        "description" => "L'entraînement de VMA (Vitesse Maximale Aérobie) est conçu pour améliorer votre capacité à courir plus vite sur de longues distances. Il alterne des périodes d'effort intense, où vous courez à votre votre vitesse maximale, et des temps de récupération. Les exercices incluent des répétitions de courtes distances (ex : 200m, 400m), ou des intervalles de 30/30 (30 secondes de course rapide, 30 secondes de récupération). Cet entraînement optimise votre endurance et votre vitesse, idéal pour progresser et performer lors de vos courses. Rejoignez-nous pour booster vos performances !",
        "catégorie"=> "Fractionné"
        ],
    "3"=> [
        "titre"=> "Footing en aisance",
        "date"=> "Jeudi 14 novembre 2024",
        "heure" => "10h00",
        "participants"=> "17",
        "description" => "Le footing en aisance est une séance de course à un rythme confortable, où vous devez être capable de parler sans difficulté pendant l'effort. Cet entraînement, souvent réalisé à allure modérée, permet de travailler l'endurance de base tout en récupérant des séances plus intenses. Il est idéal pour renforcer votre condition physique sans forcer et pour habituer votre corps à courir plus longtemps sans stress. Accessible à tous les niveaux, le footing en aisance est essentiel pour progresser durablement et courir avec plaisir.",
        "catégorie"=> "Footing"
        ],
    "4"=> [
        "titre"=> "Footing actif",
        "date"=> "Vendredi 15 novembre 2024",
        "heure" => "15h50",
        "participants"=> "25",
        "description"=> "Le footing actif est un entraînement à allure modérée à soutenue, situé entre le footing en aisance et les séances plus intenses. L'objectif est de courir à un rythme dynamique, mais toujours contrôlé, tout en restant à une intensité qui vous permet de maintenir l'effort sur une durée prolongée. Ce type de séance permet d'améliorer l'endurance, de renforcer le cardio, et de préparer votre corps à des efforts plus rapides. Idéal pour ceux qui souhaitent monter en puissance sans basculer dans l'intensité maximale, le footing actif vous aide à progresser en toute efficacité.",
        "catégorie"=> "Footing"
        ], 
    "5"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Mercredi 13 novembre 2024",
        "heure" => "13h00",
        "participants"=> "5",
        "description" => "L'entraînement de VMA (Vitesse Maximale Aérobie) est conçu pour améliorer votre capacité à courir plus vite sur de longues distances. Il alterne des périodes d'effort intense, où vous courez à votre votre vitesse maximale, et des temps de récupération. Les exercices incluent des répétitions de courtes distances (ex : 200m, 400m), ou des intervalles de 30/30 (30 secondes de course rapide, 30 secondes de récupération). Cet entraînement optimise votre endurance et votre vitesse, idéal pour progresser et performer lors de vos courses. Rejoignez-nous pour booster vos performances !",
        "catégorie"=> "Fractionné"
        ],
    "6"=> [
        "titre"=> "Fartlek",
        "date"=> "Lundi 11 novembre 2024",
        "heure"=> "16h30",
        "participants"=> "10",
        "description" => "L'entraînement Fartlek, qui signifie \"jeu de vitesse\" en suédois, est une méthode variée et ludique pour améliorer à la fois votre endurance et votre vitesse. Il consiste à alterner des phases de course rapide et des phases de récupération active, sans suivre un schéma strict. Contrairement aux intervalles classiques, le Fartlek se base sur vos sensations et l'environnement : accélérez en montée, ralentissez en descente, ou alternez des sprints et des joggings selon votre forme. C'est un entraînement flexible qui casse la monotonie et vous aide à progresser tout en vous amusant.",
        "catégorie" => "Fractionné"
        ],
    "7"=> [
        "titre"=> "Footing actif",
        "date"=> "Vendredi 15 novembre 2024",
        "heure" => "15h50",
        "participants"=> "25",
        "description"=> "Le footing actif est un entraînement à allure modérée à soutenue, situé entre le footing en aisance et les séances plus intenses. L'objectif est de courir à un rythme dynamique, mais toujours contrôlé, tout en restant à une intensité qui vous permet de maintenir l'effort sur une durée prolongée. Ce type de séance permet d'améliorer l'endurance, de renforcer le cardio, et de préparer votre corps à des efforts plus rapides. Idéal pour ceux qui souhaitent monter en puissance sans basculer dans l'intensité maximale, le footing actif vous aide à progresser en toute efficacité.",
        "catégorie"=> "Footing"
        ], 
    "8"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Mercredi 13 novembre 2024",
        "heure" => "13h00",
        "participants"=> "5",
        "description" => "L'entraînement de VMA (Vitesse Maximale Aérobie) est conçu pour améliorer votre capacité à courir plus vite sur de longues distances. Il alterne des périodes d'effort intense, où vous courez à votre votre vitesse maximale, et des temps de récupération. Les exercices incluent des répétitions de courtes distances (ex : 200m, 400m), ou des intervalles de 30/30 (30 secondes de course rapide, 30 secondes de récupération). Cet entraînement optimise votre endurance et votre vitesse, idéal pour progresser et performer lors de vos courses. Rejoignez-nous pour booster vos performances !",
        "catégorie"=> "Fractionné"
        ],
    "9"=> [
        "titre"=> "Fartlek",
        "date"=> "Lundi 11 novembre 2024",
        "heure"=> "16h30",
        "participants"=> "10",
        "description" => "L'entraînement Fartlek, qui signifie \"jeu de vitesse\" en suédois, est une méthode variée et ludique pour améliorer à la fois votre endurance et votre vitesse. Il consiste à alterner des phases de course rapide et des phases de récupération active, sans suivre un schéma strict. Contrairement aux intervalles classiques, le Fartlek se base sur vos sensations et l'environnement : accélérez en montée, ralentissez en descente, ou alternez des sprints et des joggings selon votre forme. C'est un entraînement flexible qui casse la monotonie et vous aide à progresser tout en vous amusant.",
        "catégorie" => "Fractionné"
            ]
];


    echo "<section id='inscriptions' class='col-9 offset-0 d-flex flex-column gap-4 align-items-center'>

            <div class='d-flex justify-content-center align-items-center col-8 offset-0' id='div-titre-inscription'>
                <h3 class='col-8 offset-1'>S'inscrire à un entraînement</h3>
            </div>
                
            <div class='row col-12 justify-content-start'>
                <h4 class='offset-1'>Trier par :</h4>
            </div>
            <div class='d-flex gap-5' id='div-tri'>
                <form action='#' class='d-flex flex-column col-8 gap-2 offset-0' id='tri'>
                    <div class='d-flex gap-4' id='tri-row'>
                        <div class='d-flex col-5 align-items-center justify-content-center '>
                            <h5 class='margin-tri'>Date</h5>
                            <input type='date' id='dateInput' name='date' placeholder='Date'>
                        </div>
                        <div class='d-flex col-4 align-items-center'>
                            <h5 class='margin-tri'>Heure</h5>
                            <input type='time' id='heure' name='heure'>
                        </div>
                        <select id='type' name='type' class='col-2'>
                            <option selected>Type</option>
                            <option value='1'>Footing</option>
                            <option value='2'>Fractionné</option>
                        </select>
                    </div>
                    <input type='submit' value='Trier' class='col-10 offset-1' id='btn-trier'>
                </form>
                <form class='d-flex me-2 col-4 offset-0' role='search' action='#' id='recherche'>
                    <input class='form-control' type='search' placeholder='Rechercher'>
                    <button class='btn btn-outline-success' type='submit'><img src='./assets/img/loupe inclinee.png' id='loupe' alt='loupe' class='img-fluid'></button>
                </form>
            </div>
            <div class='d-flex flex-column offset-0 gap-5' id='div-liste-training'>";
            // il faut pouvoir récupérer l'id de l'entrainement et l'ajouter dans la table inscriptions pour s'inscrire à un entrainement
                foreach($liste_entrainements as $entrainement => $details){
                    echo "<button type='button' data-bs-toggle='modal' data-bs-target='#details".$entrainement."' class='d-flex align-items-center btn-inscription-training'>";
                    if(isset($details['titre'])){
                        echo "<h3>".$details['titre']."</h3>";
                    }
                    if(isset($details['date']) && isset($details['heure'])){
                        echo "<h4 class='offset-1'>".$details["date"]." à ".$details['heure']."</h4>";
                    }
                    echo "</button>
                        <div class='modal fade' id='details".$entrainement."' tabindex='-1' aria-labelledby='exampleModalLabel".$entrainement."' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-scrollable'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h1 class='modal-title fs-5 modal-titre' id='exampleModalLabel".$entrainement."'>".$details['titre']."</h1>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body p-modal'>
                                        <h4>Date : ".$details['date']."</h4>
                                        <h4>Heure : ".$details['heure']."</h4>
                                        <div class='d-flex flex-column'>
                                            <h4>Description : <h4>
                                            <p>".$details['description']."</p>
                                        </div>
                                        
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Annuler</button>
                                        <form method='POST' action='#'>
                                            <button type='submit' class='btn btn-primary'>S'inscrire</button>
                                            <input type='hidden' name='id_entrainement_choisi' value='".$entrainement."'>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
/* Pour le form ayant la méthode POST, ce form renvoie l'id de l'entrainement auquel l'utilisateur souhaite s'inscrire. Dans action j'ai mis un # pour ne rien faire, mais tu devras changer ça par le nom du fichier de traitement qui associera l'id utilisateur à l'id d'entrainement (via la méthode POST. exemple : INSERT INTO inscriptions VALUES($_SESSION['id_utilisateur'],$_POST['id_entrainement_choisi'])); dans la table inscriptions de la bdd
*/
                        //   <input type='hidden' name='id_entrainement_choisi' value='".$entrainement."'>"
                }
                // <div class='d-flex align-items-center div-inscription-training'>
                //     <h3>Fartlek</h3>
                //     <h4 class='offset-1'>Lundi 11 novembre 2024 à 9h00</h4>
                // </div>
                // <div class='d-flex align-items-center div-inscription-training'>
                //     <h3>Footing en aisance</h3>
                //     <h4 class='offset-1'>Mardi 12 novembre 2024 à 10h30</h4>
                // </div>
                // <div class='d-flex align-items-center div-inscription-training'>
                //     <h3>Spécial VMA</h3>
                //     <h4 class='offset-1'>Mercredi 13 novembre 2024 à 13h00</h4>
                // </div>
                // <div class='d-flex align-items-center div-inscription-training'>
                //     <h3>Footing actif</h3>
                //     <h4 class='offset-1'>Vendredi 15 novembre 2024 à 14h50</h4>
                // </div>
                // <div class='d-flex align-items-center div-inscription-training'>
                //     <h3>Fartlek</h3>
                //     <h4 class='offset-1'>Lundi 11 novembre 2024 à 9h00</h4>
                // </div>
                // <div class='d-flex align-items-center div-inscription-training'>
                //     <h3>Footing en aisance</h3>
                //     <h4 class='offset-1'>Marid 12 novembre 2024 à 10h30</h4>
                // </div>
                // <div class='d-flex align-items-center div-inscription-training'>
                //     <h3>Spécial VMA</h3>
                //     <h4 class='offset-1'>Mercredi 13 novembre 2024 à 13h00</h4>
                // </div>
                // <div class='d-flex align-items-center div-inscription-training'>
                //     <h3>Footing actif</h3>
                //     <h4 class='offset-1'>Vendredi 15 novembre 2024 à 14h50</h4>
                // </div>
            echo "</div>
        </section>";
?>




<?php include 'footer.inc.php'; ?>