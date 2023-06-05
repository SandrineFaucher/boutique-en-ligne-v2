
<body>
    <header id="navigation">
      <nav class="navbar bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
          <div class="container-fluid d-flex text-white justify-content-around">
          <a class="navbar-brand" href="index.php" ><img src="./images/SF (1).png" alt="logo"> </a>
          <a class="nav-link" href="index.php">Accueil</a>
          <a class="nav-link" href="panier.php"><i class="fa-solid fa-bag-shopping"></i> <?= count($_SESSION['panier']) ?> </a>
        </div>
      </nav>
    </header>
   
    