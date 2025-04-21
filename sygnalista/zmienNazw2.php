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
    $nazwaN=$_POST['nazwaN'];
    $q='select nazwaUz from konta where nazwaUz="'.$nazwaN.'";';
    $wynik=mysqli_query($p, $q);
    if(mysqli_num_rows($wynik)>0)
    {
        $_SESSION['komunikat']='Nazwa jest już zajęta! Podaj inną.';
        header('Location: zmienNazw.php');
        die();
    }
    else
    {
        $q="update konta set nazwaUz='".$nazwaN."' where id='".$id."'";
        mysqli_query($p, $q);
        $_SESSION['komunikat']='Nazwa konta została zmieniona!';
        if(isset($_COOKIE['user']) && isset($_COOKIE['haslo']))
        {
            unset($_COOKIE['user']);
            unset($_COOKIE['haslo']);
            setcookie('user','', time()-3600);
            setcookie('haslo','', time()-3600);
        }
        if(isset($_COOKIE['userA']))
        {
            unset($_COOKIE['userA']);
            setcookie('userA','', time()-3600);
        }
        if($_SESSION['uprawnienia']==0)
            header('Location: glowna.php');
        else if($_SESSION['uprawnienia']== 1)
            header('Location: zaplecze.php');
    }
    mysqli_close($p);
?>