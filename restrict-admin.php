<?php
if($_SESSION['admin']!=3){ 
header('Location:cms.php');
exit();
}
?>