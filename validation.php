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
  // Je teste les changements dans le panier avant de les afficher dans le panier*/
  if (isset($_GET['quantite'])) {
    modifQuantite($_GET['quantite'], $_GET['productId']);
  }

  // si je viens du bouton supprimer*********************************************
  if (isset($_GET['Idtodelate'])) {
    // je supprime l'élément ****************************************************
    delateArticle($_GET['Idtodelate']);
  }

  // si je viens du formulaire coordonnées
  if (isset($_POST['coordonnees'])) {
    // je je peux modifier les coordonnées****************************************************
    modifInfos();
  }
  
  // si je viens du formulaire adresselivraison
  if (isset($_POST['adresselivraison'])) {
    // je peux modifier l'adresse'****************************************************
    modifAdresse();
    adressLivraison();
  }
  // si je viens du formulaire adressefacturation je peux modifier les infos
  if (isset($_POST['adressefacturation'])){
    modifAdresse();
  }

  include 'header.php';
  ?>

  <main>
    <div class="row text-center mt-5 mb-5">
      <h1> Je valide ma commande </h1>
    </div>
    <?php



    // j'affiche les articles du panier */
    foreach ($_SESSION['panier'] as $article) {
      echo "<div class=\"row  text-bg-light p-3 \">
         <div class=\"col-md-2 d-flex justify-content-center justify-content-lg-end\">
         <img src=\"./images/" . $article['image'] . "\" class=\"card-img-top x-center\" alt=\"robe-panier\">
         </div>
         <div class=\"card-body col-md-2 text-center my-auto d-flex justify-content-center justify-content-lg-start \">
         <h5 class=\"card-title\">" . $article['nom'] . "</h5>
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
         <p class=\"card-text\">" . $article['prix'] * $article['quantite'] . " €</p>
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

    <!-- Coordonnées et adresse de livraison --->

    <div class="text-center mt-5">
      <h3> Coordonnées </h3>
    </div>

    <form method="POST" action="validation.php">
      <?php if (isset($_SESSION['client'])) {
        echo
        "<div class=\"mb-3\">
                    <label for=\"nom\" class=\"form-label\">Nom</label>
                    <input type=\"text\" class=\"form-control\" name=\"nom\" value=\"" . $_SESSION['client']['nom'] . "\" required>
                </div>

                <div class=\"mb-3\">
                    <label for=\"validationCustom02\" class=\"form-label\">Prénom</label>
                    <input type=\"text\" class=\"form-control\" name=\"prenom\" value=\"" . $_SESSION['client']['prenom'] . "\" id=\"validationCustom02\" required>
                    <div class=\"valid-feedback\">
                        Looks good!
                    </div>
                </div>
                <div class=\"mb-3 mt-5\">
                    <label for=\"exampleInputEmail1\" class=\"form-label\">Email </label>
                    <input type=\"email\" class=\"form-control\" name=\"email\"  value=\"" . $_SESSION['client']['email'] . "\" id=\"exampleInputEmail1\" aria-describedby=\"emailHelp\" required>
                    <div id=\"emailHelp\" class=\"form-text\">Nous ne partagerons jamais votre e-mail avec quelqu'un d'autre.</div>
                </div>
            </div>";
      }
      ?>
      <div class="col-12 mt-5 text-center">
        <button class="btn btn-primary" type="submit" name="coordonnees">
          Valider mes coordonnées
        </button>
      </div>
    </form>

    <div class="text-center mt-5">
      <h3> Adresse de livraison </h3>
    </div>

    <form method="POST" action="./validation.php">
      <div class="mb-3">
        <label for="validationCustom02" class="form-label">Adresse</label>
        <input type="text" class="form-control" name="adresse" value="<?= $livraison['adresse'] ?> " id="validationCustom02" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-3">
        <label for="validationCustom05" class="form-label">Code postal</label>
        <input type="text" class="form-control" name="code_postal" value="<?= $_SESSION['adresse']['code_postal'] ?>" id="validationCustom05" required>
        <div class="invalid-feedback">
          Veuillez sélectionner un code postal valide
        </div>
      </div>
      <div class="col-md-6">
        <label for="validationCustom03" class="form-label">Ville</label>
        <input type="text" class="form-control" name="ville" value="<?= $_SESSION['adresse']['ville'] ?>" id="validationCustom03" required>
        <div class="invalid-feedback">
          Veuillez sélectionner une ville valide
        </div>
      </div>

      <div class="col-12 mt-5 text-center">
        <button class="btn btn-primary" name="adresselivraison" type="submit">
          Valider mon adresse de livraison
        </button>
      </div>
      </div>
<?= var_dump(adressLivraison()); ?>



    </form>
    <div class="text-center mt-5">
      <h3> Adresse de Facturation </h3>
    </div>

    <form method="POST" action="./validation.php">
      <div class="mb-3">
        <label for="validationCustom02" class="form-label">Adresse</label>
        <input type="text" class="form-control" name="adresse" value="<?= $_SESSION['adresse']['adresse'] ?> " id="validationCustom02" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-3">
        <label for="validationCustom05" class="form-label">Code postal</label>
        <input type="text" class="form-control" name="code_postal" value="<?= $_SESSION['adresse']['code_postal'] ?>" id="validationCustom05" required>
        <div class="invalid-feedback">
          Veuillez sélectionner un code postal valide
        </div>
      </div>
      <div class="col-md-6">
        <label for="validationCustom03" class="form-label">Ville</label>
        <input type="text" class="form-control" name="ville" value="<?= $_SESSION['adresse']['ville'] ?>" id="validationCustom03" required>
        <div class="invalid-feedback">
          Veuillez sélectionner une ville valide
        </div>
      </div>

      <div class="col-12 mt-5 text-center">
        <button class="btn btn-primary" name="adressefacturation" type="submit">
          Valider mon adresse de facturation
        </button>
      </div>
      </div>
    </form>









    <!--je valide ma commande avec un modal bootstrap --->
    <!-- Button trigger modal -->
    <div class="bouton d-flex justify-content-center justify-content-lg-center mt-5">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Je confirme mon achat
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