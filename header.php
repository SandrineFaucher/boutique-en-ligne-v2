<body>
  <header id="navigation">
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
      <div class="container-fluid text-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-around" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="./index.php"><img src="./images/SF (1).png" alt="logo"></a>
          <ul class="navbar-nav  d-flex justify-content-around">
            <li class="nav-item">
              <a class="nav-link active p-5" aria-current="page" href="./index.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active p-5" aria-current="page" href="./panier.php"><i class="fa-solid fa-bag-shopping"></i> <?= count($_SESSION['panier']) ?> </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>