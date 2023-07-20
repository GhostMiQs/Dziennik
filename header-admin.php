<?php
session_start();
?>
<nav class="navbar sticky-top navbar-light bg-light">
  <a class="navbar-brand" href="cms-panel.php">
    <img src="img/admin.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Panel administracyjny-Dziennik uczniowski
  </a>
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