<?php
//date_default_timezone_set('Africa/Cairo');
//
//include('assets/config.php');
//
//$emp_id=$_SESSION['emp_id'];
//
//
//mysqli_select_db($website, $database_website);
//$stmt = mysqli_query($website, "SELECT login_id FROM employee_login WHERE emp_id = '$emp_id' ORDER BY login_id DESC ") or die(mysqli_error($website));
//$row_stmt = mysqli_fetch_assoc($stmt);
//
//$logout = date('Y-m-d h:i:sa' , time());
//$login=  $row_stmt['login_id'];
//mysqli_query($website, "UPDATE employee_login SET logout_time = '$logout'  WHERE login_id = '$login' ");
session_start();
session_destroy();
session_unset();

header('location:index.php');
?>