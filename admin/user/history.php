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
      }
      .container {
        height:450px;
        overflow-y: scroll;
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
                <h1>History Management</h1>
                <p>This page keeps track of every action that was done on the site for reference</p>
              </div>
          </div>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="homepage.php">Admin</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="admin.php">User Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ubspectrum/admin/events/eventsAdmin.php">Events Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Crowdsourced Data Reviews Management</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="history.php" tabindex="-1">History Management<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="server/signout.php" tabindex="-1">Sign Out</a>
          </li>
        </ul>
      </div>
    </nav>
    <link rel="stylesheet" type="text/css" href="/ubspectrum/bootstrap/css/bootstrap.min.css">
</head>
<body><br><br>

<div class="container">
  <table class="table" id="historyTable">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Application</th>
        <th scope="col">User</th>
        <th scope="col">Data Changed</th>
        <th scope="col">Action</th>
        <th scope="col">Timestamp
          <button type="button" style="float: right;" class="btn btn-secondary btn-sm" onclick=showFilters()>Filter</button>
        </th>
      </tr>
      <tr class="filters" id="rowFilters" hidden>
        <th><select class="form-control" id="app" change=filterApplication()>
              <option></option>
              <option>User Management</option>
              <option>Crowdsourced Data Review</option>
              <option>Events Calendar</option>
            </select>
        </th>
        <th><input type="text" class="form-control" id="user" onkeyup=filterUsers()></th>
        <th><input type="text" class="form-control" id="dataChanged" onkeyup=filterDataChanged()></th>
        <th><input type="text" class="form-control" onkeyup=filterAction() id="action"></th>
        <th><input type="text" class="form-control" onkeyup=filterTimestamp() id="timestamp"></th>
      </tr>
    </thead>
    <tbody id="historyTableBody"></tbody>
</table>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
  <script src="/ubspectrum/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="javascript/history.js"></script>
</body>
</html>
