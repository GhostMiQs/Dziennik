<?php
include "header-admin.php";
require_once "restrict-admin.php";
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
    <meta charset="utf-8">
    <title>Panel administracyjny-Dziennik uczniowski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <link href="style-boot.css" rel="stylesheet"> -->
    </head>
<body>

<div class="container py-2 text-center" style= "width: 21rem">

    <form method="POST">
    <div class="btn-group-vertical text-md-center py-5 " role="group">
  <a class="btn py-2 text-uppercase">Listy:</a>
  <a class="btn btn-outline-success" href="lista-uczen.php">Uczniów</a>
  <a class="btn btn-outline-success" href="lista-nau.php">Nauczycieli</a>
  <!--<a class="btn py-2 text-uppercase">Dodaj:</a>
  <a class="btn btn-outline-success" href="dodaj-prod.php">Konto</a>
  <a class="btn btn-outline-success" href="dodaj-art.php">Nauczyciela</a>-->
  <a class="btn py-2 text-uppercase" >Usuń:</a>
  <a class="btn btn-outline-success" href="usun-konto.php">Konto</a>
  <a class="btn py-2 text-uppercase" >Historia ocen:</a>
  <a class="btn btn-outline-success" href="historia.php">Pokaż</a>
  <a class="btn py-2 text-uppercase">Zmień uprawnienia:</a>
  <a class="btn btn-outline-success" href="dodaj-admin.php">Mianuj administratorem</a>
  <a class="btn btn-outline-success" href="dodaj-nau.php">Mianuj nauczycielem</a>
  </div>
    </form>
</div>
</body>
    </html>