<?php
  session_start();
  if($_SESSION == array() || !isset($_SESSION['sessionID'])) {
    header("Location: http://stark.cse.buffalo.edu/ubspectrum/admin/user/signin.php");
    exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/ubspectrum/bootstrap/css/header.css">
    <title>UB Spectrum Admin</title>
    <style>
      .panel {
        margin-right: 5%;
        margin-left: 5%;
      }
      .h1 {
        font-family: 'Open Sans', serif;
        font-size: 40px;
        display: inline-block;
        margin: 0;
      }
      .container {
        height:300px;
        margin-left:0px;
        margin-right: 0px;
        overflow-y: scroll;
        margin:0px;
      }

    </style>
    <a href="https://www.ubspectrum.com/" target="blank">
      <div class="flip-card" >
        <div class="flip-card-inner">
          <div class="flip-card-front">
            <img src="/ubspectrum/admin/user/images/logo.png" alt="Avatar" style="width:200px;height:200px;">
          </div>
        <div class="flip-card-back">
          <p>THE INDEPENDENT STUDENT PUBLICATION OF THE UNIVERSITY AT BUFFALO, SINCE 1950</p>
        </div>
        </div>
       </div>
    </a>

    <div id="jumbo">
        <div id="textInJumbo">
          <h1>Events Management</h1>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="/ubspectrum/admin/user/homepage.php">Admin</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/ubspectrum/admin/user/admin.php">User Management</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/ubspectrum/admin/events/eventsAdmin.php">Events Management<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ubspectrum/admin/crowdsource/activeDatasetsView.php">Crowdsourced Data Reviews Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ubspectrum/admin/user/history.php" tabindex="-1">History Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ubspectrum/admin/user/server/signout.php" tabindex="-1">Sign Out</a>
          </li>
        </ul>
      </div>
    </nav>
    <link rel="stylesheet" type="text/css" href="/ubspectrum/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <br><br>

    <button type="button" onclick="window.location.href='http://stark.cse.buffalo.edu/ubspectrum/events/'" class="btn btn-primary btn" style="float: right;margin-right:3em;">Go To Calendar</button>
    <button type="button" onclick="window.location.href='/ubspectrum/events/AddEvent.php'" class="btn btn-primary btn" style="float: right;margin-right:1em ">Add New Event +</button><br>

    <br><div class="panel"><div class="panel-body">
    <h3 align="center">Pending Events</h3><br>
    <div class="card-deck", id="pendingEvents" align="center"</div></div><br>
  </div>
  </div>

    <br><br><div style="background-color:#D2D5E0;color:white;padding:10px;"></div><br><br>

    <div class="panel"><div class="panel-body">
      <h3 align="center">Existing Events</h3><br>
      <div class="card-deck-wrapper">
      <div class="card-deck" id="existingEvents" align="center"></div>
      <br>
    </div></div></div>
  <br>
</body>

<script src="/ubspectrum/events/tagify.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="/ubspectrum/bootstrap/js/popper.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="/ubspectrum/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="javascript/eventsAdmin.js"></script>
</html>
