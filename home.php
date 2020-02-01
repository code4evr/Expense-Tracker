<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("location: index.php");
}
else {
  include "scripts/db_connection_script.php";
  $sql = "SELECT id, title, date_from, date_to, budget, numpeople FROM plan";
  $sql_result = mysqli_query($con, $sql);
  $sql1 = "SELECT * FROM plan";
  $sql_result1 = mysqli_query($con, $sql1);
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
  include "header_logout.php";
  ?>
  <?php
  $row = mysqli_fetch_array($sql_result1);
  if(count($row) == 0) {
  ?>
  <div class="container" style="margin-top:10%;">
    <div class="row">
      <div>
        <h3>Your don't </h3>
      </div>
      <br>
      <br>
      <div class="col-xs-3 col-xs-offset-4">
        <div class="panel panel-default">
          <div class="panel-body" style="padding-top:75px; padding-bottom:75px;">
            <center>
              <a href="add_new_plan.php"><span><i class="fas fa-plus-circle"></i></span> Create a new plan</a>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  } else { ?>
  <div class="container" style="margin-top:8%;">
    <div class="row">
      <div class="col-xs-3">
        <h4>Active plans</h4>
      </div>
    </div>
    <br>
    <div class="row">
      <?php
      $_SESSION['plan_id'] = array();
      while($rows = mysqli_fetch_array($sql_result)) {
      array_push($_SESSION['plan_id'], $rows['id']);
      $date_from = date_create($rows['date_from']);
      $date_to = date_create($rows['date_to']); ?>
      <form action="home_script.php" method="post">
        <div class="col-xs-3">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Plan</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-6">
                  <h5 class="text-left">Budget</h5>
                </div>
                <div class="col-xs-6">
                  <h5 class="text-right"><?php echo $rows['budget'];?></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-2">
                  <h5 class="text-left">Date</h5>
                </div>
                <div class="col-xs-10">
                  <h5 class="text-right"><?php echo (date_format($date_from, "jS M") . " - " . date_format($date_to, "jS M Y"));?></h5>
                </div>
              </div>
              <br>
              <button type="submit" class="btn btn-plain btn-hover btn-block" name="view" value=<?php echo $rows['id'];?>>View</button>
            </div>
          </div>
        </div>
      </form>
      <?php }?>
    </div>
  </div>
  <?php }?>
  <div>
  </div>
  <div class="container">
    <div class="row">
      <div class="text-right bottom_align"><a href="add_new_plan.php"><span><i class="fas fa-plus-circle add_icon"></i></span></a></div>
    </div>
  </div>
  <?php
  include 'footer.php';
  ?>
</body>
</html>