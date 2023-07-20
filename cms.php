<?php
include "navbar.php";
?>
<html lang="pl">
    <head>
    <head>
    <meta charset="utf-8">
    <title>Panel administracyjny-Dzennik uczniowski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
<body>
<div class="container py-2" style= "width: 21rem">
<p class="text-justify lead"> Witamy w panelu administracyjnym!
<img src="img/admin.png" class="card-img-top"/>
</p>
 <form action="cms-login.php" method="POST">  
    <div class="mb-3 row-cols-1">
      <label class="form-label">Login</label>
      <input type="text" name ="a_login" class="form-control"/>
    </div>
    <div class="mb-3">
      <label class="form-label">Hasło</label>
      <input type="password" name="a_haslo" class="form-control" />
      <br>
      <div class="error">
        <?php
          if(isset($_SESSION['a_blad']))echo $_SESSION['a_blad'];
        ?>
      </div>
    </div>
    <div class="text-center pt-1 mb-5 pb-1">
      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Zaloguj</button>                   
    </div>
  </form>                    
</div>
</body>
</html>