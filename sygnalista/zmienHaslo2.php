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
    if(!$p) blad("Błąd połączenia z bazą!");
    $haslo = $_POST['hasloN'];
    $hasloP = $_POST['haslo2N'];
    $zaszyfrowane= md5($haslo);
    $zaszyfrowaneP = md5($hasloP);
    if($zaszyfrowane != $zaszyfrowaneP)
    {
        $_SESSION['komunikat']='Hasła muszą być takie same!';
        header('Location: zmienHaslo.php');
        die();
    }
    else
    {
        $q='select haslo from konta where id="'.$id.'";';
        $wynik=mysqli_query($p, $q);
        $w=mysqli_fetch_assoc($wynik);
        if($w['haslo']==$zaszyfrowane)
        {
            $_SESSION['komunikat']='Nowe hasło nie może być takie samo jak obecne!';
            header('Location: zmienHaslo.php');
            die();
        }
        else
        {
            $q="update konta set haslo='".$zaszyfrowane."' where id='".$id."'";
            mysqli_query($p, $q);
            $_SESSION['komunikat']='Hasło zostało zmienione!';
            if(isset($_COOKIE['user']) && isset($_COOKIE['haslo']))
            {
                unset($_COOKIE['user']);
                unset($_COOKIE['haslo']);
                setcookie('user','', time()-3600);
                setcookie('haslo','', time()-3600);
            }
            if($_SESSION['uprawnienia']==0)
                header('Location: glowna.php');
            else if($_SESSION['uprawnienia']== 1)
                header('Location: zaplecze.php');
        }
    }
    mysqli_close($p);
?>