<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("location: index.php");
}
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
  include 'header_logout.php';
  ?>
  <div class="container">
    <div class="row row_style">
      <div class="col-xs-4 col-xs-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading text-center">
            Create New Plan
          </div>
          <div class="panel-body">
            <form method="post" action="/scripts/user_plan_script.php">
              <div class="form-group">
                <label for="initial_budget">Initial Budget</label>
                <input type="number" name="initial_budget" id="initial_budget" class="form-control" placeholder="Initial Budget(Ex: 4000)">
              </div>
              <div class="form-group">
                <label for="people">How many people you want to add in your group?</label>
                <input type="number" name="people" id="people" class="form-control" placeholder="No. of people">
              </div>
              <a href="plan_details.php">
                <button type="submit" class="btn btn-block btn-hover btn-plain">Next</button>
              </a>
            </form>
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