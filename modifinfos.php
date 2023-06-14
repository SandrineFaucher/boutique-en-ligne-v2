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
            <h1> Modifier mes informations </h1>
        </div>

        <form method="POST" action="./modifinfos.php">
            <div class="row">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" required>

                </div>
                <div class="mb-3">
                    <label for="validationCustom02" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" id="validationCustom02" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3 mt-5">
                    <label for="exampleInputEmail1" class="form-label">Email </label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre e-mail avec quelqu'un d'autre.</div>
                </div>
            </div>
            
            <div class="col-12 mt-5 text-center">
                <button class="btn btn-primary" type="submit" name="connection">
                    Valider
                </button>
            </div>

        </form>

        <div class="row">
            <div class="col-md-4 text-center mt-5 mb-5">
                <i class="fa-solid fa-unlock-keyhole mt-2 mb-2 "></i>
                <form method="POST" action="./modifmdp.php">
                    <button type="submit" class="btn btn-sm btn-secondary mt-5">
                        Modifier mon mot de passe
                    </button>
                </form>

            </div>

            <div class="col-md-4 text-center mt-5 mb-5">
                <i class="fa-solid fa-house mt-2 mb-2"></i>
                <form method="POST" action="./modifadresse.php">
                    <button type="submit" class="btn btn-sm btn-secondary mt-5">
                        Modifier mon adresse
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