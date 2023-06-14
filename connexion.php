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

        // si je viens du formulaire d'inscription j'insert les champs en base de données à partir de la fonction creatUser()
        createUser();
    }

    // si je vien du formulaire 

    include './header.php';
    ?>

    <main>
        <div class="container-fluid">

            <?php
            //var_dump($_POST);
            //var_dump(createUser());

            ?>

            <div class="row text-center mt-5 mb-5">
                <h1> Se Connecter </h1>

            </div>

            <form method="POST" action="./index.php">
                <div class="container-fluid">
                    <div class="row">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email </label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre e-mail avec quelqu'un d'autre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                            <input type="password" name="mot_de_passe" class="form-control" id="exampleInputPassword1">
                        </div>

                        <div class="col-12 mt-5 text-center">
                            <button class="btn btn-primary" type="submit" name="connection">
                                Valider
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row text-center mt-5 mb-5">
            </form>
            <form method="POST" action="./inscription.php">
                <h3> Pas encore inscrit ? </h3>
                <button type="submit" class="btn btn-sm btn-secondary mt-5">
                    Je crée mon compte
                </button>
            </form>
        </div>
        </div>


    </main>






    <?php
    // fichier footer qui se repetera sur chaque page
    include 'footer.php';
    ?>