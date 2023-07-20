<?php
session_start();
require_once "polaczenie.php";

$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error".$polaczenie->connect_errno;
}
else{
$login=$_POST['login'];
$haslo=$_POST['haslo'];
$login = htmlentities($login, ENT_QUOTES, "UTF-8");

if($rezultat = @$polaczenie->query(
    sprintf("SELECT * FROM konto WHERE login='%s'",
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

            unset($_SESSION['blad']);
            $rezultat->free_result();
            header('Location:index-uczen.php');
        }
        else {
            $_SESSION['blad']="Nieprawidłowe login lub hasło";
            header('Location:login.php');
        }
    }  
    else
    {
        $_SESSION['blad']="Nieprawidłowe login lub hasło1";
        header('Location:login.php');
    }
}
$polaczenie->close();
}

?>