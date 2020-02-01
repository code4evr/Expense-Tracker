<?php
include "db_connection_script.php";
$i = 0;
$j = 0;
$n = "";
$title = $_POST['title'];
$date_from = $_POST['datefrom'];
$date_to = $_POST['dateto'];
$budget = $_SESSION['initial_budget'];
$people = $_SESSION['people'];
$email = $_SESSION['email'];
$plan_query = "insert into plan(title, date_from, date_to, budget, numpeople) values('$title', DATE_FORMAT('$date_from', '%Y-%m-%d'), DATE_FORMAT('$date_to', '%Y-%m-%d'), '$budget', '$people')";
$plan_query_result = mysqli_query($con, $plan_query);
if (!$plan_query or !$plan_query_result) {
  echo die('insertion failed: ' . mysqli_error($con));
}
else {
  echo "details accepted"."<br>";
}
$_SESSION['plan'] = mysqli_insert_id($con);
echo $_SESSION['plan'];
//insert function
/*function build_sql_insert($colname, $value) {
  $col = $colname;
  $data = $value;
  $sql = "insert into people(" . implode(',', $col) . ") " . "values ('" . implode("','", $data) . "')";
  return $sql;
}*/
/*function insert_foreign_keys() {
  $sql = "insert into user_plan(user_id, plan_id, group_id) SELECT users.id, plan.id, people.id FROM users, plan, people";
}*/
//$check_column_query = "SELECT COUNT(*) AS NUMCOL FROM information_schema.columns WHERE table_name = 'people' AND column_name LIKE 'person%'";
//$check_column_query_result = mysqli_query($con, $check_column_query);
//$row = mysqli_fetch_array($check_column_query_result);
//$offset = $people - $row[0];
$count = 1;
while($i < $people) {
  $name = $_POST['person'.$count];
  $insert_people_query = "insert into people(plan_id, person) values((SELECT plan.id FROM plan WHERE title = '$title' and date_from = '$date_from' and date_to = '$date_to' and budget = '$budget' and numpeople = '$people'), '$name')";
  $insert_people_query_result = mysqli_query($con, $insert_people_query);
  if (!$insert_people_query or !$insert_people_query_result) {
    echo die('insertion failed: ' . mysqli_error($con));
  }
  else {
    echo $name."inserted successfully";
  }
  $insert_userplan_query = "insert into user_plan(user_id, group_id) values((SELECT users.id FROM users WHERE email = '$email'), (SELECT people.id FROM people WHERE plan_id = (SELECT plan.id FROM plan WHERE title = '$title' and date_from = '$date_from' and date_to = '$date_to' and budget = '$budget' and numpeople = '$people') and person = '$name'))";
  $insert_userplan_query_result = mysqli_query($con, $insert_userplan_query);
  if (!$insert_userplan_query or !$insert_userplan_query_result) {
    echo die('insertion failed: ' . mysqli_error($con));
  }
  else {
    echo $name."inserted successfully";
  }
  $count = $count + 1;
  $i = $i +1;
}
?>