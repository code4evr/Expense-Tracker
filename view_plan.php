<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("location: index.php");
}
else {
  include "scripts/db_connection_script.php";
  $view_id = $_SESSION['view_plan_id'];
  $title = $_POST['title'];
  $date = $_POST['date'];
  $amount = $_POST['amount'];
  $choice = $_POST['choice'];
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
      <div class="col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading text-center">
            <h4><?php echo $row['title'];?></h4>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-6">
                <h5 class="text-left">Budget</h5>
              </div>
              <div class="col-xs-6">
                <h5 class="text-right">&#8377;<?php echo $row['budget'];?></h5>
              </div>
            </div>
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
      <div class="col-xs-2 col-xs-offset-2" style="margin-top:6%">
        <a href="expense_distribution.php">
          <button class="btn btn-plain btn-hover btn-block">Expense Distribution</button>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
      <?php
      $expense_select = "SELECT * FROM new_expense WHERE plan_id = $view_id";
      $expense_select_result = mysqli_query($con, $expense_select);
      while($expense_rows = mysqli_fetch_array($expense_select_result)) {
      $paid_on = date_create($expense_rows['spent_date']);
      ?>
        <div class="col-xs-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4><?php echo $expense_rows['title'];?></h4>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-6">
                  <h5>Amount</h5>
                </div>
                <div class="col-xs-6">
                  <h5><?php echo $expense_rows['amount_spent'];?></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  <h5>Paid By</h5>
                </div>
                <div class="col-xs-6">
                  <h5><?php echo $expense_rows['paid_by'];?></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  <h5>Paid On</h5>
                </div>
                <div class="col-xs-6">
                  <h5><?php echo date_format($paid_on, "jS M Y");?></h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
      <div class="col-xs-4 col-xs-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading text-center">
            <h4>Add Expenses</h4>
          </div>
          <div class="panel-body">
            <div class="container-fluid">
              <div class="row">
                <form action="view_plan.php" method="post">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Title" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" placeholder="dd/mm/yyyy" class="form-control" required>
                    <?php
                    $date_check = date_create($date);
                    if($_POST['submit']) {
                      if($date_check >= $date_from and $date_check <= $date_to) {
                        $insert_expenses = "INSERT INTO new_expense(title, spent_date, amount_spent, paid_by, plan_id) values('$title', '$date', '$amount', '$choice', $view_id)";
                        $insert_expenses_result = mysqli_query($con, $insert_expenses);
                        $_SESSION['expense_id'] = mysqli_insert_id($con);
                      } else {
                        echo "<script>alert('Dates not in range')</script>";
                      }
                      header("refresh:0;url=view_plan.php");
                    }
                    ?>
                  </div>
                  <div class="form-group">
                    <label for="amount">Amount Spent</label>
                    <input type="number" name="amount" id="amount" placeholder="amount" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <select name="choice" id="choice" class="form-control" placeholder="Choose" required>
                      <option value="Choose" selected="selected" disabled>Choose</option>
                      <?php
                      while($people_rows = mysqli_fetch_array($sql_people_result)) {
                      ?>
                      <option value="<?php echo $people_rows['person'];?>"><?php echo $people_rows['person'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-plain btn-hover btn-block" name="submit" value="1">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
  </div>
  <?php } ?>
  <?php
  include 'footer.php';
  ?>
</body>
</html>