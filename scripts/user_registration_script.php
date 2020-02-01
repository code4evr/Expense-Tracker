<?php
include 'db_connection_script.php';
$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, md5($_POST['password']));
$phone = $_POST['phone'];
//$signup_query = "SELECT email FROM users WHERE email = '$email'";
//$signup_query_result = mysqli_query($signup_query);

$user_registration_query = "insert into users(name, email, password, phone) values ('$name', '$email', '$password', '$phone')";
$user_registration_submit = mysqli_query($con, $user_registration_query);
if (!$user_registration_query or !$user_registration_submit) {
  echo die('insertion failed: ' . mysqli_error($con));
}
else {
  echo "Sign Up complete. You will be redirected to the login page";
}
$_SESSION['email'] = $email;
$_SESSION['id'] = mysqli_insert_id($con);
header("refresh:5;url=../login.php");
?>