<?php
include "db_connection_script.php";
$i = 0;
$j = 0;
$n = "";
$string = array();
$name = array();
$title = $_POST['title'];
$date_from = $_POST['datefrom'];
$date_to = $_POST['dateto'];
$budget = $_SESSION['initial_budget'];
$people = $_SESSION['people'];
$plan_query = "insert into plan(title, date_from, date_to, budget, numpeople) values('$title', DATE_FORMAT('$date_from', '%Y-%m-%d'), DATE_FORMAT('$date_to', '%Y-%m-%d'), '$budget', '$people')";
$plan_query_result = mysqli_query($con, $plan_query);
if (!$plan_query or !$plan_query_result) {
  echo die('insertion failed: ' . mysqli_error($con));
}
else {
  echo "details accepted"."<br>";
}
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
  array_push($string, 'person'.$count);
  array_push($name, $_POST['person'.$count]);
  if($count <= $row[0]) {
    echo "column '$count' exists";
  }
  else {
    $add_column_query = "ALTER TABLE people ADD $string[$i] TEXT(30)";
    $add_column_query_result = mysqli_query($con, $add_column_query);
  }
  if($count == $people) {
    $insert_people_query = build_sql_insert($string, $name);
    $insert_people_query_result = mysqli_query($con, $insert_people_query);
    echo implode(",", $string) . "<br>";
    echo implode(",", $name) . "<br>";
  }
  $count = $count + 1;
  $i = $i +1;
}
?>