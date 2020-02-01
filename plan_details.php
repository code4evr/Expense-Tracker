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
    <div class="row" style="margin-top:8%;">
      <div class="col-xs-6 col-xs-offset-3">
        <div class="panel panel-default">
          <div class="panel-body">
            <form action="/scripts/user_plan_details_script.php" method="post">
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter title (Ex: Trip to Goa)">
              </div>
              <div class="row">
                <div class="form-group col-xs-6">
                  <label for="datefrom">From</label>
                  <input type="date" name="datefrom" id="datefrom" min=<?php echo date('Y-m-d'); ?>  max="2020-12-01" class="form-control" placeholder="dd/mm/yy">
                </div>
                <div class="form-group col-xs-6">
                  <label for="dateto">To</label>
                  <input type="date" name="dateto" id="dateto" min=<?php echo date('Y-m-d'); ?> max="2020-12-01" class="form-control" placeholder="dd/mm/yy">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-xs-8">
                  <label for="initialbudget">Initial Budget</label>
                  <input type="number" name="initialbudget" id="initialbudget" class="form-control" placeholder=<?php echo $_SESSION['initial_budget'];?> disabled>
                </div>
                <div class="form-group col-xs-4">
                  <label for="numpeople">No. of people</label>
                  <input type="number" name="numpeople" id="numpeople" class="form-control" placeholder=<?php echo $_SESSION['people'];?> disabled>
                </div>
              </div>
              <?php
              $i = 1;
              while($i <= $_SESSION['people']) {
                $name = "person" . $i;
              ?>
              <div class="form-group">
                <label for=<?php echo $name; ?>>Person <?php echo $i; ?></label>
                <input type="text" name=<?php echo $name; ?> id="person" class="form-control" placeholder=<?php echo $name; ?>>
              </div>
              <?php $i = $i + 1; } ?>
              <button type="submit" class="btn btn-plain btn-hover btn-block">Submit</button>
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