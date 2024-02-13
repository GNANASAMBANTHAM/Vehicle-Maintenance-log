<?php
include "config.php";
if(isset($_POST['submit']))
{
		$date = $_POST['date'];
		$km = $_POST['km'];
		$problem = $_POST['problem'];
		$amount = $_POST['amount'];
		$sql = "INSERT INTO `repair`(`id`, `date`, `km`, `problem`, `amount`) VALUES (NULL,'$date','$km','$problem','$amount')";
		if(mysqli_query($conn, $sql)){
			echo "<script>alert('Successfully Submitted!'); window.location.href='repair.php';</script>";}
			else
			{
			echo "ERROR: Hush! Sorry" .$sql. " 
			". mysqli_error($conn);
			}
		
		// Close connection
		mysqli_close($conn);
	}
?>
