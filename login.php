<?php
session_start();
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Portal Uczniowski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <link href="style-boot.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="style-boot.css">
  </head>
<body>
      <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
      
                      <div class="text-center">

                        <h4 class="mt-1 mb-5 pb-1">Jesteśmy z wami</h4>
                      </div>
      
                      <form action="logowanie.php" method="POST">  
                        <div class="form-outline mb-4">
                          <input type="text" name ="login" class="form-control"/>
                          <label class="form-label">Login</label>
                        </div>
      
                        <div class="form-outline mb-4">
                          <input type="password" name="haslo" class="form-control" />
                          <label class="form-label">Hasło</label>
                          <br>
                          <div class="error">
                          <?php
                            if(isset($_SESSION['blad']))echo $_SESSION['blad'];
                          ?>
                          </div>
                        </div>
                        <div class="text-center pt-1 mb-5 pb-1">
                          <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Zaloguj</button>                   
                        </div>
                      </form>
                      <form>
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2">Nie masz konta?</p>
                          <a href="register.php">
                          <button type="button" class="btn btn-outline-danger">Swórz konto</button>
                          </a>
                        </div>
                      </form>
      
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4">To więcej niż dziennik...</h4>
                      <!-- <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
<?php
include "footer.php";
?>
</body>
</html>