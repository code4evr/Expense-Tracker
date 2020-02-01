<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("location: index.php");
}
else {
  include "scripts/db_connection_script.php";
  $view_id = $_SESSION['view_plan_id'];
  $sql = "SELECT * FROM plan WHERE id = $view_id";
  $sql_result = mysqli_query($con, $sql);
  $sql_people = "SELECT * FROM people WHERE plan_id = $view_id";
  $sql_people_result = mysqli_query($con, $sql_people);
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
  include 'header_logout.php'
  ?>
  <?php
  $spent = 0;
  while($row = mysqli_fetch_array($sql_result)) {
    $date_from = date_create($row['date_from']);
    $date_to = date_create($row['date_to']);
  ?>
  <div class="container"style="margin-top:8%;">
    <div class="row">
      <div class="col-xs-6 col-xs-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center">
            <h4><?php echo $row['title'];?></h4>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-6">
                <h5 class="text-left">Initial Budget</h5>
              </div>
              <div class="col-xs-6">
                <h5 class="text-right">&#8377;<?php echo $row['budget'];?></h5>
              </div>
            </div>
            <?php
            $count = 1;
            while($people_row = mysqli_fetch_array($sql_people_result)) {
            ?>
            <div class="row">
              <div class="col-xs-6">
                <h5 class="text-left"><?php echo "Person".$count;?></h5>
              </div>
              <div class="col-xs-6">
                <h5 class="text-right money"><?php echo $people_row['person'];?></h5>
              </div>
            </div>
            <?php $count = $count + 1; } ?>
            <div class="row">
              <div class="col-xs-6">
                <h5 class="text-left">Remaining Amount</h5>
              </div>
              <div class="col-xs-6">
                <h5 class="text-right money">&#8377;<?php echo $row['budget'] - $spent;?></h5>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php
  include 'footer.php';
  ?>
</body>
</html>