<?php
session_start();
include "navbar.php";
include "restrict.php";
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
<form action="dodaj-ocene.php" method="POST">  
                        <div class="form-outline mb-4">
                        <label class="form-label">Wprowadź ocenę</label><br>
                          <input type="number" name ="ocena" class="form-control"/>
						  <label class="form-label">Wprowadź komentarz</label><br>
                          <input type="text" name ="komentarz" class="form-control"/>
						  <label class="form-label">Wprowadź id ucznia</label><br>
                          <input type="number" name ="id_ucznia" class="form-control"/>
                          </div>
                          <br>
                        <input type="submit" value="Dodaj" name="submit" class="btn btn-primary"></input>     
						<a class="btn btn-primary" href="cms-panel-nau.php">Wróć</a>							
                        </div>
</div>
</form>
<?php

require ("polaczenie.php");
$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
$sql = "select id_przedmiot from nauczyciel, konto where konto.id_konto='{$_SESSION['id_konto']}' AND nauczyciel.id_konto=konto.id_konto;";
if ($polaczenie->query($sql) === TRUE) $row = mysqli_fetch_assoc($result) ;
$result = mysqli_query($polaczenie,$sql);
$zobacz = mysqli_num_rows($result) > 0;
if($zobacz)
{
while ($row = mysqli_fetch_assoc($result))
{
$id_przedmiot=$row['id_przedmiot'];

//echo $_SESSION['id_przedmiot'];
}}
$polaczenie->close();
?>
<?php
if(isset($_POST['submit'])){
require ("polaczenie.php");
$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
$ocena=$_POST['ocena'];
$komentarz=$_POST['komentarz'];
$id_konto=$_POST['id_ucznia'];

$sql = "INSERT INTO ocena (ocena, komentarz, id_przedmiot, id_konto) VALUES ('$ocena', '$komentarz', '$id_przedmiot', '$id_konto')";

if ($polaczenie->query($sql) === TRUE) {
    $_SESSION['art']="Dodano ocenę w systemie";
    header('Location:cms-panel-nau.php');
} else {
  echo "Error: " . $sql . "<br>" . $polaczenie->error;
  echo $_SESSION['art'];
}

$polaczenie->close();
}
?>
</div>
</body>
</html>