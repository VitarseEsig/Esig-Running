<?php
    session_start();
    $titre_page="Compte";
    include 'header.inc.php';
    include 'navbars.inc.php';
    $utilisateur = $_SESSION['utilisateur'];
    echo "<h2 class="."ombre-bleue".">Bonjour ".$utilisateur."</h2>";

?>
<!-- <h2 class="ombre-bleue">Bonjour .$utilisateur. !</h2> -->