<?php
    session_start();
    $titre_page="Compte";
    $_SESSION['nom']="AMISI DJONGA";
    $_SESSION['prenom']= "Arthur";
    include 'header.inc.php';
    include 'navbars.inc.php';
    if (isset($_SESSION['user_id'])) {
        $prenom=$_SESSION['prenom'];
        $nom=$_SESSION['nom'];
    } else {
        header("Location: ./connexion.php"); // Redirection si pas de session active
        }
    echo "<div class="."centre"." id="."bienvenue".">
                <h2 class='ombre-bleue'>Bienvenue ".$prenom."</h2></div>";
    echo "<section class='d-flex flex-column'>

            <div class= 'row align-items-start' id='tab-bord'>
                <h2 class='ombre-bleue offset-1'>Tableau de bord</h2>
            </div>

            <div class='row offset-2'>

                <div class='col-6 g-0 offset-2 d-flex align-items-center justify-content-center' id='entrainements-a-venir'>
                    <h3 class='ombre-bleue'>Entraînements à venir</h3>
                </div>

                <div class='col-3 g-0'>
                    <button type='button' class='btn btn-danger' id='btn-rouge'><h3>Se désinscrire</h3></button>
                </div>

            </div>
            <div class='row'>
                <div class='row col-8  g-0 gap-5 offset-2 justify-content-evenly align-items-center' id='div-training'>

                    <div class='col-5 d-flex flex-column align-items-start relief-training'>
                        <h5>Lundi 11 novembre 2024 à 16h30</h5>
                        <h5>Fartlek</h5>
                        <h5>Participants : 10</h5>
                    </div>

                    <div class='col-5 d-flex flex-column align-items-start relief-training'>
                        <h5>Jeudi 14 novembre 2024 à 10h00</h5>
                        <h5>Spécial VMA</h5>
                        <h5>Participants : 5</h5>
                    </div>

                    <div class='col-5 d-flex flex-column align-items-start relief-training'>
                        <h5>Vendredi 15 novembre 2024 à 12h00</h5>
                        <h5>Footing en aisance</h5>
                        <h5>Participants : 6</h5>
                    </div>

                    <div class='col-5 d-flex flex-column align-items-start relief-training'>
                        <h5>Mardi 19 novembre 2024 à 15h00</h5>
                        <h5>Footing en actif</h5>
                        <h5>Participants : 9</h5>
                    </div>
                    <div class='col-5 d-flex flex-column align-items-start relief-training'>
                        <h5>Vendredi 15 novembre 2024 à 12h00</h5>
                        <h5>Footing en aisance</h5>
                        <h5>Participants : 6</h5>
                    </div>

                    <div class='col-5 d-flex flex-column align-items-start relief-training'>
                        <h5>Mardi 19 novembre 2024 à 15h00</h5>
                        <h5>Footing en actif</h5>
                        <h5>Participants : 9</h5>
                    </div>

                </div>
                <div id='div-vide'><div>
            </div>
           

          </section>";
?>
<!-- <h2 class="ombre-bleue">Bonjour .$utilisateur. !</h2> -->

<?php include 'footer.inc.php'; ?>