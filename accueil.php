<?php

    $titre_page="Accueil";
    include 'header.inc.php';
    include 'navbars.inc.php';
?>

<div class="d-flex justify-content-center">
    <h2 class="ombre-bleue margin-debut">TRANSPIRE<br>L'INTELLIGENCE</h2>
</div>

<section class="row align-items-center g-0 g-sm-0" id="section-debut">
    <div class="col-12 col-sm-5 offset-3 offset-sm-0">
        <img src="./assets/img/runner avec mur.jpg" alt="homme qui court" class="img-fluid taille-img">
    </div>
    
    
    <div class="col-12 col-sm-7 offset-3 offset-sm-0">
        <div class="superposition-parent">
            <div class="d-flex flex-column justify-content-center align-items-center cellule-texte superposition-enfant">
                <p>Courir n'a jamais été aussi amusant ! Esig'Running est le club d'athlétisme de l'ESIGELEC pour ses étudiants et personnel. Parce qu'on ne peut travailler avec des personnes malades, vous devez prendre soin de votre corps ! Rejoignez la course !</p>
            </div>
            <img src="./assets/img/Design special.png" alt="design special" class="superposition-enfant-bg img-fluid">
            <img src="./assets/img/chaussure.png" alt="chaussure peu opaque" class="img-fluid superposition-enfant-bg-2">
        </div>
    </div>
</section>

<div class="margin-haut row">
    <img src="./assets/img/Traces de pas.png" alt="traces de pas" class="col-3 offset-3">
</div>

<section id="section-milieu" class="superposition-parent">
    <div class="d-flex flex-column justify-content-center align-items-start cellule-texte cellule-2">
        <h2 class="ombre-bleue margin-h2">PRENDS SOIN<br>DE TON CORPS</h2>
        <p>On ne peut bien évidemment pas pratiquer une activité sportive comme un bourrin ! Esig'Running met l'accent sur l'hydratation ainsi que les étirements. Chez nous tu apprendras de nouvelles techniques d'étirements !</p>
    </div>
</section>

<?php

    include 'footer.inc.php';
?>