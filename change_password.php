<?php
session_start();
if(!isset($_SESSION['id'])) {
  header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php
  include "scripts_links.php";
  ?>
  <title>Change Password</title>
</head>
<body>
  <?php
  include "header_logout.php";
  ?>
  <div class="container">
    <div class="row row_style">
      <div class="col-xs-4 col-xs-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading text-center">Change Password</div>
          <div class="panel-body">
            <form action="/scripts/change_password_script.php" method="post">
              <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Enter old password">
              </div>
              <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter new password">
              </div>
              <div class="form-group">
                <label for="confirm_password">Old Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm new password">
              </div>
              <button type="submit" class="btn btn-block btn_dark">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>