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
  <title>Login</title>
</head>
<body>
  <?php
  include 'header_login.php';
  ?>
  <div class="container">
    <div class="row signup_row_style">
      <div class="col-xs-4 col-xs-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading text-center text-header">Sign Up</div>
          <div class="panel-body">
            <div class="container-fluid">
              <div class="row">
                <form action="/scripts/user_registration_script.php" method="post">
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Email" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="number" name="phone" id="phone" placeholder="Enter valid phone number (Example: 84555484555)" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include 'footer.php';
  ?>
</body>
</html>