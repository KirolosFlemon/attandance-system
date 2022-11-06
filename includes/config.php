<?php
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
      if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
      }

      $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

      switch ($theType) {
        case "text":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;
        case "long":
        case "int":
          $theValue = ($theValue != "") ? intval($theValue) : "NULL";
          break;
        case "double":
          $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
          break;
        case "date":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;
        case "defined":
          $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
          break;
      }
      return $theValue;
    }
}

//// start session //////
if (!isset($_SESSION)) {
  session_start();
//  ini_set('session.gc_maxlifetime',87000);
}




//// application name ////
$application_name='qr_code';
//// end application name ////



////// defining the server ////
$server='http://localhost/qr_code/';
//$server='https://qr.benegypt.com/';
////// end define the server ////

 $hostname_website = "localhost";
 $database_website = "attendance";
 $username_website = "root";
 $password_website = "";

// $hostname_website = "minigolfcitycom.ipagemysql.com";
// $database_website = "attendance";
// $username_website = "attendance";
// $password_website = "Hanyadel1977.";

$website = mysqli_connect($hostname_website, $username_website, $password_website) or trigger_error(mysqli_error($website),E_USER_ERROR);


mysqli_query($website , "SET NAMES utf8");
mysqli_query($website , "SET SESSION SQL_BIG_SELECTS=1;");

mysqli_select_db($website, $database_website);


date_default_timezone_set('Africa/Cairo')

//// temporary organization ////
?>
