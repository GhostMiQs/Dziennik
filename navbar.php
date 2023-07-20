<nav class="navbar sticky-top navbar-light bg-light">
  <a class="navbar-brand" href="login.php">Portal uczniowski</a>
  <a class="navbar-brand" href="cms-nau.php">Portal nauczycielski</a>
  <a class="navbar-brand" href="cms.php">Portal administracyjny</a>
    <?php
            echo "<div class='navbar-brand d-inline'>";
            echo "<img src='img/enter.png' width='30' height='24' class='align-text-top'>";
              
               if(@$_SESSION['a_login']){
                echo " Witaj ".$_SESSION['a_login']."! ";
                echo "<a class='navbar-brand' href='logout-admin.php'>Wyloguj</a>";

               }
              else{
                echo "<a class='navbar-brand' href='cms.php'>Zaloguj</a>";
                  }
            echo '</div>';
              ?>
</nav>