<?php
  require_once("sesja.php");
  require_once("baza.php");
  if(!isset($_SESSION["id"]) && !isset($_SESSION['uprawnienia']))
  {
    header("Location: index.html");
    die();
  }
  if($_SESSION['uprawnienia']==0)
  {
    header("Location: glowna.php");
    die();
  }
  $id = $_SESSION["id"];
  $p=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if(!$p) blad("Błąd połączenia z bazą!");
?>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zaplecze</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styl.css" rel="stylesheet">
  </head>
  <body class="background">
    <header>
      <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-5 pe-3">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php
                    $q='select nazwaUz from konta where id='.$id.';';
                    $wynik=mysqli_query($p,$q);
                    $w=mysqli_fetch_assoc($wynik);
                    echo($w['nazwaUz']);
                  ?>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="zmienNazw.php">Zmień nazwę</a></li>
                  <li><a class="dropdown-item" href="zmienHaslo.php">Zmień hasło</a></li>
                  <li><a class="dropdown-item" href="logout.php">Wyloguj</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <?php
        if(isset($_SESSION['komunikat']))
        {
          echo('<h1 style="text-align: center">'.$_SESSION['komunikat'].'</h1>');
          unset($_SESSION['komunikat']);
        }
      ?>
      <div class="container">
        <div class="d-flex flex-column align-items-center mt-5" style="height: 500px; overflow-y:scroll;">
          <?php
            $q='select zgloszenia.id, tytul, data, stan.nazwa, konto_id from zgloszenia inner join stan on zgloszenia.status_id=stan.id order by status_id ASC, data DESC;';
            $wynik=mysqli_query($p,$q);
            while($w=mysqli_fetch_assoc($wynik))
            {
              $idAu=$w['konto_id'];
              $q2='select czyAnonim from konta where id="'.$idAu.'";';
              $wynik2=mysqli_query($p,$q2);
              $w2=mysqli_fetch_assoc($wynik2);
              echo('<div class="p-2 mt-5 col-lg-4 bg-light text-center">');
                echo('<h1>'.$w['tytul'].'</h1>');
                echo('<h3>Status: '.$w['nazwa'].'</h3>');
                if($w2['czyAnonim']==0)
                {
                  $q3='select imie, nazwisko from konta where id="'.$idAu.'";';
                  $wynik3=mysqli_query($p,$q3);
                  $w3=mysqli_fetch_assoc($wynik3);
                  echo('Autor: '.$w3['imie'].' '.$w3['nazwisko'].'<br>');
                }
                else
                  echo('Autor: anonimowy<br>');
                echo($w['data']);
                echo('<form method="POST" action="rozpatrzenie.php" enctype="multipart/form-data">');
                  echo('<input type="text" name="idz" value="'.$w['id'].'" hidden>');
                  echo('<input type="submit" value="Rozpatrz">');
                echo('</form>');
              echo('</div>');
            }
          ?>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php
  mysqli_close($p);
?>