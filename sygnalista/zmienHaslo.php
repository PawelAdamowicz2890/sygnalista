<?php
    require_once("sesja.php");
    require_once("baza.php");
    if(!isset($_SESSION["id"]) && !isset($_SESSION['uprawnienia']))
    {
    header("Location: index.html");
    die();
    }
    $id = $_SESSION["id"];
    $p=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(!$p) blad("Błąd połączenia z bazą!")
?>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zmień nazwę</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styl.css" rel="stylesheet">
    </head>
    <body class="background">
        <header>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <?php
                        if($_SESSION['uprawnienia']==0)
                            echo('<a class="navbar-brand" href="glowna.php">Powrót</a>');
                        else if($_SESSION['uprawnienia']== 1)
                            echo('<a class="navbar-brand" href="zaplecze.php">Powrót</a>');
                    ?>
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
                                    <li><a class="dropdown-item" href="zminenHaslo.php">Zmień hasło</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Wyloguj</a></li>
                                </ul>
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
                    <form method="POST" action="zmienHaslo2.php">
                        Podaj nowe hasło: <input type="password" name="hasloN" required><br>
                        Powtórz nowe hasło: <input type="password" name="haslo2N" required><br><br>
                        <input type="submit" value="Zmień hasło">
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
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php
    mysqli_close($p);
?>