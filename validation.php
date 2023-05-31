
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
     ?>
  </main>


  <?php
  include 'footer.php';
  ?>






  