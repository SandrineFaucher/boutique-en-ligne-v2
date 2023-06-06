<?php
//fichier des fonctions pour pouvoir les appeler ici
include 'functions.php';


session_start();

// initialiser le panier 
createCart();

//fichier head avec les balises de bases + le head pour ne pas répéter dans chaque page
include 'head.php';
?>


<body>

  <?php
  include 'header.php';
  ?>

  <main>
    <div class="row text-center mt-5 mb-5">
      <h1> Je valide ma commande </h1>
    </div>
    <?php

    // Je teste les changements dans le panier avant de les afficher dans le panier*/
    if (isset($_GET['quantite'])) {
      modifQuantite($_GET['quantite'], $_GET['productId']);
    }

    // si je viens du bouton supprimer*********************************************
    if (isset($_GET['Idtodelate'])) {
      // je supprime l'élément ****************************************************
      delateArticle($_GET['Idtodelate']);
    }

    // j'affiche les articles du panier */
    foreach ($_SESSION['panier'] as $article) {
      echo "<div class=\"row  text-bg-light p-3 \">
         <div class=\"col-md-2 d-flex justify-content-center justify-content-lg-end\">
         <img src=\"./images/" . $article['picture'] . "\" class=\"card-img-top x-center\" alt=\"robe-panier\">
         </div>
         <div class=\"card-body col-md-2 text-center my-auto d-flex justify-content-center justify-content-lg-start \">
         <h5 class=\"card-title\">" . $article['name'] . "</h5>
         </div>
         
 
         <div class=\"col-md-2 text-center d-flex align-items-center d-flex justify-content-center justify-content-lg-end mt-2\">
         <form method=\"GET\" action=\"./validation.php\">
         <input type=\"hidden\" name=\"productId\" value=\"" . $article['id'] . "\">       
         <input type=\"number\" min=\"1\" max=\"100\" name=\"quantite\" class=\"btn\" value=\"" . $article['quantite'] . "\">
         <input type=\"submit\" class=\"btn btn-sm btn-success\" value=\"Modifier \">
         </form>
         </div>
 
         <div class=\"col-md-2 text-center d-flex align-items-center d-flex justify-content-center justify-content-lg-end \">
         <form method=\"GET\" action=\"./validation.php\">
         <input type=\"hidden\" name=\"Idtodelate\" value=\"" . $article['id'] . "\">
         <button type=\"submit\" class=\"btn btn-sm btn-danger mt-5\"> 
         supprimer
         </button>
         </form>
         </div>
 
         <div class=\"col-md-2 text-center d-flex align-items-center d-flex justify-content-center justify-content-lg-end mt-5\">
         <p class=\"card-text\">" . $article['price'] * $article['quantite'] . " €</p>
         </div>
         </div>";
    }

    // j'affiche le total du panier ********************************************************
    echo "<div class=\"row  d-flex justify-content-center justify-content-lg-end\">
       <div class=\"col-md-6 d-flex justify-content-center justify-content-lg-end\">
       <p> Total du panier </p>
       </div> 
       <div class=\"col-md-6 text-center \">
       <p>" . totalArticles() . " €</p>
       </div>
       </div>";

    // j'affiche le calcul des frais de port ************************************************
    echo "<div class=\"row  d-flex justify-content-center justify-content-lg-end\" >
      <div class=\"col-md-6  d-flex justify-content-center justify-content-lg-end\">
      <p> Frais de port 3€/article </p>
      </div> 
      <div class=\"col-md-6 text-center \">
      <p>" . fraisDePort($_SESSION['panier']) . " €</p>
      </div>
      </div>";

    // j'affiche le total général avec les frais de port*************************************
    echo "<div class=\"row  d-flex justify-content-center justify-content-lg-end\" >
      <div class=\"col-md-6  d-flex justify-content-center justify-content-lg-end\">
      <p> Total à payer </p>
      </div> 
      <div class=\"col-md-6  text-center \">
      <p>" . fraisDePort($article) + totalArticles() . " €</p>
      </div>
      </div>";
    ?>

    <!--je valide ma commande avec un modal bootstrap --->
    <!-- Button trigger modal -->
    <div class="bouton d-flex justify-content-center justify-content-lg-center">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Je valide ma commande
      </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Votre commande est validée ! </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Montant total : <?= fraisDePort($article) + totalArticles() ?> €</p>
            <p>Nous vous remercions pour votre confiance.</p>
            <p>Expédition à partir du <?php
                                      // obtenir la date du jour formatée
                                      $date = date("d-m-Y");
                                      echo $date;
                                      ?> </p>
            <p>Livraison estimée le
              <?php
              // calcul : date du jour + 3 jours ********/
              // je récupère la date du jour en format DateTime (exigé par la fonction date_add)
              $date = new Datetime('now');
              // on utilise date_add pour ajouter 3 jours
              // date_interval...=> permet d'obtenir l'intervalle de temps souhaité pour l'ajouter
              date_add($date, date_interval_create_from_date_string("3 days"));
              // à ce stade, $date est directement modifiée
              // je l'affiche en la formatant : jour mois année => 09-06-2023
              echo date_format($date, "d-m-Y");
              ?>
            </p>
          </div>
          <div class="modal-footer">
            <form method="GET" action="./index.php">
              <input type="hidden" name="commandeValidee">
              <button type="submit" class="btn btn-success">
                Retour à l'accueil
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--intégration du footer-->
  <?php
  include './footer.php';
  ?>