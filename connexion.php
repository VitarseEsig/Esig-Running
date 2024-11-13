<?php
    session_start();
    $_SESSION['user_id']= 1;
    $titre_page = "Connexion";    
    
    if(!isset($_SESSION['user_id'])) {
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