
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
    <h1> Panier </h1>
     <?php
     // je vérifie s'il y a un ajout au panier
    if (isset ($_GET['productId'])){
        
     // je récupère l'id transmis par le formulaire dans une variable
     $productId = $_GET['productId'];

     // je récupère l'article qui correspond à l'id
    
     $article = getArticleFromId($productId);
     //var_dump($article);

     //j'ajoute l'article dans mon panier avec la fonction addToCart($article)
     addToCart($article);

     var_dump($_SESSION);
    }
     ?>
  </main>


  <?php
  include 'footer.php';
  ?>






  