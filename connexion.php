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

    //Je vérifie si je viens du formulaire de la page d'inscription************
    if (isset($_POST['inscription'])) {

        // j'affiche le message de succès ou d'erreur suite à l'inscription //
        



    }
    include './header.php';
    ?>

    <main>
        <div class="row text-center mt-5 mb-5">
            <h1> Se connecter </h1>
        </div>
        <div class="container-fluid">

            <?php 
            var_dump($_POST);
            
            var_dump(createUser());
           
            ?>

        </div>









    </main>






    <?php
    // fichier footer qui se repetera sur chaque page
    include 'footer.php';
    ?>