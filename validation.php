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
    <div class="row text-center">
      <h1> Validation du panier </h1>
    </div>
    <?php

    // j'affiche les articles du panier */
    foreach ($_SESSION['panier'] as $article) {
      echo "<div class=\"row  text-bg-light p-3 \">
         <div class=\"col-md-2\">
         <img src=\"./images/" . $article['picture'] . "\" class=\"card-img-top x-center\" alt=\"robe-panier\">
         </div>
         <div class=\"card-body col-md-2 text-center d-flex align-items-center \">
         <h5 class=\"card-title\">" . $article['name'] . "</h5>
         </div>
         
 
         <div class=\"col-md-2 text-center d-flex align-items-center\">
         <form method=\"GET\" action=\"./panier.php\">
         <input type=\"hidden\" name=\"productId\" value=\"" . $article['id'] . "\">       
         <input type=\"number\" min=\"1\" max=\"100\" name=\"quantite\" class=\"btn\" value=\"" . $article['quantite'] . "\">
         <input type=\"submit\" class=\"btn btn-success\" value=\"Modifier \">
         </form>
         </div>
 
         <div class=\"col-md-2 text-center d-flex align-items-center\">
         <form method=\"GET\" action=\"./panier.php\">
         <input type=\"hidden\" name=\"Idtodelate\" value=\"" . $article['id'] . "\">
         <button type=\"submit\" class=\"btn btn-danger\"> 
         supprimer
         </button>
         </form>
         </div>
 
         <div class=\"col-md-2 text-center d-flex align-items-center\">
         <p class=\"card-text\">" . $article['price'] . "€</p>
         </div>";
    }

    // j'affiche le total du panier ********************************************************
    echo "<div class=\"row  text-bg-light p-3 \">
       <div class=\"col-md-6 d-flex justify-content-end\">
       <p> Total du panier </p>
       </div> 
       <div class=\"col-md-6 d-flex justify-content-end\">
       <p>" . totalArticles() . "€</p>
       </div>";

    // j'affiche le calcul des frais de port ************************************************
    echo "<div class=\"row  text-bg-light p-3 \">
      <div class=\"col-md-6 d-flex justify-content-end\">
      <p> Frais de port 3€/article </p>
      </div> 
      <div class=\"col-md-6 d-flex justify-content-end\">
      <p>" . fraisDePort($_SESSION['panier']) . " €</p>
      </div>";

    // j'affiche le total général avec les frais de port*************************************
    echo "<div class=\"row  text-bg-light p-3 \">
      <div class=\"col-md-6 d-flex justify-content-end\">
      <p> Total à payer </p>
      </div> 
      <div class=\"col-md-6 d-flex justify-content-end\">
      <p>" . fraisDePort($article) + totalArticles() . " €</p>
      </div>";
    ?>
    <!--je valide ma commande avec un modal bootstrap --->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      Je valie ma commande
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Votre commande est validée ! </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
           Nous vous remercions pour votre confiance. 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form method="GET" action="./index.php">
            <input type="hidden" name="commandeValidee">
            <button type="submit" class="btn btn-success">
              ok
            </button>
            </form>

          </div>
        </div>
      </div>
    </div>


  </main>


  <?php
  include 'footer.php';
  ?>