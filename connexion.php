<?php
    session_start();
    $_SESSION['user_id'] = 1;
    $titre_page = "Connexion"; 
    include 'header.inc.php';
    include 'navbars.inc.php';   
    
    if(!isset($_SESSION['user_id'])) {
        
    }
    else {
        //header ( "Location: ./compte.php" );
    }
   
?>

<body>
    <h1>Page de connexion</h1>

    <!-- Affichage du message d'erreur s'il existe -->
    <?php if (isset($message) && !empty($message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Formulaire de connexion -->
    <form method="POST" action="traitement_connexion.php">
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
</body>

<?php include 'footer.inc.php'; ?>