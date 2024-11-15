<?php
    $titre_page = "Inscription";
    include 'header.inc.php';
    include 'menu.inc.php';
?>

<body>
    <h1>Page d'inscription</h1>

    <!-- Affichage du message de retour s'il existe -->
    <?php if (isset($_GET['message'])): ?>
        <p><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?>

    <!-- Formulaire d'inscription -->
    <form method="POST" action="traitement_inscription.php">
        <div class="mb-3">
            <label for="InputNom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="InputNom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="InputPrenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="InputPrenom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="InputEmail1" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="InputEmail1" name="email" required>
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" id="InputPassword" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>

    <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
</body>

<?php include 'footer.inc.php'; ?>