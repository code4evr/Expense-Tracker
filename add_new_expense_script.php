<?php
include "scripts/db_connection_script.php";
$title = $_POST['title'];
$date = $_POST['date'];
$amount = $_POST['amount'];
$choice = $_POST['choice'];
$date_check = date_create($date);
if($date_check >= $date_from and $date_check <= $date_to) {
  $flag = 1;
} else {
  echo "<script>alert('Dates not in range')</script>";
}
?>