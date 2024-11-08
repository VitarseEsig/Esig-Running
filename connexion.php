<?php
    session_start();
    $titre_page = "Connexion";
    $_SESSION['utilisateur']="Arthur";
    
    if(!isset($_SESSION['utilisateur'])) {
        include 'header.inc.php';
        include 'navbars.inc.php';
    }
    else {
        header ( "Location: ./compte.php" );
    }
    
?>

<h1>Page de connexion</h1>
<p>Vous êtes sur la page de connexion</p>

<?php include 'footer.inc.php'; ?>