<?php
  session_start();
  if($_SESSION == array() || !isset($_SESSION['sessionID'])) {
    header("Location: http://stark.cse.buffalo.edu/ubspectrum/admin/views/admin/signin.php");
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <a class="nav-link" href="eventsAdmin.php">Events Management</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="crowdsourceAdmin.php">Crowdsourced Data Reviews Management<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="history.php" tabindex="-1">History Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signin.php" tabindex="-1">Sign Out</a>
          </li>
        </ul>
      </div>
    </nav>
    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
</head>
<body>
  <br><h1 align="center">Crowdsourced Data Reviews Management</h1><br>
  <button type="button" class="btn btn-primary btn" style="float: right; margin-right:4em;">Go To Student Sign Up</button>
  <button type="button" class="btn btn-primary btn" style="float: right; margin-right:1em;">Add New Dataset +</button><br>
  <br>
  <div class="panel"><div class="panel-body">
    <h3 align="center">Current Datasets</h3>
    <table class="table" id="currentDatasets">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Dataset Name</th>
          <th scope="col">Posted By</th>
          <th scope="col">Description</th>
          <th scope="col">File Type</th>
          <th scope="col">Split #</th>
          <th scope="col" id="progress"></th>
          <th scope="col" id="download"></th>
          <th scope="col" id="archive"></th>
        </tr>
      </thead>
      <tbody id="currentDatasetsBody"></tbody>
    </table>
  </div></div>

<br><br><div style="background-color:#D2D5E0;color:white;padding:10px;"></div><br>

    <br> <div class="panel"><div class="panel-body">
        <h3 align="center">Archive Datasets</h3>
        <table class="table" id="archiveDatasets">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Dataset Name</th>
              <th scope="col">Posted By</th>
              <th scope="col">Archive Date</th>
              <th scope="col">Description</th>
              <th scope="col">File Type</th>
              <th scope="col">Split #</th>
              <th scope="col" id="progress"></th>
              <th scope="col" id="download"></th>
              <th scope="col" id="archive"></th>
            </tr>
          </thead>
          <tbody id="archiveDatasetsBody"></tbody>
        </table>
      </div></div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
  <script src="../../bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../javascript/admin/crowdsourceAdmin.js"></script>
</body>
</html>
