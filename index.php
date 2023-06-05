
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
  <?php 
  include './header.php';
  ?>

  <main>
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
    foreach($articles as $article){
      echo "<div class=\"card\" col-md-4 style=\"width: 18rem; \"text-center\">
        <img src=\"./images/". $article['picture']."\" class=\"card-img-top\" alt=\"...\">
        <div class=\"card-body\">
        <h5 class=\"card-title\">". $article['name']. "</h5>
        <p class=\"card-text\">". $article['description']. "</p>
        
        <form method=\"GET\" action=\"./produit.php\">

        <input type=\"hidden\" name=\"productId\" value=\"".$article['id']."\">
        
        <input type=\"submit\" class=\"btn btn-sm btn-outline-primary\" value=\"Détail produit\">
        </form> </br>

        <form method=\"GET\" action=\"./panier.php\">

        <input type=\"hidden\" name=\"productId\" value=\"".$article['id']."\">
        
        <input type=\"submit\" class=\"btn btn-sm btn-success\" value=\"Ajouter au panier\">
        </form>

        </div>
        </div>";
    }
    //Je vérifie si je viens du bouton valider ma commande de la page de validation************
    if (isset($_GET['commandeValidee'])){
      // dans ce cas je vide mon panier puisque ma commande est validée !**********************
      viderPanier($_SESSION['panier']);
    }
     ?>
  
   </div><!--fin de la row-->
   </div><!--fin du container-->
  </main>


  <?php
  // fichier footer qui se repetera sur chaque page
  include 'footer.php';
  ?>






  