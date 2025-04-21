<?php
    require_once("sesja.php");
    require_once("baza.php");
    if(!isset($_SESSION["id"]) && !isset($_SESSION['uprawnienia']))
    {
        header("Location: index.php");
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
    if(isset($_FILES['plik']))
    {
        unset($_FILES['plik']);
    }
    $idz=$_POST['idz'];
    $q='update zgloszenia set status_id=2 where id="'.$idz.'"';
    mysqli_query($p, $q);
?>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rozpatrzenie zgłoszenia</title>
        <style>
            <?php include "css/styl.css" ?>
            <?php include "css/bootstrap.min.css" ?>
        </style>
    </head>
    <body class="background">
        <main>
            <div class="container">
                <div class="d-flex align-items-center justify-content-center mt-5" style="height: 600px;">
                    <div class="p-2 mt-5 col-lg-4 bg-light text-center">
                        <table>
                            <tr>
                                <td>Tytył:</td>
                                <td>
                                    <?php
                                        $q='select tytul from zgloszenia where id="'.$idz.'"';
                                        $wynik=mysqli_query($p, $q);
                                        $w=mysqli_fetch_assoc($wynik);
                                        echo($w['tytul']);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Rodzaj:</td>
                                <td> 
                                    <?php
                                        $q='select nazwa from rodzaj inner join zgloszenia on rodzaj.id=zgloszenia.rodzaj_id where zgloszenia.id="'.$idz.'"';
                                        $wynik=mysqli_query($p, $q);
                                        $w=mysqli_fetch_assoc($wynik);
                                        echo($w['nazwa']);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Dział:</td>
                                <td>
                                    <?php
                                        $q='select dzial from zgloszenia where id="'.$idz.'"';
                                        $wynik=mysqli_query($p, $q);
                                        $w=mysqli_fetch_assoc($wynik);
                                        echo($w['dzial']);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Uczestnicy:</td>
                                <td>
                                    <?php
                                        $q='select uczestnicy from zgloszenia where id="'.$idz.'"';
                                        $wynik=mysqli_query($p, $q);
                                        $w=mysqli_fetch_assoc($wynik);
                                        echo($w['uczestnicy']);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Zgłaszający:</td>
                                <td> 
                                    <?php
                                        $q='select nazwa from zglaszajacy inner join zgloszenia on zglaszajacy.id=zgloszenia.rodzaj_id where zgloszenia.id="'.$idz.'"';
                                        $wynik=mysqli_query($p, $q);
                                        $w=mysqli_fetch_assoc($wynik);
                                        echo($w['nazwa']);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Opis:</td>
                                <td>
                                    <?php
                                        $q='select opis from zgloszenia where id="'.$idz.'"';
                                        $wynik=mysqli_query($p, $q);
                                        $w=mysqli_fetch_assoc($wynik);
                                        echo($w['opis']);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Plik:</td>
                                <td>
                                <?php
                                        $q='select plik from zgloszenia where id="'.$idz.'"';
                                        $wynik=mysqli_query($p, $q);
                                        $w=mysqli_fetch_assoc($wynik);
                                        echo($w['plik']);
                                    ?>
                                </td>
                            </tr>
                        </table><br>
                        <h3>Rozpatrzenie</h3>
                        <form method="POST" action="rozpatrzenie2.php" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td>Opis<sup><b>*</b></sup>:</td>
                                    <td>
                                        <?php
                                            $q='select opis from rozpatrzenia where zgloszenie_id="'.$idz.'"';
                                            $wynik=mysqli_query($p, $q);
                                            if(mysqli_num_rows($wynik)==0)
                                            {
                                                echo('<textarea name="opis" style="width:300px; height: 250px" required></textarea>');
                                            }
                                            else
                                            {
                                                $w=mysqli_fetch_assoc($wynik);
                                                echo('<textarea name="opis" style="width:300px; height: 250px" required>'.$w['opis'].'</textarea>');
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Plik:</td>
                                    <td>
                                        <input type="file" name="plik">
                                    </td>
                                </tr>
                            </table><br>
                            <b>*</b> - wymagane<br><br>
                            <?php
                                echo('<input type="text" name="idz" value="'.$idz.'" hidden>');
                            ?>
                            <input type="submit" value="Wyślij">
                        </form>
                        <a href="zaplecze.php"style="text-decoration:none; color: black;">Powrót</a>
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