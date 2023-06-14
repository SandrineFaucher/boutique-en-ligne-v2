<?php
//fichier des fonctions pour pouvoir les appeler ici
include 'functions.php';

// Initialiser la sessition et accéder à la surpeglobale $_SESSION (tableau associatif)
session_start();

// initialiser le panier 
createCart();
//var_dump($_SESSION);

// Je vérifie si je viens du bouton connection ********************************************
if (isset($_POST['connection'])) {
  // J"initialise une session de connection
  createConnection();
}

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

  // *****************déconnexion************************************************************
  // si je viens du formulaire de déconnection 
  if (isset($_POST['deconnection'])) {
    deconnection();
  }

  include './header.php';
  ?>

  <main>
  <h2 class="text-center m-5">
  <?php if ($_SESSION['client']){
    echo "Bonjour"." ". $_SESSION['client']['nom']." ".$_SESSION['client']['prenom'];
  }
  ?>
  </h2>

    <h1 class="text-center m-5">Bienvenue dans ma boutique</h1>
    <div class="container-fluid">
      <div class="row d-flex justify-content-evenly text-center"><!--début de la row-->

        <?php
        // je déclare la variable qui contient mon tableau d'articles 
        // sa valeur, c'est le tableau d'articles renvoyé par la fonction getArticles
        $articles = getArticles();

        // je teste cette variable pour vérifier que j'ai bien mes 3 articles
        //var_dump($articles);


        //je lance ma boucle pour afficher une card bootstrap par article
        foreach ($articles as $article) {
          echo "<div class=\"card\" col-md-4 style=\"width: 18rem; \"text-center\">
        <img src=\"./images/" . $article['image'] . "\" class=\"card-img-top\" alt=\"...\">
        <div class=\"card-body\">
        <h5 class=\"card-title\">" . $article['nom'] . "</h5>
        <p class=\"card-text\">" . $article['description'] . "</p>
        <p class=\"card-text\">" . $article['prix'] . " € </p>

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

        ?>

      </div><!--fin de la row-->
    </div><!--fin du container-->
  </main>


  <?php
  // fichier footer qui se repetera sur chaque page
  include 'footer.php';
  ?>