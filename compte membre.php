<?php
session_start();

// Définir le titre de la page
$titre_page = "Compte membre";

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
        "participants"=> "8",
        ],
    "4"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Jeudi 14 novembre 2024",
        "heure" => "10h00",
        "participants"=> "11",
        ], 
    "5"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Jeudi 14 novembre 2024",
        "heure" => "10h00",
        "participants"=> "7",
        ],
    "6"=> [
        "titre"=> "Spécial VMA",
        "date"=> "Jeudi 14 novembre 2024",
        "heure" => "10h00",
        "participants"=> "5",
        ]
];

$liste_participants=[
    "1" => [
        "1" => "Paul Hurrier",
        "2" => "Lhéo Kivata",
        "3" => "Avon Barksdale",
        "4" => "John Dumoulin",
        "5" => "Arria Mouns",
        "6" => "Avé Noche",
        "7" => "Michael Jackson",
        "8" => "Franklin Saint",
        "9" => "James St. Patrick",
        "10" => "Method Man",
    ],
    "2" => [
        "1" => "Paul Hurrier",
        "2" => "Lhéo Kivata",
        "3" => "Avon Barksdale",
        "10" => "Method Man",
        "11" => "Théo Lapépite",
    ],
    "3" => [
        "1" => "Paul Hurrier",
        "2" => "Lhéo Kivata",
        "3" => "Avon Barksdale",
        "4" => "John Dumoulin",
        "5" => "Arria Mouns",
        "6" => "Avé Noche",
        "10" => "Method Man",
        "11" => "Théo Lapépite",
    ],
    "4" => [
        "1" => "Paul Hurrier",
        "2" => "Lhéo Kivata",
        "3" => "Avon Barksdale",
        "4" => "John Dumoulin",
        "5" => "Arria Mouns",
        "6" => "Avé Noche",
        "7" => "Michael Jackson",
        "8" => "Franklin Saint",
        "9" => "James St. Patrick",
        "10" => "Method Man",
        "11" => "Théo Lapépite",
    ],
    "5" => [
        "5" => "Arria Mouns",
        "6" => "Avé Noche",
        "7" => "Michael Jackson",
        "8" => "Franklin Saint",
        "9" => "James St. Patrick",
        "10" => "Method Man",
        "11" => "Théo Lapépite",
    ],
    "6" => [
        "1" => "Paul Hurrier",
        "2" => "Lhéo Kivata",
        "3" => "Avon Barksdale",
        "4" => "John Dumoulin",
        "5" => "Arria Mouns",
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
                    echo "<button type='button' class='col-5 d-flex flex-column align-items-start relief-training' data-bs-toggle='modal' data-bs-target='#detailsMembre".$entrainement."'>";
                        if(isset($details['date']) && isset($details['heure'])){
                            echo "<h5>".$details['date']." à ".$details['heure']."</h5>";
                        }
                        if(isset($details['titre'])){
                            echo "<h5>".$details['titre']."</h5>";
                        }
                        if(isset($details['participants'])){
                            echo "<h5>Participants : ".$details['participants']."</h5>";
                        }
                    echo "</button>
                        <div class='modal fade' id='detailsMembre".$entrainement."' tabindex='-1' aria-labelledby='detailsMembreLabel".$entrainement."' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-scrollable taillemax'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h1 class='modal-title fs-5 modal-titre' id='detailsMembreLabel".$entrainement."'>".$details['titre']." :  Participants</h1>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body d-flex flex-column gap-3'>";
                                        foreach($liste_participants["$entrainement"] as $participant => $nomComplet){
                                            echo "
                                                <div class='d-flex align-items-center justify-content-between div-participant'>
                                                    <h4>".$nomComplet."</h4>
                                                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#promotionModal".$participant."'>Promouvoir</button>
                                                </div>";
                                        }
                                    echo "</div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Annuler</button>
                                        <form method='POST' action='#'>
                                            <button type='submit' class='btn btn-danger'>Annuler l'entraînement</button>
                                            <input type='hidden' name='id_entrainement_choisi_a_annuler' value='".$entrainement."'>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        foreach($liste_participants["$entrainement"] as $participant => $nomComplet){
                            echo "<div class='modal fade' id='promotionModal".$participant."' tabindex='-1' aria-labelledby='promotionModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h1 class='modal-title fs-5' id='promotionModalLabel'>Promouvoir un utilisateur</h1>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <h4>Etes vous sûr de vouloir promouvoir ".$nomComplet." ?</h4>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Annuler</button>
                                            <button type='button' class='btn btn-primary'>Confirmer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                            }
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


    echo "<section id='ajoutEntrainement' class='col-9 offset-0 d-flex flex-column gap-4 align-items-center'>

            <div class='d-flex justify-content-center align-items-center col-8 offset-0' id='div-titre-inscription'>
                <h3 class='col-8 offset-1'>Ajouter un entraînement</h3>
            </div>
            <form method='POST'action='ajout_entrainement.php'>
                <select id='titreEntrainement' name='titreEntrainement'>
                    <option selected>Titre de l'entrainement</option>
                    <option value='1'>Fartlek</option>
                    <option value='2'>Spécial VMA</option>
                    <option value='3'>Footing en aisance</option>
                    <option value='4'>Footing actif</option>
                </select>
                <div class='d-flex gap-2'>
                    <h4>Date</h4>
                    <input type='date' name='dateEntrainement' id='dateEntrainement'>
                </div>
                <div class='d-flex gap-2'>
                    <h4>Heure</h4>
                    <input type='time' name='heureEntrainement' id='heureEntrainement'>
                </div>
                <div class='d-flex gap-2'>
                    <h4>Nombre maximum de participants</h4>
                    <input type='number' name='maxParticipantsEntrainement' id='maxParticipantsEntrainement'>
                </div>
                <button type='submit' class='btn btn-primary'>Ajouter l'entraînement</button>
            </form>
            ";
            // if(isset($_SESSION['message'])){
            //     echo "<div class='alert ".$_SESSION['couleurMessage']."'>"
            //                 .$_SESSION['message']."
            //             </div>";
            //     unset($_SESSION['message']);
            //     unset($_SESSION['couleurMessage']);
            // }

        echo"</section>";
?>




<?php include 'footer.inc.php'; ?>