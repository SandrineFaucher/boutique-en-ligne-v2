<?php
//fichier des fonctions pour pouvoir les appeler ici
include 'functions.php';

// Initialiser la sessition et accéder à la surpeglobale $_SESSION (tableau associatif)
session_start();

// initialiser le panier 
createCart();
//var_dump($_SESSION);

//fichier head avec les balises de bases + le head pour ne pas répéter dans chaque page
include './head.php';
?>


<body>
    <!--intégration de la navbar-->
    <?php
    //Je vérifie si je viens du bouton valider ma commande de la page de validation************
    if (isset($_GET['commandeValidee'])) {
        // dans ce cas je vide mon panier puisque ma commande est validée !**********************
        viderPanier($_SESSION['panier']);
    }
    include './header.php';
    ?>

    <main>
        <div class="row text-center mt-5 mb-5">
            <h1> Inscription </h1>
        </div>
        <div class="container-fluid">




    </main>










    <?php
    // fichier footer qui se repetera sur chaque page
    include 'footer.php';
    ?>