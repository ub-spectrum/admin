<?php
//ob_start();
//header('content-type: application/json; charset=utf-8');

//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//ini_set('session.cookie_domain', 'stark.cse.buffalo.edu');

session_start();
//echo $_SESSION['sessionID'] ." ". session_id();

if($_SESSION == array()) {
  //echo "true";
  header("Location: http://stark.cse.buffalo.edu/ubspectrum/admin/views/admin/signin.php");
  exit();
}
//ob_end_flush();


//session_start();
//check session variable exist
//$sessionID= (isset($_SESSION['sessionID'])) ? $_SESSION['sessionID'] : 'Error';
//echo $sessionID;
//echo $_SESSION['sessionID'];

 ?>
