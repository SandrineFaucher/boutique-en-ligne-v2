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
        <div class="container-fluid items text-center mt-5">
            <h1> Modifier Mon adresse </h1>
        </div>

        <form method="POST" action="./modifadresse.php">
            <div class="mb-3">
                <label for="validationCustom02" class="form-label">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="validationCustom02" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-3">
                <label for="validationCustom05" class="form-label">Code postal</label>
                <input type="text" class="form-control" name="codepostal" id="validationCustom05" required>
                <div class="invalid-feedback">
                    Veuillez sélectionner un code postal valide
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustom03" class="form-label">Ville</label>
                <input type="text" class="form-control" name="ville" id="validationCustom03" required>
                <div class="invalid-feedback">
                    Veuillez sélectionner une ville valide
                </div>
            </div>

            <div class="col-12 mt-5 text-center">
                <input type="hidden" name="inscription">
                <button class="btn btn-primary" type="submit">Valider</button>
            </div>
            </div>
        </form>

        <div class="container-fluid items">
            <div class="row">
                <div class="col-md-4 text-center mt-5 mb-5">
                    <i class="fa-solid fa-circle-info mt-2 mb-2"></i>
                    <form method="POST" action="./modifinfos.php">
                        <button type="submit" class="btn btn-sm btn-secondary mt-5">
                            Modifier mes informations
                        </button>
                    </form>
                </div>

                <div class="col-md-4 text-center mt-5 mb-5">
                    <i class="fa-solid fa-unlock-keyhole mt-2 mb-2 "></i>
                    <form method="POST" action="./modifmdp.php">
                        <button type="submit" class="btn btn-sm btn-secondary mt-5">
                            Modifier mon mot de passe
                        </button>
                    </form>

                </div>

                <div class="col-md-4 text-center mt-5 mb-5">
                    <i class="fa-solid fa-clipboard-list mt-2 mb-2 "></i>
                    <form method="POST" action="./mescommandes.php">
                        <button type="submit" class="btn btn-sm btn-secondary mt-5">
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