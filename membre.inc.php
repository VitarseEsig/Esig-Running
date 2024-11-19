<?php
// Définir le titre de la page

// $liste_participants=[
//     "6" => [
//         "1" => "Paul Hurrier",
//         "2" => "Lhéo Kivata",
//         "3" => "Avon Barksdale",
//         "4" => "John Dumoulin",
//         "5" => "Arria Mouns",
//         "6" => "Avé Noche",
//         "7" => "Michael Jackson",
//         "8" => "Franklin Saint",
//         "9" => "James St. Patrick",
//         "10" => "Method Man",
//     ],
//     "7" => [
//         "1" => "Paul Hurrier",
//         "2" => "Lhéo Kivata",
//         "3" => "Avon Barksdale",
//         "10" => "Method Man",
//         "11" => "Théo Lapépite",
//     ],
//     "10" => [
//         "1" => "Paul Hurrier",
//         "2" => "Lhéo Kivata",
//         "3" => "Avon Barksdale",
//         "4" => "John Dumoulin",
//         "5" => "Arria Mouns",
//         "6" => "Avé Noche",
//         "10" => "Method Man",
//         "11" => "Théo Lapépite",
//     ],
//     "11" => [
//         "1" => "Paul Hurrier",
//         "2" => "Lhéo Kivata",
//         "3" => "Avon Barksdale",
//         "4" => "John Dumoulin",
//         "5" => "Arria Mouns",
//         "6" => "Avé Noche",
//         "7" => "Michael Jackson",
//         "8" => "Franklin Saint",
//         "9" => "James St. Patrick",
//         "10" => "Method Man",
//         "11" => "Théo Lapépite",
//     ]
//     ];
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
                foreach($liste_entrainements as $entrainement => $details) {
                    $sql = "SELECT id_utilisateur, nom, prenom FROM utilisateur
                            INNER JOIN inscription
	                            ON id_utilisateur = utilisateur_id
    	                        WHERE entrainement_id = $entrainement";
                    $result = $conn->query($sql);
                    // $liste_participants = [];
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $liste_participants[$entrainement][$row['id_utilisateur']] =$row['nom']." ".$row['prenom'];

                        }
                    }



                    echo "<button type='button' class='col-5 d-flex flex-column align-items-start relief-training' data-bs-toggle='modal' data-bs-target='#detailsMembre".$entrainement."'>";

                        if(!empty($details['date']) && !empty($details['heure'])){
                            echo "<h5>".$details['date']." à ".$details['heure']."</h5>";
                        }
                        if(!empty($details['titre'])){
                            echo "<h5>".$details['titre']."</h5>";
                        }
                        if(!empty($details['participants'])){
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
                                        foreach($liste_participants[$entrainement] as $participant => $nomComplet){
                                            echo "
                                                <div class='d-flex align-items-center justify-content-between div-participant'>
                                                    <h4>".$nomComplet."</h4>
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
                     
                        
                }


        echo "</div>
        <div id='div-vide'><div>
    </div>
    </section>";


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
            if(isset($_SESSION['message'])){
                echo "<div class='alert ".$_SESSION['couleurMessage']."'>"
                            .$_SESSION['message']."
                        </div>";
                unset($_SESSION['message']);
                unset($_SESSION['couleurMessage']);
            }

        echo"</section>";

        $sql = "SELECT id_utilisateur, nom, prenom FROM utilisateur
    	        WHERE role != 'membre_association'";
                    $result = $conn->query($sql);
                    // $liste_participants = [];
                    $liste_utilisateurs = [];
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $liste_utilisateurs[$row['id_utilisateur']] = $row['nom']." ".$row['prenom'] ;
                        }
                    }


        echo "<section id='promotion' class='col-8 offset-0 d-flex flex-column gap-4 align-items-center'>

            <div class='d-flex justify-content-center align-items-center col-8 offset-0' id='div-titre-inscription'>
                <h3 class='col-8 offset-1'>Promouvoir un utilisateur</h3>
            </div>
            <div class='col-5' id='utilisateurs'>";
                foreach($liste_utilisateurs as $utilisateur => $nomEntier){
                    echo "<div class='d-flex align-items-center justify-content-between div-participant'>
                            <h4>$nomEntier</h4>
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#promotionModal".$utilisateur."'>Promouvoir</button>
                        </div>";
                
            echo "
                    <div class='modal fade' id='promotionModal$utilisateur' tabindex='-1' aria-labelledby='promotionModalLabel$utilisateur' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-5' id='promotionModalLabel$utilisateur'>Promouvoir un utilisateur</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <h4>Etes vous sûr de vouloir promouvoir $nomComplet ?</h4>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Annuler</button>
                                    <form method='POST' action='promotion.php'>
                                        <button type='submit' class='btn btn-primary'>Confirmer</button>
                                        <input type='hidden' name='id_utilisateur_a_promouvoir' value='$utilisateur'>
                                    </form>
                                    </div>
                            </div>
                        </div>
                    </div>                    
            ";
            }
            // if(isset($_SESSION['message'])){
            //     echo "<div class='alert ".$_SESSION['couleurMessage']."'>"
            //                 .$_SESSION['message']."
            //             </div>";
            //     unset($_SESSION['message']);
            //     unset($_SESSION['couleurMessage']);
            // }

        echo"</div>
        </section>";
?>
