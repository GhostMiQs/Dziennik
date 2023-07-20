<?php
session_start();
require_once "polaczenie.php";

$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error".$polaczenie->connect_errno;
}
else{
$login=$_POST['a_login'];
$haslo=$_POST['a_haslo'];
$login = htmlentities($login, ENT_QUOTES, "UTF-8");

if($rezultat = @$polaczenie->query(
    sprintf("SELECT * FROM konto WHERE login='%s' AND rodzaj_konta='3'",
        mysqli_real_escape_string($polaczenie,$login))))
{
    $ilu_userow = $rezultat->num_rows;
    if($ilu_userow>0)
    {
        $wiersz = $rezultat->fetch_assoc();
        if(password_verify($haslo, $wiersz['haslo']))
        {
            $_SESSION['zalogowany']=true;
            $_SESSION['id_konto']=$wiersz['id_konto'];
            $_SESSION['a_login'] = $wiersz['login'];
            $_SESSION['admin']= $wiersz['rodzaj_konta'];

            unset($_SESSION['a_blad']);
            $rezultat->free_result();
            header('Location:cms-panel.php');
        }
        else {
            $_SESSION['a_blad']="Nieprawidłowe login lub hasło1";
            header('Location:cms.php');
        }
    }  
    else
    {
        $_SESSION['a_blad']="Nieprawidłowe login lub hasło2";
        header('Location:cms.php');
    }
}
$polaczenie->close();
}

?>