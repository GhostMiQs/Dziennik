<?php
session_start();
include "navbar.php";
require_once "restrict-admin.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Portal Uczniowski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </head>
<body>
<div class="container py-2">
<?php if(isset($_SESSION['art'])){
    echo '<div class="error">'.$_SESSION['art'].'</div>';
    unset($_SESSION['art']);}?>
<form action="usun-user.php" method="POST">  
                        <div class="form-outline mb-4">
                        <label class="form-label">Wpisz numer ID konta aby mianować administartora </label><br>
                          <input type="number" name ="id" class="form-control"/>
                          </div>
                          <br>
                        <input type="submit" value="Mianuj" name="submit" class="btn btn-primary"></input>      
  <a class="btn btn-primary" href="cms-panel.php">Wróć</a>							
                        </div>
</div>
</form>
<?php
if(isset($_POST['submit'])){
require ("polaczenie.php");
$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
$id=$_POST['id'];

$sql = "UPDATE konto SET rodzaj_konta=3 WHERE id_konto=$id";

if ($polaczenie->query($sql) === TRUE) {
    $_SESSION['art']="Edytowano  uzytkownika w systemie";
    header('Location:dodaj-admin.php');
} else {
  echo "Error: " . $sql . "<br>" . $polaczenie->error;
}

$polaczenie->close();
}
?>
</div>
</body>
</html>