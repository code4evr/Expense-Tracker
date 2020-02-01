<?php
include "db_connection_script.php";
if (isset($_POST['login_btn'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = md5($_POST['password']);

  $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $login_query_result = mysqli_query($con, $login_query);

  if (mysqli_num_rows($login_query_result) == 1) {
    $_SESSION['message'] = "Welcome " . $email;
    $_SESSION['email'] = $email;
    echo $_SESSION['message'] . "You will be redirected to homepage";
    $_SESSION['id'] = mysqli_insert_id($con);
    header("refresh:2;url = ../home.php");
  }
  else {
    $_SESSION['message'] = "please check username/password";
    echo $_SESSION['message'];
    header("refresh:2;url = ../login.php");
  }
}
?>