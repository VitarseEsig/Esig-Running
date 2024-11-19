<section class='d-flex flex-column'>
    <div class='row align-items-start' id='tab-bord'>
        <h2 class='ombre-bleue offset-1'>Tableau de bord</h2>
    </div>
    <div class='row offset-2'>
        <div class='col-9 g-0 offset-2 d-flex align-items-center justify-content-start' id='entrainements-a-venir'>
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
        <div id='div-vide'><div></div>
    </div>
</section>

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
    <?php
    if(isset($_SESSION['messageInscription'])){
                echo "<div class='alert ".$_SESSION['couleurMessageInscription']."'>"
                            .$_SESSION['messageInscription']."
                        </div>";
                unset($_SESSION['messageInscription']);
                unset($_SESSION['couleurMessageInscription']);
            }?>
</section>