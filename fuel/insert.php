<?php
include "config.php";
if(isset($_POST['submit']))
{
		$date = $_POST['date'];
		$km = $_POST['km'];
		$fuel = $_POST['fuel'];
		$price =$_POST['price'];
		$amount = $_POST['amount'];
		$liter = $_POST['liter'];
		$sql = "INSERT INTO `fuel`(`id`, `date`, `km`, `fuel`, `price`, `amount`, `liter`) VALUES (NULL,'$date','$km','$fuel','$price','$amount','$liter')";
		if(mysqli_query($conn, $sql)){
			echo "<script>alert('Successfully Submitted!'); window.location.href='fuel.php';</script>";}
			else
			{
			echo "ERROR: Hush! Sorry" .$sql. " 
			". mysqli_error($conn);
			}
		
		// Close connection
		mysqli_close($conn);
	}
?>
