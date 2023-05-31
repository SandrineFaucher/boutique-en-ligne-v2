
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
     <?php
     // 1) récupérer l'id transmis par le formulaire dans une variable
      $productId = $_GET['productId'];
      //var_dump($productId);// je teste ma variable

     // 2) récupérer le produit qui correspond à cet id
      $article = getArticleFromId($productId);
      //var_dump($article);
     // 3) afficher ses infos 
     ?>
<div class="row d-flex justify-content-center">
<div class="card text-center" style="width: 40rem;">
  <img src="./images/<?= $article['picture'] ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?= $article['name'] ?></h5>
    <p class="card-text"><?= $article['detailedDescription'] ?></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><?= $article['price'] ?></li>
  </ul>

   <form method="GET" action="./panier.php">
   <input type="hidden" name="productId" value="<?php $article['id'] ?>">        
   <input type="submit" class="btn btn-success" value="Ajouter au panier">
   </form>

  </div>
  </div>


  </main>


  <?php
  include 'footer.php';
  ?>






  