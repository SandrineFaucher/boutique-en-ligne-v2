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

    // modification du mot de passe //

    // si je viens du formulaire modifmotdepasse //
    if (isset($_POST['modifmotdepasse'])) {

        // j'appelle la fonction qui le modifie //
        modifMotDePasse();
    }


    include './header.php';
    ?>

    <main>
        <div class="container-fluid items text-center mt-5">
            <h1> Modifier mon mot de passe </h1>
        </div>

        <div class="formulaire p-5">
            <form method="POST" action="./modifmdp.php">
                <div class="container-fluid">
                    <div class="row">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Ancien mot de passe</label>
                            <input type="password" name="oldPassword" class="form-control" placeholder="mot de passe" id="exampleInputPassword1">


                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="newPassword" class="form-control" placeholder="nouveau mot de passe" id="exampleInputPassword1">
                            <label> minimum 8 caractères et maximum 15, minimum 1 lettre, 1 chiffre et 1 caractère spécial (@$!%*?/&)</label>
                        </div>

                        <div class="col-12 mt-5 text-center">
                            <button class="btn btn-primary" type="submit" name="modifmotdepasse">
                                Valider
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="container-fluid items">
            <div class="row text-center mt-5 mb-5">
                <div class="col-md-4 text-center mt-5 mb-5">
                    <i class="fa-solid fa-circle-info mt-2 mb-2"></i>
                    <form method="POST" action="./modifinfos.php">
                        <button type="submit" class="btn btn-sm btn-secondary mt-5">
                            Modifier mes informations
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


    </main>


    <?php
    // fichier footer qui se repetera sur chaque page
    include 'footer.php';
    ?>