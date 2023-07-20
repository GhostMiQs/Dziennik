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
<div class="container py-2 ">
<a class="text-dark">Lista uczniów:</a>
<table class="table table-hover ">
<thead>
    <tr>
      <th>Imię</th>
      <th>Nazwisko</th>
	  <th>ID Konta</th>
	  <th>Login</th>
	  <th>Adres e-mail</th>
    </tr>
  </thead>
  <a class="btn btn-primary" href="cms-panel.php">Wróć</a>
<?php
require ("polaczenie.php");
$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
$sql = "SELECT imie, nazwisko, konto.id_konto, login, email FROM konto LEFT JOIN nauczyciel ON konto.id_konto=nauczyciel.id_konto WHERE konto.rodzaj_konta = '2';";
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
						<th><?php  echo $row['id_konto'] ?></th>
						<th><?php  echo $row['login'] ?></th>
						<th><?php  echo $row['email'] ?></th>
						<th><button class="btn btn-primary"><a href="delete.php?deleteid=<?php echo htmlentities($row['id_konto'])?>" class="text-light">Usuń</a></button><th>
						<th><button class="btn btn-primary"><a href="update.php?updateid=<?php echo htmlentities($row['id_konto'])?>" class="text-light">Edytuj</a></button><th>
                    </tr>                  

        <?php
}
}
?>
</body>
</html>