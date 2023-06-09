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
            <h1> Créer mon compte </h1>
        </div>

        <div class="container-fluid">
            <div class="row">
                <form method="POST" action="./connexion.php" >
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom"  required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom02" class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom" id="validationCustom02" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom02" class="form-label">Adresse</label>
                        <input type="text" class="form-control" name="adresse" id="validationCustom02" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Code postal</label>
                        <input type="text" class="form-control" name="code_postal" id="validationCustom05" required>
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

            </div>

            <div class="row">
                <div class="mb-3 mt-5">
                    <label for="exampleInputEmail1" class="form-label">Email </label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre e-mail avec quelqu'un d'autre.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="mot_de_passe" id="exampleInputPassword1" required>
                   <label> minimum 8 caractères et maximum 15, minimum 1 lettre, 1 chiffre et 1 caractère spécial (@$!%*?/&)</label>
                </div>
            </div>
            <div class="col-12 mt-5 text-center">
                <input type="hidden" name="inscription">
                <button class="btn btn-primary" type="submit">Valider</button>
            </div>
        </div>
        </form>
        
    </main>
    
    <?php
    // fichier footer qui se repetera sur chaque page
    include 'footer.php';
    ?>