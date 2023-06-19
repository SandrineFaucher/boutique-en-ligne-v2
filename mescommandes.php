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

    // j'appelle ma fonction recuparation commande 
    $commandes = recupCommande();



    include './header.php';
    ?>

    <main class="container-fluid ml-5 mr-5">
        <div class="container-fluid items text-center mt-5">
            <h1> Mes commandes </h1>
        </div>

        <table class="table table-info mt-5 mb-5">
            <thead>
                <tr>
                    <th scope="col">Numero</th>
                    <th scope="col">Date</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($commandes as $commande) {
                    echo "
    <tr>
      <th scope=\"row\">" . $commande['numero'] . "</th>
      <td>" . $commande['date_commande'] . "</td>
      <td>" . $commande['prix'] . "</td>

      <td>
      <form method=\"POST\" action=\"detailscommande\">
      <input type=\"hidden\" name=\"commandeId\" value=\"" . $commande['id'] . "\">
      <button type=\"submit\" class=\"btn btn-sm btn-secondary\">
        Détails
      </button>
      </form>
      </td>
    </tr>
    </table>
    ";
    }
    ?>

                

    </main>

    <?php
    // fichier footer qui se repetera sur chaque page
    include 'footer.php';
    ?>