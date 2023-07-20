<?php
include 'polaczenie.php';
if(isset($_GET['deleteid'])){
	$id=$_GET['deleteid'];
	$sql="DELETE FROM ocena WHERE id_ocena=$id";
	$polaczenie=@new mysqli($host, $db_user,$db_password,$db_name);
	$result=mysqli_query($polaczenie,$sql);
	if($result)
		{
		echo "<script>alert('Ocena usunęta!');</script>";
		header('Location:index-uczen.php');
		}
	else
		{
		die(mysqli_error($polaczenie));
		}
}
?>