<?php
    require_once('sesja.php');
    require_once('baza.php');
    if(!isset($_SESSION["id"]) && !isset($_SESSION['uprawnienia']))
    {
    header("Location: index.html");
    die();
    }
    if($_SESSION['uprawnienia']==1)
    {
        header("Location: zaplecze.php");
        die();
    }
    $idU=$_SESSION['id'];
    $tytul="";
    $opis="";
    $dzial="";
    $plik="";
    $rodzaj="";
    $zgl="";
    $uczest="";
    $data=date('Y-m-d H:i:s',time());
    $idZ=md5($data);
    if(isset($_POST['tyt']))
    {
        $tytul=$_POST['tyt'];
    }
    if(isset($_POST['rodzaj']))
    {
        $rodzaj=$_POST['rodzaj'];
    }
    if(isset($_POST['opis']))
    {
        $opis=$_POST['opis'];
    }
    if(isset($_FILES['plik']) && strlen($_FILES['plik']['name'])>0)
    {
        if($_FILES['plik']['error']>0)
        {
            $_SESSION['komunikat']="Błąd przesłania pliku!";
            header("Location: zgloszenia.php");
            die();
        }
        $katalog='pliki/u'.$idU.'/';
        $pN=$_FILES['plik']['name'];
        if(file_exists($katalog) != true)
            mkdir($katalog);
        $katalog=$katalog.'/z'.$idZ.'/';
        if(file_exists($katalog) != true)
            mkdir($katalog);
        $plik=$katalog.$pN;
        echo($plik);
        print_r($_FILES);
        move_uploaded_file($_FILES['plik']['tmp_name'], $plik);
        
    }
    if(isset($_POST['dzi']))
    {
        $dzial=$_POST['dzi'];
    }
    if(isset($_POST['ucz']))
    {
        $uczest=$_POST['ucz'];
    }
    if(isset($_POST['zglaszajacy']))
    {
        $zgl=$_POST['zglaszajacy'];
    }
    $k=$data.$tytul.$dzial.$opis.$plik.$uczest.$rodzaj.$zgl.$idU;
    $kod=md5($kod);
    $p=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$p) blad("Błąd połączenia z bazą!");
    $q='select id from zgloszenia where id="'.$idZ.'";';
    $wynik=mysqli_query($p, $q);
    $q='insert into zgloszenia(id, kodDok, tytul, dzial, opis, plik, data, status_id, rodzaj_id, konto_id, zglaszajacy_id, uczestnicy) values ("'.$idZ.'", "'.$kod.'","'.$tytul.'","'.$dzial.'","'.$opis.'","'.$plik.'","'.$data.'",1,'.$rodzaj.', '.$idU.','.$zgl.',"'.$uczest.'");';
    mysqli_query($p, $q);
    $_SESSION['komunikat']="Zgłoszenie zostało wysłane";
    header("Location: glowna.php");
    mysqli_close($p);
    
?>