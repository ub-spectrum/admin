<?php
  session_start();
  if($_SESSION == array() || !isset($_SESSION['sessionID'])) {
    header("Location: signin.php");
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/header.css">
    <title>UB Spectrum Admin</title>
    <style>
      .panel {
        margin-right: 5%;
        margin-left: 5%;
      }
      .h1 {
        font-family: 'Open Sans', serif;
        font-size: 40px;
      }
    </style>

        <a href="https://www.ubspectrum.com/" target="blank">
       <div class="flip-card" >
           <div class="flip-card-inner">
               <div class="flip-card-front">
                    <img src="../images/logo.png" alt="Avatar" style="width:200px;height:200px;">
               </div>
               <div class="flip-card-back">
                    <p>THE INDEPENDENT STUDENT PUBLICATION OF THE UNIVERSITY AT BUFFALO, SINCE 1950</p>
               </div>
           </div>
       </div>
    </a>

      <div id="jumbo">
          <div id="textInJumbo">
            <h1>User Management</h1>
          </div>
      </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="homepage.php">Admin</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="admin.php">User Management<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ubspectrum/admin/events/eventsAdmin.php">Events Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Crowdsourced Data Reviews Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="history.php" tabindex="-1">History Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="server/signout.php" tabindex="-1">Sign Out</a>
          </li>
        </ul>
      </div>
    </nav>
    <link rel="stylesheet" type="text/css" href="/ubspectrum/bootstrap/css/bootstrap.css">
</head>
<body>
  <br>
  <div class="panel"><div class="panel-body">
    <h3 align="center">Current Admins</h3>
    <div class="card-deck-wrapper">
    <div class="card-deck" id="existingAdmins" align="center"></div>
  </div></div></div>
    <br><br><div style="background-color:#D2D5E0;color:white;padding:10px;"></div><br><br>
    <div class="panel"><div class="panel-body">
    <h3 align="center">Pending Admins</h3>
    <div class="card-deck", id="pendingAdmins" align="center"></div></div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
  <script src="/ubspectrum/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="javascript/admin.js"></script>
</body>
</html>
