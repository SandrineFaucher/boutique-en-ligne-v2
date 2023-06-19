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

    <main class="container-fluid ml-5 mr-5">
        <div class="row text-center mt-5 mb-5">
            <h1> Mon compte </h1>
        </div>
        <div class="text-center user">
            <i class="fa-solid fa-user mt-5 mb-5"></i>
        </div>


        <div class="container-fluid items">
            <div class="row">

                <div class="col-md-3 text-center mt-5 mb-5">
                    <i class="fa-solid fa-circle-info mt-2 mb-2"></i>
                    <form method="POST" action="./modifinfos.php">
                        <button type="submit" class="btn btn-sm btn-secondary mt-5">
                            Modifier mes informations
                        </button>
                    </form>
                </div>

                <div class="col-md-3 text-center mt-5 mb-5">
                    <i class="fa-solid fa-unlock-keyhole mt-2 mb-2 "></i>
                    <form method="POST" action="./modifmdp.php">
                        <button type="submit" class="btn btn-sm btn-secondary mt-5">
                            Modifier mon mot de passe
                        </button>
                    </form>

                </div>

                <div class="col-md-3 text-center mt-5 mb-5">
                    <i class="fa-solid fa-house mt-2 mb-2"></i>
                    <form method="POST" action="./modifadresse.php">
                        <button type="submit" class="btn btn-sm btn-secondary mt-5">
                            Modifier mon adresse
                        </button>
                    </form>

                </div>

                <div class="col-md-3 text-center mt-5 mb-5">
                    <i class="fa-solid fa-clipboard-list mt-2 mb-2 "></i>
                    <form method="POST" action="./mescommandes.php">
                        <button type="submit" name="recupcommande" class="btn btn-sm btn-secondary mt-5">
                            Voir mes commandes
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </main>


    <?php
    // fichier footer qui se repetera sur chaque page
    include 'footer.php';
    ?>