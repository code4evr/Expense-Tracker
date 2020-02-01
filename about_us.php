<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php
  include 'scripts_links.php';
  ?>
  <title>Document</title>
</head>
<body>
  <?php
  if (isset($_SESSION['id'])) {
    include "header_logout.php";
  }
  else {
    include "header_login.php";
  }
  ?>
  <div class="container">
    <div class="row" style="margin-top:10%;">
      <div class="col-xs-6">
        <h2>Who are we?</h2>
        <p>We are a group of technocrats who came up with an idea of solving budget and time issues which we usually face in our daily lives. We are here to provide a budget controller according to your aspects.</p>
        <br>
        <p>Budget control is the biggest financial issue in the present world. One should look after their budget control to get ride off from their financial crisis</p>
      </div>
      <div class="col-xs-6">
        <h2>Why choose us?</h2>
        <p>We provide with a predominant way to control and manage your budget estimations with ease of accessing for multiple users.</p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-6">
        <h2>Contact Us</h2>
        <h5><strong>Email: </strong>bidit.upadhyay7@gmail.com</h3>
        <h5><strong>Mobile: </strong>+91-7500521447</h3>
      </div>
    </div>
  </div>
  <?php
  include 'footer.php';
  ?>
</body>
</html>