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

    // si je viens du bouton détail de la page mescommandes 
    if (isset($_POST['commandeId'])) {
        $articles = recupArticlesCommande();
    }

    include './header.php';
    ?>


    <main class="container-fluid ml-5 mr-5">
        <div class="container-fluid items text-center mt-5">
            <h1> Détail de mes commandes </h1>
        </div>
        <table class="table mt-5 mb-5 table-info">
            <thead>
                <tr>
                    <th scope="col">Article</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Montant</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($articles as $article)
                    echo "
                <tr>
                    <th scope=\"row\">" . $article['nom'] . "</th>
                    <td>" . $article['prix'] . "</td>
                    <td> " . $article['quantite'] . "</td>
                    <td>" . $article['prix'] * $article['quantite'] . " €</td>
                </tr>"
                ?>
            </tbody>
        </table>

        <button class="">
            Retour au compte
        </button>







    </main>

    <?php
    // fichier footer qui se repetera sur chaque page
    include 'footer.php';
    ?>