<?php
  session_start();
  if(isset($_POST['email']))
  {
    $wszystko_ok=true;
    $nick=$_POST['nick'];
    if((strlen($nick)<3) ||(strlen($nick)>20))
    {
      $wszystko_ok=false;
      $_SESSION['e_nick']="Login musi posiadać od 3 do 20 znaków";
    }
    if(ctype_alnum($nick)==false){
    $wszystko_ok=false;
    $_SESSION['e_nick']="Login może składać się tylko z liter i cyfr";
    }
    // Sprawdź poprawność adresu email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
     
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
        $wszystko_OK=false;
        $_SESSION['e_email']="Podaj poprawny adres e-mail!";
    }
     
    //Sprawdź poprawność hasła
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
     
    if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
    }
     
    if ($haslo1!=$haslo2)
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
    }   

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
    //Zapamiętaj wprowadzone dane
    $_SESSION['fr_nick'] = $nick;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_haslo1'] = $haslo1;
    $_SESSION['fr_haslo2'] = $haslo2;
     
    require_once "polaczenie.php";
    mysqli_report(MYSQLI_REPORT_STRICT);  

    try
        {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                //Czy email już istnieje?
                $rezultat = $polaczenie->query("SELECT id_konto FROM konto WHERE email='$email'");
                 
                if (!$rezultat) throw new Exception($polaczenie->error);
                 echo "Istnieje";
                $ile_takich_maili = $rezultat->num_rows;
                if($ile_takich_maili>0)
                {
                    $wszystko_OK=false;
                    $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
                }       
 
                //Czy nick jest już zarezerwowany?
                $rezultat = $polaczenie->query("SELECT id_konto FROM konto WHERE login='$nick'");
                 
                if (!$rezultat) throw new Exception($polaczenie->error);
                echo "Istnieje";
                $ile_takich_nickow = $rezultat->num_rows;
                if($ile_takich_nickow>0)
                {
                    $wszystko_OK=false;
                    $_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
                }
                 
                if ($wszystko_OK=true)
                {
                     
                    if ($polaczenie->query("INSERT INTO konto VALUES (NULL, '$nick', '$haslo_hash', '$email',1);"))
                    {
                      echo "Istnieje";
                        $_SESSION['udanarejestracja']=true;
                        header('Location: login.php');
                    }
                    else
                    {
                        throw new Exception($polaczenie->error);
                    }
                     
                }
                $polaczenie->close();
            }
             
        }
        catch(Exception $e)
        {
            echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
            echo '<br />Informacja developerska: '.$e;
        }
  }

?>
<!DOCTYPE html>
<?php
include "navbar.php";
?>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Portal uczniowski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
                        
                        <h4 class="mt-1 mb-5 pb-1">Z myślą o edukacji!</h4>
                      </div>
      
                      <form action="register.php" method="post">      
                        <div class="form-outline mb-4">
                          <input type="text" name="nick" class="form-control"/>
                          <label class="form-label">Login</label>
                          <?php
                          if(isset($_SESSION['e_nick']))
                          {
                            echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                            unset($_SESSION['e_nick']);
                          }
                          ?>
                        </div>
                        <div class="form-outline mb-4">
                          <input type="text" name="email" class="form-control"/>
                          <label class="form-label">Adres e-mail</label>
                          <?php
                          if(isset($_SESSION['e_email']))
                          {
                            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                            unset($_SESSION['e_email']);
                          }
                          ?>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" name="haslo1" class="form-control"/>
                            <label class="form-label">Hasło</label>
                            <?php
                          if(isset($_SESSION['e_haslo']))
                          {
                            echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                            unset($_SESSION['e_haslo']);
                          }
                          ?>
                          </div>
                          <div class="form-outline mb-4">
                            <input type="password" name="haslo2" class="form-control"/>
                            <label class="form-label">Powtórz hasło</label>
                            <?php
                          if(isset($_SESSION['e_haslo']))
                          {
                            echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                            unset($_SESSION['e_haslo']);
                          }
                          ?>
                          </div>
                          <br>
                          <br>
                        <div class="text-center pt-1 mb-5 pb-1">
                        <br>
                          <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Zarejestruj</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2">Masz już konto?</p>
                          <a href="login.php">
                          <button type="button" class="btn btn-outline-danger">Zaloguj</button>
                          </a>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4">To więcej niz dziennik...</h4>
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