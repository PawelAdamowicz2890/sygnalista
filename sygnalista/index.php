<?php
  require_once("sesja.php");
  if(isset($_COOKIE['user']) && isset($_COOKIE['haslo']))
  {
    header('Location: logowanieC.php');
    die();
  }
  if(isset($_COOKIE['userA']))
  {
    header('Location: logowanieC.php');
    die();
  }
  if(isset($_SESSION['id']) && isset($_SESSION['uprawnienia']))
  {
    if($_SESSION['uprawnienia']==1)
    {
      header('Location: zaplecze.php');
      die();
    }
    if($_SESSION['uprawnienia']==0)
    {
      header('Location: glowna.php');
      die();
    }
  }
?>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sygnalista</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styl.css" rel="stylesheet">
  </head>
  <body class="background">
    <header class="web">
      <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="rejestracja.php">Zarejestruj się</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logowanie.php">Zaloguj się</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div class="container">
        <div class="d-flex align-items-center justify-content-center mt-5" style="height: 250px;">
          <div class="p-2 mt-5 col-lg-4 bg-light shadow rounded-2 text-center">
            
          </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>