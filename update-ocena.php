<?php
include 'polaczenie.php';
if(!isset($_GET['updateid'])){
	header("Location:cms-panel-nau.php");
	exit;
}
$id=$_GET['updateid'];
if(isset($_POST['submit'])){
	$ocena=$_POST['ocena'];
	$kom=$_POST['komentarz'];
	
	$sql1="SELECT * FROM ocena WHERE id_ocena='$id';";
	$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
	$result=mysqli_query($polaczenie,$sql1);
	$row = mysqli_fetch_assoc($result);
	if($result){
	$ocena1=$row['ocena'];
	$komentarz=$row['komentarz'];
	$id_przedmiot=$row['id_przedmiot'];
	$id_konto=$row['id_konto'];
	}
	
	$sql2 = "INSERT INTO backup (id_ocena, ocena, komentarz, id_przedmiot, id_konto) VALUES ('$id', '$ocena1', '$komentarz', '$id_przedmiot', '$id_konto')";
	$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
	$result=mysqli_query($polaczenie,$sql2);
	
	$sql="UPDATE ocena SET ocena=$ocena, komentarz='$kom' WHERE id_ocena=$id";
	
	$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
	$result=mysqli_query($polaczenie,$sql);
	if($result)
		{
		echo '<script>alert("Ocena edytowana!")</script>';
		}
	else
		{
		die(mysqli_error($polaczenie));
		}
}
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
<div class="container py-2">
<form method="POST">  
                        <div class="form-outline mb-4">
                        <label class="form-label">Wpisz ocenę: </label><br>
                          <input type="number" name ="ocena" class="form-control"/>
						  <label class="form-label">Wpisz komentarz: </label><br>
                          <input type="text" name ="komentarz" class="form-control"/>
                          </div>
                          <br>
                        <input type="submit" value="Zmień" name="submit" class="btn btn-primary"></input> 
						<a class="btn btn-primary" href="lista-ocen.php">Wróć</a>				
                        </div>
</div>
</form>
</div>
</body>
</html>