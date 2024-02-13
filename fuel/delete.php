<?php
include "config.php";
$id = $_GET["id"];
$sql = "DELETE FROM `fuel` WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
  header("Location:fuel.php?");
} else {
  echo "Failed: " . mysqli_error($conn);
}