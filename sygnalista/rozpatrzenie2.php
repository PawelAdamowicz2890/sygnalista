<?php
    require_once('sesja.php');
    require_once('baza.php');
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
    $p=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$p) blad("Błąd połączenia z bazą!");
    $idZ=$_POST['idz'];
    $opis="";
    $plik="";
    $data=date('Y-m-d H:i:s',time());
    $log="";
    $q='select id from rozpatrzenia where zgloszenie_id="'.$idZ.'";';
    $wynik=mysqli_query($p, $q);
    if(mysqli_num_rows($wynik)== 0)
    {
        $idR=md5($data.$idZ);
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
            header("Location: rozpatrzenie.php");
            die();
        }
        $katalog='pliki/ropatrzenia/';
        $pN=$_FILES['plik']['name'];
        if(file_exists($katalog) != true)
            mkdir($katalog);
        $katalog=$katalog.'rdoz'.$idZ.'/';
        if(file_exists($katalog) != true)
            mkdir($katalog);
        $plik=$katalog.$pN;
        echo($plik);
        print_r($_FILES);
        move_uploaded_file($_FILES['plik']['tmp_name'], $plik);
        
    }
    $q='select id from rozpatrzenia where zgloszenie_id="'.$idZ.'";';
    $wynik=mysqli_query($p, $q);
    if(mysqli_num_rows($wynik)== 0)
    {
        $log="dodano rozpatrzenie";
        $q='insert into rozpatrzenia(id, plik, opis, zgloszenie_id) values ("'.$idR.'", "'.$plik.'", "'.$opis.'", "'.$idZ.'");';
        mysqli_query($p, $q);
        $q='insert into rozpatrzenialog(rozp_id, data, log) values ("'.$idR.'","'.$data.'", "'.$log.'");';
        mysqli_query($p, $q);
        $q='update zgloszenia set status_id=3 where id="'.$idZ.'"';
        mysqli_query($p, $q);
        $_SESSION['komunikat']="Zgłoszenie zostało rozpatrzone";
        header("Location: zaplecze.php");
    }
    else
    {
        $log="rozpatrzenie zaktualizowane";
        if($plik=="")
        {
            $q='update rozpatrzenia set opis="'.$opis.'" where zgloszenie_id="'.$idZ.'"';
            mysqli_query($p, $q);
        }
        else
        {
            $q='update rozpatrzenia set plik="'.$plik.'", opis="'.$opis.'" where zgloszenie_id="'.$idZ.'"';
            mysqli_query($p, $q);
        }
        mysqli_query($p, $q);
        $q='insert into rozpatrzenialog(rozp_id, data, log) values ("'.$idR.'","'.$data.'", "'.$log.'");';
        mysqli_query($p, $q);
        $q='update zgloszenia set status_id=3 where id="'.$idZ.'"';
        mysqli_query($p, $q);
        $_SESSION['komunikat']="Zgłoszenie zostało rozpatrzone";
        header("Location: zaplecze.php");
    }
    mysqli_close($p);
    
?>