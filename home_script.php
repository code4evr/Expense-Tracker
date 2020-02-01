<?php
session_start();
$i = 0;
while($i < count($_SESSION['plan_id'])) {
  if($_POST['view'] == $_SESSION['plan_id'][$i]) {
    $_SESSION['view_plan_id'] = $_POST['view'];
    header('location: view_plan.php');
  }
  $i = $i + 1;
}
?>