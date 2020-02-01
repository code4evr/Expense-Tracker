<?php
include "db_connection_script.php";
$_SESSION['initial_budget'] = $_POST['initial_budget'];
$_SESSION['people'] = $_POST['people'];
header('location: ../plan_details.php');
?>