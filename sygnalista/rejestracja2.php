<?php
    require_once("sesja.php");
    require_once("baza.php");
    $p=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(!$p) blad("Błąd połączenia z bazą!");
    if(!isset($_POST['nazwU']))
    {
        $_SESSION['komunikat']='Musisz podać dane';
        header('Location: rejestracja.php');
        die();
    }
    $anonim=null;
    if(isset($_POST['anonim'][0]))
    $anonim=$_POST['anonim'][0];
    if($anonim==null)
    {
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $email= $_POST['mail'];
        $nazwa = $_POST['nazwU'];
        $haslo = $_POST['haslo'];
        $hasloP = $_POST['haslo2'];
        $q='select nazwaUz from konta where nazwaUz="'.$nazwa.'";';
        $wynik=mysqli_query($p, $q);
        if(mysqli_num_rows($wynik)>0)
        {
            $_SESSION['komunikat']='Użytkownik o podanej nazwie już istieje!';
            header('Location: rejestracja.php');
            die();
        }
        else
        {
            $zaszyfrowane= md5($haslo);
            $zaszyfrowaneP = md5($hasloP);
            if($zaszyfrowane != $zaszyfrowaneP)
            {
                $_SESSION['komunikat']='Hasła muszą być takie same!';
                header('Location: rejestracja.php');
                die();
            }
            else
            {
                $q="insert into konta (imie, nazwisko, email, nazwaUz, haslo, uprawnienia) values ('".$imie."','".$nazwisko."','".$email."','".$nazwa."','".$zaszyfrowane."',0);";
                echo($q);
                mysqli_query($p, $q);
                $_SESSION['komunikat']='Konto zostało utworzone!';
                header('Location: rejestracja.php');
            
            }
        }
    }
    else if ($anonim!=null)
    {
        $nazwa = $_POST['nazwU'];
        $q='select nazwaUz from konta where nazwaUz="'.$nazwa.'";';
        $wynik=mysqli_query($p, $q);
        if(mysqli_num_rows($wynik)>0)
        {
            $_SESSION['komunikat']='Użytkownik o podanej nazwie już istieje!';
            header('Location: rejestracja.php');
            die();
        }
        else
        {
            $q="insert into konta (nazwaUz, uprawnienia, czyAnonim) values ('".$nazwa."', 0, 1);";
            mysqli_query($p, $q);
            $_SESSION['komunikat']='Konto zostało utworzone!';
            header('Location: rejestracja.php');
        }
    }
    mysqli_close($p);
?>