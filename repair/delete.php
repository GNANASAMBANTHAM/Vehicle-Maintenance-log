<?php
include "config.php";
$id = $_GET["id"];
$sql = "DELETE FROM `repair` WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
  header("Location:repair.php?");
} else {
  echo "Failed: " . mysqli_error($conn);
}
