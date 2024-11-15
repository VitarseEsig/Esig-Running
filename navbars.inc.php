<?php
// Démarrer la session si elle n'est pas encore active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <nav class="navbar navbar-expand-lg light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between flex-fill" id="divNav1">
                <a class="navbar-brand" id="logo" href="./accueil.php">
                    <img src="./assets/img/logo-esigelec.png" alt="logo esigelec" class="d-inline-block align text-top img-fluid" id="logo-esig">
                    <h1 class="titre-logo">Esig'Running</h1>
                    <img src="./assets/img/bonhomme running.png" alt="homme qui court" class="img-fluid" id="logo-man">
                </a>

                <div class="d-inline-flex flex-column-reverse" id="compte-div">
                    <!-- Bouton Compte toujours affiché -->
                    <a href="./connexion.php" class="nav-link d-flex flex-column align-items-center">
                        <img src="./assets/img/connexion.png" alt="logo connexion" class="img-connexion img-fluid">
                        <h2 id="compte">Compte</h2>
                    </a>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Affiche le bouton "Se déconnecter" si l'utilisateur est connecté -->
                        <form action="deconnexion.php" method="post" style="display:inline;">
                            <button type="submit" class="btn btn-outline-danger">Se déconnecter</button>
                        </form>
                    <?php else: ?>
                        <!-- Bouton Se connecter si l'utilisateur n'est pas connecté -->
                        <a href="./connexion.php" class="btn btn-outline-primary">Se connecter</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="d-flex flex-fill justify-content-center">
            <a href="#section-entrainements" class="nav-link">Entraînements</a>
        </div>
    </nav>
</header>
