<?php
  require_once("sesja.php");
  if(!isset($_COOKIE['user']) || !isset($_COOKIE['haslo']))
  {
    if(!isset($_COOKIE['userA']))
    {
      header('Location: index.php');
      die();
    }
  }
?>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logowanie</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styl.css" rel="stylesheet">
  </head>
  <body class="background">
    <header class="web">
      <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">Powrót</a>
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
          <div class="p-2 mt-5 col-lg-4 bg-light text-center">
            <h1>Logowanie</h1>
            <br>
            <?php
              if(isset($_COOKIE['userA']))
              {
                echo('<div>');
                  echo("<p>".$_COOKIE['userA']."</p>");
                  echo('<a href="logowanie2.php" class="btn">Zaloguj się</a><br>');
                  echo('<a href="usun.php" class="btn">Usuń</a><br>');
                echo('</div>');
              }
              if(isset($_COOKIE['user']) && isset($_COOKIE['haslo']))
              {
                echo('<div>');
                  echo("<p>".$_COOKIE['user']."</p>");
                  echo('<a href="logowanie2.php" class="btn">Zaloguj się</a><br>');
                  echo('<a href="usun.php" class="btn">Usuń</a><br>');
                echo('</div>');
              }
            ?>
            <a href="logowanie.php" class="btn">Zmień konto</a>
          </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src=js/funkcje.js></script>
  </body>
</html>