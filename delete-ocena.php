<?php
include 'polaczenie.php';
if(isset($_GET['deleteocenaid'])){
	$id=$_GET['deleteocenaid'];
		
	$sql1="SELECT * FROM ocena WHERE id_ocena='$id';";
	$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
	$result=mysqli_query($polaczenie,$sql1);
	$row = mysqli_fetch_assoc($result);
	if($result){
	$ocena=$row['ocena'];
	$komentarz=$row['komentarz'];
	$id_przedmiot=$row['id_przedmiot'];
	$id_konto=$row['id_konto'];
	}
	
	$sql2 = "INSERT INTO backup (id_ocena, ocena, komentarz, id_przedmiot, id_konto) VALUES ('$id', '$ocena', '$komentarz', '$id_przedmiot', '$id_konto')";
	$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
	$result=mysqli_query($polaczenie,$sql2);
	
	$sql="DELETE FROM ocena WHERE id_ocena='$id'";
	$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
	$result=mysqli_query($polaczenie,$sql);
	if($result)
		{
		echo '<script>alert("Ocena usunięta!")</script>';
		header('Location:lista-ocen.php');
		}
	else
		{
		die(mysqli_error($polaczenie));
		}
}
?>