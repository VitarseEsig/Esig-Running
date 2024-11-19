<?php
    session_start();
    $titre_page = "Connexion"; 
       
    
    if(!isset($_SESSION['id_utilisateur'])) {
        include 'header.inc.php';
        include 'navbars.inc.php';
        echo"<h1>Page de connexion</h1>";
        if(isset($_SESSION['messageConnexion'])){
            echo "<div class='alert ".$_SESSION['couleurMessageConnexion']."'>"
                    .$_SESSION['messageConnexion']."
                </div>";
            unset($_SESSION['messageConnexion']);
            unset($_SESSION['couleurMessageConnexion']);
        }


        if (isset($message) && !empty($message)){
            echo"<p style='color: red;'>$message</p>";
        }
        echo"<form method='POST' action='traitement_connexion.php'>
            <div class='mb-3'>
                <label for='InputEmail1' class='form-label'>Adresse e-mail</label>
                <input type='email' class='form-control' id='InputEmail1' name='email' required>
            </div>
            <div class='mb-3'>
                <label for='InputPassword' class='form-label'>Mot de Passe</label>
                <input type='password' class='form-control' id='InputPassword' name='password' required>
            </div>
            <button type='submit' class='btn btn-primary'>Se connecter</button>
        </form>

        <p>Pas encore inscrit ? <a href='inscription.php'>Inscrivez-vous ici</a>.</p>";

        
    }
    else {
        header ( "Location: ./compte.php" );
    }
   
?>

<!-- <body>
    <h1>Page de connexion</h1> -->

    <!-- Affichage du message d'erreur s'il existe -->
    <!-- <?php //if (isset($message) && !empty($message)): ?>
        <p style="color: red;"><?php //echo htmlspecialchars($message); ?></p>
    <?php //endif; ?> -->

    <!-- Formulaire de connexion -->
    <!-- <form method="POST" action="traitement_connexion.php">
        <div class="mb-3">
            <label for="InputEmail1" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="InputEmail1" name="email" required>
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" id="InputPassword" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>

    <p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
</body> -->

<?php include 'footer.inc.php'; ?>