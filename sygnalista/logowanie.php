<?php
  require_once("sesja.php");
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
          <div class="p-2 mt-5 col-lg-4 bg-light shadow rounded-2 text-center">
            <h1>Logowanie</h1>
            <br>
            <form method="POST" action="logowanie2.php">
              <table>
                <tr>
                  <td>Nazwa użytkownika:</td>
                  <td><input type="text" name="nazwU" required></td>
                </tr>
                <tr id="th">
                  <td>Hasło:</td>
                  <td><input type="password" name="haslo" id="has" required></td>
                </tr>
              </table>
              <?php
                if(!isset($_COOKIE['user']) || !isset($_COOKIE['haslo']))
                  echo('<input type="checkbox" id="ci" onclick="ciastka()" name="ciastka[]" value="0"> Zapisz dane logowania na 30 dni<br>');
                else
                echo('<input type="checkbox" id="ci" onclick="ciastka()" name="ciastka[]" value="0" disabled> Zapisz dane logowania na 30 dni<br>');
              ?>
              <?php
                if(!isset($_COOKIE['userA']))
                  echo('<input type="checkbox" id="anon" onclick="anonim()" name="anon[]" value="0"> Jestem anonimowym użytkownikiem!<br><br>');
                else
                echo('<input type="checkbox" id="anon" onclick="anonim()" name="anon[]" value="0" disabled> Jestem anonimowym użytkownikiem!<br><br>');
              ?>
              <input type="submit" value="Zaloguj się">
            </form>
            <a href="zapHaslo.php" style="text-decoration: none; color: black">Nie pamiętam hasła!</a>
            <?php
              if(isset($_SESSION['komunikat']))
              {
                echo('<p>'.$_SESSION['komunikat'].'</p>');
                unset($_SESSION['komunikat']);
              }
            ?>
          </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src=js/funkcje.js></script>
  </body>
</html>