<?php
session_start();
include "navbar.php"
//$wynik = $polaczenie->query("SELECT ocena, przedmiot FROM ocena INNER JOIN przedmiot ON ocena.id_przedmiot = przedmiot.id_przedmiot WHERE id_konto=5;")
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
      <th>Ocena</th>
      <th>Przedmiot</th>
    </tr>
  </thead>
<?php
require ("polaczenie.php");
$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
$sql = "SELECT id_ocena, ocena, przedmiot FROM ocena INNER JOIN przedmiot ON ocena.id_przedmiot = przedmiot.id_przedmiot WHERE id_konto='{$_SESSION['id_konto']}'";
$result = mysqli_query($polaczenie,$sql);
$zobacz = mysqli_num_rows($result) > 0;
if($zobacz)
{
while ($row = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                        <th><?php  echo $row['ocena'] ?></th>
                        <th><?php  echo $row['przedmiot'] ?></th>
                    </tr>                  

        <?php
}
}
?>
</body>
</html>