<?php
  header('content-type: application/json; charset=utf-8');
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  session_start();

  $_SESSION = array();
  session_unset();
  session_destroy();
  //echo $_SESSION['sessionID'];

  header("Location: ../views/admin/signin.php", true, 301);
 ?>
