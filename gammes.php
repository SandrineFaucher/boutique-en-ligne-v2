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

    <main class="container-fluid ml-5 ">
        <div class="row text-center mt-5 mb-5">
            <h1> Nos gammes </h1>
        </div>

        <div class="container-fluid">
            <?php
            //*************/ j'affiche les gammes avec la fonction getGammes($id)*********//
            // var_dump(getGammes());
            $gammes = getGammes();

            foreach ($gammes as $gamme) {

                echo "
                <div class=\"container text-center mt-5 mb-5\">
                <h2>" . $gamme['nom'] . "</h2>
                </div>


                <div class=\"container-fluid\">
                <div class=\"row d-flex justify-content-evenly text-center\"><!--début de la row-->";

                $articles = getArticlesByGamme($gamme['id']);

                foreach ($articles as $article) {
                    echo "<div class=\"card\" col-md-4 style=\"width: 18rem; \"text-center\">
                    <img src=\"./images/" . $article['image'] . "\" class=\"card-img-top\" alt=\"...\">
                    <div class=\"card-body\">
                    <h5 class=\"card-title\">" . $article['nom'] . "</h5>
                    <p class=\"card-text\">" . $article['description'] . "</p>
              
                    <form method=\"GET\" action=\"./produit.php\">
                    <input type=\"hidden\" name=\"productId\" value=\"" . $article['id'] . "\">
                    <input type=\"submit\" class=\"btn btn-sm btn-outline-primary\" value=\"Détail produit\">
                    </form> </br>
      
                    <form method=\"GET\" action=\"./panier.php\">
                    <input type=\"hidden\" name=\"productId\" value=\"" . $article['id'] . "\">
                    <input type=\"submit\" class=\"btn btn-sm btn-success\" value=\"Ajouter au panier\">
                    </form>
                    </div>
                    </div>";
                }
            }
            ?>
        </div>
        </div>
 
    </main>

    <?php
    // fichier footer qui se repetera sur chaque page
    include 'footer.php';
    ?>