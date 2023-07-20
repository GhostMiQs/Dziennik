<?php
session_start();
include "navbar.php";
require_once "restrict.php";
//Ten skrypt działa tylko wtedy, kiedy są uzupełnione dane ucznia w tabeli uczen
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
<div class="container py-2 ">
<a class="text-dark">Lista ocen:</a>
<table class="table table-hover ">
<thead>
    <tr>
      <th>Imię</th>
      <th>Nazwisko</th>
	  <th>Ocena</th>
	  <th>Komentarz</th>
    </tr>
  </thead>
  <a class="btn btn-primary" href="cms-panel-nau.php">Wróć</a>	
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

}
}
$polaczenie->close();
?>
<?php
require ("polaczenie.php");
$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
$sql = "select uczen.imie, uczen.nazwisko, ocena.ocena, ocena.komentarz, ocena.id_ocena from konto, nauczyciel, ocena, uczen where uczen.id_konto=ocena.id_konto AND ocena.id_konto=konto.id_konto and ocena.id_przedmiot=nauczyciel.id_przedmiot AND ocena.id_przedmiot=$id_przedmiot AND nauczyciel.id_konto='{$_SESSION['id_konto']}'";
$result = mysqli_query($polaczenie,$sql);
$zobacz = mysqli_num_rows($result) > 0;
if($zobacz)
{
while ($row = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                        <th><?php  echo $row['imie'] ?></th>
                        <th><?php  echo $row['nazwisko'] ?></th>
						<th><?php  echo $row['ocena'] ?></th>
						<th><?php  echo $row['komentarz'] ?></th>
						<th><button class="btn btn-primary"><a href="delete-ocena.php?deleteocenaid=<?php echo htmlentities($row['id_ocena'])?>" class="text-light">Usuń</a></button><th>
						<th><button class="btn btn-primary"><a href="update-ocena.php?updateid=<?php echo htmlentities($row['id_ocena'])?>" class="text-light">Edytuj</a></button><th>
                    </tr>         				

        <?php
}
}
?>
</body>
</html>