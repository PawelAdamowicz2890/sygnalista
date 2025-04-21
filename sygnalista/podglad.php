<?php
    require_once('baza.php');
    require_once __DIR__ . '/vendor/autoload.php';
    $p=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $idz=$_GET['id'];
    $q='select * from zgloszenia where id="'.$idz.'";';
    if(!$p) blad("Błąd połączenia z bazą!");
    $wynik=mysqli_query($p, $q);
    $w=mysqli_fetch_assoc($wynik);
    $tyt=$w['tytul'];
    $kod=$w['kodDok'];
    $rodzaj_id=$w['rodzaj_id'];
    $zgl_id=$w['zglaszajacy_id'];
    $ucz=$w['uczestnicy'];
    $data=$w['data'];
    $opis=$w['opis'];
    if(strlen($w['dzial'])>0)
        $dzial=$w['dzial'];
    else
        $dzial= '------------------------';
    $q2='select nazwa from rodzaj where id="'.$rodzaj_id.'";';
    $wynik2=mysqli_query($p, $q2);
    $w2=mysqli_fetch_assoc($wynik2);
    $rodzaj=$w2['nazwa'];
    $q3='select nazwa from zglaszajacy where id="'.$zgl_id.'";';
    $wynik3=mysqli_query($p, $q3);
    $w3=mysqli_fetch_assoc($wynik3);
    $zglasz=$w3['nazwa'];
    $mpdf = new \Mpdf\Mpdf();
    $html = "
        $data
        <h1 style='text-align:center; font-size: 400%;'>$tyt</h1>
        <h2 style='text-align:center; font-size:150%;'>$rodzaj</h2>
        <div style='text-align:center;'>
            <h2 style='font-size:200%;'>Opis</h2>
            <p style='font-size:150%;'>$opis</p>
        </div>
        <p style='font-size:150%;'>Dział: $dzial</p><br>
        <p style='font-size:150%;'>Uczestnicy: $ucz</p><br>
        <p style='font-size:150%;'>Zgłaszający: $zglasz</p><br>
        <p style='font-size:150%;'>Kod dokumentu: $kod</p>
    ";
    $mpdf->WriteHTML($html);
    $mpdf->Output();
?>