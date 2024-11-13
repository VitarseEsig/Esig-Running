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
                <h2 class='ombre-bleue offset-2'>Tableau de bord</h2>
            </div>
            <div class='row'>
                <div class='col-8 d-flex justify-content-center align-items-center' id='entrainements-a-venir'>
                    <h3 class='ombre-bleue'>Entraînements à venir</h3>
                </div>
                <div class='col-4 row ' id='btn-rouge'>
                    <h3 class=' ombre-bleue'>Se désinscrire</h3>
                </div>
            </div>
          </section>";
?>
<!-- <h2 class="ombre-bleue">Bonjour .$utilisateur. !</h2> -->