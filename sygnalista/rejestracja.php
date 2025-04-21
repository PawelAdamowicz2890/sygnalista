<?php
  require_once("sesja.php");
  unset($_POST['imie']);
  unset($_POST['nazwisko']);
  unset($_POST['nazwU']);
  unset($_POST['haslo']);
  unset($_POST['haslo2']);
  unset($_POST['mail']);
  unset($_POST['anonim[]']);
?>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rejestracja</title>
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
            <h1>Rejestracja</h1>
            <br>
            <form method="POST" action="rejestracja2.php">
              <table>
                <tr id="t1">
                  <td>Imie:</td>
                  <td>
                    <input type="text" name="imie" id="im" required>
                  </td>
                </tr>
                <tr id="t2">
                  <td>Nazwisko:</td>
                  <td>
                    <input type="text" name="nazwisko" id="nazw" required>
                  </td>
                </tr>
                <tr id="t3">
                  <td>Email:</td>
                  <td>
                    <input type="email" name="mail"  placeholder="tekst@poczta.yyy" id="mail" required>
                  </td>
                </tr>
                <tr>
                  <td>Nazwa użytkownika:</td>
                  <td>
                    <input type="text" name="nazwU" required>
                  </td>
                </tr>
                <tr id="t4">
                  <td>Hasło:</td>
                  <td>
                    <input type="password" name="haslo" id="haslo" required>
                  </td>
                </tr>
                <tr id="t5">
                  <td>Powtórz hasło:</td>
                  <td>
                    <input type="password" name="haslo2" id="haslo2" required>
                  </td>
                </tr>
              </table>
              <input type="checkbox" id="an" onclick="anonimowy()" name="anonim[]" value="0"> Chcę pozostać anonimowy<br><br>
              <input type="submit" value="Zarejestruj się">
            </form>
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
    <script src="js/funkcje.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>