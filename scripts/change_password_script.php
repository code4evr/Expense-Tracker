<?php
include "db_connection_script.php";
$old_password = md5($_POST['old_password']);
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];
$email = $_SESSION['email'];

$password_query = "SELECT * FROM users WHERE email = '$email' AND password = '$old_password'";
$password_query_result = mysqli_query($con, $password_query);

if((mysqli_num_rows($password_query_result) == 1) && ($new_password == $confirm_password)) {
  $new_password = md5($new_password);
  $change_pass_query = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
  $change_pass_query_result = mysqli_query($con, $change_pass_query);
  echo "password changed successfully";
  header("refresh:2;url=../home.php");
}
else {
  echo "passwords do not match";
  header("refresh:2;url=../change_password.php");
}
?>