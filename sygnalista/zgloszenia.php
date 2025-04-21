<?php
    require_once("sesja.php");
    require_once("baza.php");
    if(!isset($_SESSION["id"]) && !isset($_SESSION['uprawnienia']))
    {
        header("Location: index.php");
        die();
    }
    if($_SESSION['uprawnienia']==1)
    {
        header("Location: zaplecze.php");
        die();
    }
    $id = $_SESSION["id"];
    $p=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(!$p) blad("Błąd połączenia z bazą!");
    if(isset($_FILES['plik']))
    {
        unset($_FILES['plik']);
    }
?>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zgłoszenie</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styl.css" rel="stylesheet">
    </head>
    <body class="background">
        <main>
            <div class="container">
                <div class="d-flex align-items-center justify-content-center mt-5" style="height: 600px;">
                    <div class="p-2 mt-5 col-lg-4 bg-light text-center">
                        <form method="POST" action="zgloszenia2.php" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td>Tytył<sup><b>*</b></sup>:</td>
                                    <td>
                                        <input type="text" name="tyt" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rodzaj<sup><b>*</b></sup>:</td>
                                    <td> 
                                        <?php
                                            $q="select id, nazwa from rodzaj;";
                                            $wynik=mysqli_query($p, $q);
                                            echo('<select name="rodzaj" style="width:200px" required>');
                                                while($w=mysqli_fetch_assoc($wynik))
                                                {
                                                    echo('<option value="'.$w['id'].'">'.$w['nazwa'].'</option>');
                                                }
                                            echo('</select><br>');
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Opis<sup><b>*</b></sup>:</td>
                                    <td><textarea name="opis" style="width:300px; height: 250px" required></textarea></td>
                                </tr>
                                <tr>
                                    <td>Dział:</td>
                                    <td>
                                        <input type="text" name="dzi">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Uczestnicy<sup><b>*</b></sup>:</td>
                                    <td>
                                        <input type="text" name="ucz" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Plik:</td>
                                    <td>
                                        <input type="file" name="plik">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Zgłaszający<sup><b>*</b></sup>:</td>
                                    <td> 
                                        <?php
                                            $q="select id, nazwa from zglaszajacy;";
                                            $wynik=mysqli_query($p, $q);
                                            echo('<select name="zglaszajacy" style="width:200px" required>');
                                                while($w=mysqli_fetch_assoc($wynik))
                                                {
                                                    echo('<option value="'.$w['id'].'">'.$w['nazwa'].'</option>');
                                                }
                                            echo('</select><br>');
                                        ?>
                                    </td>
                                </tr>
                            </table><br>
                            <b>*</b> - wymagane<br><br>
                            <input type="submit" value="Wyślij">
                        </form>
                        <a href="glowna.php"style="text-decoration:none; color: black;">Powrót</a>
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