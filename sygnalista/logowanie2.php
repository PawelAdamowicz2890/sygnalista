<?php
    require_once('sesja.php');
    require_once('baza.php');
    $p=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$p) blad("Błąd połączenia z bazą!");
    if($_POST['nazwU']==null)
    {
        if(!isset($_COOKIE['userA']))
        {
            if(!isset($_COOKIE['user']) || !isset($_COOKIE['haslo']))
            {
                $_SESSION['komunikat']='Podaj dane!';
                header('Location: logowanie.php');
                die();
            }
            else
            {
                $nazwa=$_COOKIE['user'];
                $haslo=$_COOKIE['haslo'];
                $q='select id, nazwaUz, haslo, uprawnienia from konta where nazwaUz="'.$nazwa.'"';
                $wynik=mysqli_query($p, $q);
                if(mysqli_num_rows($wynik)== 0)
                {
                    $_SESSION['komunikat']='Nie ma takiego użytkownika!';
                    header('Location: logowanie.php');
                    die();
                }
                else
                {
                    $w=mysqli_fetch_assoc($wynik);
                    $zaszyfrowane= md5($haslo);
                    if($zaszyfrowane!=$w['haslo'])
                    {
                        $_SESSION['komunikat']='Nieprawidłowe hasło!';
                        header('Location: logowanie.php');
                        die();
                    }
                    else
                    {
                        $_SESSION['id']=$w['id'];
                        $_SESSION['uprawnienia']=$w['uprawnienia'];
                        if($w['uprawnienia']==0)
                        {
                            header('Location: glowna.php');
                            die();
                        }
                        else if($w['uprawnienia']== 1)
                        {
                            header('Location: zaplecze.php');
                            die();
                        }
                    }
                }
            }
        }
        else
        {
            $nazwa=$_COOKIE['userA'];
            $q='select id, nazwaUz, uprawnienia from konta where nazwaUz="'.$nazwa.'"';
            $wynik=mysqli_query($p, $q);
            if(mysqli_num_rows($wynik)== 0)
            {
                $_SESSION['komunikat']='Nie ma takiego użytkownika!';
                header('Location: logowanie.php');
                die();
            }
            else
            {
                $w=mysqli_fetch_assoc($wynik);
                $_SESSION['id']=$w['id'];
                $_SESSION['uprawnienia']=$w['uprawnienia'];
                if($w['uprawnienia']==0)
                {
                    header('Location: glowna.php');
                    die();
                }
                else if($w['uprawnienia']== 1)
                {
                    header('Location: zaplecze.php');
                    die();
                }
            }
        }
    }
    else
    {
        $anonim=null;
        if(isset($_POST['anon'][0]))
            $anonim=$_POST['anon'][0];
        if($anonim==null)
        {
            $nazwa=$_POST['nazwU'];
            $haslo=$_POST['haslo'];
            $q='select id, nazwaUz, haslo, uprawnienia from konta where nazwaUz="'.$nazwa.'"';
            $wynik=mysqli_query($p, $q);
            if(mysqli_num_rows($wynik)== 0)
            {
                $_SESSION['komunikat']='Nie ma takiego użytkownika!';
                header('Location: logowanie.php');
                die();
            }
            else
            {
                $w=mysqli_fetch_assoc($wynik);
                $zaszyfrowane= md5($haslo);
                if($zaszyfrowane!=$w['haslo'])
                {
                    $_SESSION['komunikat']='Nieprawidłowe hasło!';
                    header('Location: logowanie.php');
                    die();
                }
                else
                {
                    if(isset($_POST['ciastka'][0]))
                    {
                        setcookie('user', $nazwa, time()+2592000);
                        setcookie('haslo', $haslo, time()+2592000);
                    }
                    $_SESSION['id']=$w['id'];
                    $_SESSION['uprawnienia']=$w['uprawnienia'];
                    if($w['uprawnienia']==0)
                    {
                        header('Location: glowna.php');
                        die();
                    }
                    else if($w['uprawnienia']== 1)
                    {
                        header('Location: zaplecze.php');
                        die();
                    }
                }
            }
        }
        else if($anonim != null)
        {
            $nazwa=$_POST['nazwU'];
            $q='select id, nazwaUz, uprawnienia from konta where nazwaUz="'.$nazwa.'"';
            $wynik=mysqli_query($p, $q);
            if(mysqli_num_rows($wynik)== 0)
            {
                $_SESSION['komunikat']='Nie ma takiego użytkownika!';
                header('Location: logowanie.php');
                die();
            }
            else
            {
                $w=mysqli_fetch_assoc($wynik);
                if(isset($_POST['anon'][0]))
                {
                    setcookie('userA', $nazwa, time()+31536000);
                }
                $_SESSION['id']=$w['id'];
                $_SESSION['uprawnienia']=$w['uprawnienia'];
                if($w['uprawnienia']==0)
                {
                    header('Location: glowna.php');
                    die();
                }
                else if($w['uprawnienia']== 1)
                {
                    header('Location: zaplecze.php');
                    die();
                }
            }
        }
        
    }
    
    mysqli_close($p);
?>