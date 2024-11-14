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

                <div class='col-7 g-0 offset-2 d-flex align-items-center justify-content-start' id='entrainements-a-venir'>
                    <h4 class='offset-4'>Entraînements à venir</h4>
                    <button class='offset-3' id='btn-horloge'><img src='./assets/img/horloge.png' alt='horloge bleue' id='horloge'></button>
                </div>

                <div class='col-3 g-0'>
                    <button type='button' class='btn btn-danger' id='btn-rouge'><h4>Se désinscrire</h4></button>
                </div>

            </div>
            <div class='row offset-2'>
                <div class='row col-9  g-0 gap-5 justify-content-evenly align-items-center' id='div-training'>

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

          echo "<section id='inscriptions'>

                    <div class='d-flex justify-content-center align-items-center' id='div-titre-inscription'>
                        <h2>S'inscrire à un entraînement</h2>
                    </div>
                        
                    <h4 class='offset-2'>Trier par :</h4>
                    <form action='#'>
                        <input type='date' id='dateInput' name='date'>
                        <input type='time' id='heure' name='heure'>
                        <select id='type' name='type'>
                            <option selected>Type</option>
                            <option value='1'>Footing</option>
                            <option value='2'>Fractionné</option>
                        </select>
                        <input type='submit' value='Trier'>
                    </form>
                </section>";
?>
<!-- <h2 class="ombre-bleue">Bonjour .$utilisateur. !</h2> -->

<?php include 'footer.inc.php'; ?>