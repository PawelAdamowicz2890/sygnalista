<?php
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
    header('Location: index.php');
?>