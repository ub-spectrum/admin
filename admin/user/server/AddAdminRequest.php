<?php

  header('content-type: application/json; charset=utf-8');
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  require "Models/Login.php";

  // get the username and the password
  $firstName = $_POST['firstName'] or '';
  $lastName = $_POST['lastName'] or '';
  $email = $_POST['email'] or '';
  $password = $_POST['password'] or '';

  Login::signUp($firstName, $lastName, $email, $password);


 ?>
