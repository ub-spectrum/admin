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
        overflow-y: scroll;
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
            <a class="nav-link" href="">Crowdsourced Data Reviews Management</a>
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
    <h3 align="center">Existing Events</h3><br>
    <div class="card-deck-wrapper">
    <div class="card-deck" id="existingEvents" align="center"></div>
    <br>
  </div></div></div>

    <br><br><div style="background-color:#D2D5E0;color:white;padding:10px;"></div><br><br>

    <div class="panel"><div class="panel-body">
    <h3 align="center">Pending Events</h3><br>
    <div class="card-deck", id="pendingEvents" align="center"</div></div><br>
  </div>
  </div><br>

  <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="existingEventsModal">Event Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">
        <div class="modal-body mx-3">
          <form id="form8">
          <div class="container" id="disabledContainer">

            <div class="md-form">
              <i class="fas fa-tag prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="form8">Name: </label>
              <input type="text" id="eventName" class="form-control validate">
            </div>

            <div class="md-form">
              <i class="fas fa-pencil prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="form8">Description: </label>
              <textarea type="text" id="eventDescription" class="md-textarea form-control" rows="4"></textarea>
            </div>

            <div class="row mb-3">
              <div class="col-xs-12 col-md-4 text-md-right">
                <label for="eventStartTime">Start At</label>
              </div>
              <div class="col-xs-12 col-md-3 col-lg-2">
                <input type="text" name="eventStartTime" id="eventStartTime" class="form-control" maxlength="10" required />
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-xs-12 col-md-4 text-md-right">
                <label for="eventEndTime">End At</label>
              </div>
              <div class="col-xs-12 col-md-3 col-lg-2">
                <input type="text" name="eventEndTime" id="eventEndTime" class="form-control" maxlength="10" required />
              </div>
            </div>

            <div class="md-form">
              <i class="fas fa-tag prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="form8">Location: </label>
              <input type="text" id="eventLocation" class="form-control validate">
            </div>

            <div class="md-form">
              <i class="fas fa-tag prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="form32">Cost: </label>
              <input type="number" id="eventCost" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
              <label><input type="checkbox" id="eventFree">Free</label>
            </div>


            <label data-error="wrong" data-success="right" for="form32">Categories: </label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" id="category1" type="checkbox" value="option1">
              <label class="form-check-label" for="inlineCheckbox1">Category 1</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" id="category2" type="checkbox" value="option2">
              <label class="form-check-label" for="inlineCheckbox2">Category 2</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="category3" value="option3">
              <label class="form-check-label" for="inlineCheckbox3">Category 3</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="category4" value="option4">
              <label class="form-check-label" for="inlineCheckbox3">Category 4</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="category5" value="option5">
              <label class="form-check-label" for="inlineCheckbox5">Category 5</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="category6" value="option6">
              <label class="form-check-label" for="inlineCheckbox3">Category 6</label>
            </div>

            <div class="md-form">
              <i class="fas fa-tag prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="form32">Contact Email: </label>
              <input type="text" id="contactEmail"  class="form-control validate">
            </div>

            <div class="md-form">
              <i class="fas fa-tag prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="form32">Contact Phone Number: </label>
              <input type="text" id="contactPhone" class="form-control validate">
            </div>

            <div class="md-form">
              <i class="fas fa-tag prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="form32">Link: </label>
              <input type="text" id="eventLink" class="form-control validate">
            </div>

            <div class="md-form">
              <i class="fas fa-tag prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="form32">Flyer Link: </label>
              <input type="text" id="eventFlyerLink" class="form-control validate">
            </div>

            <div class="md-form">
              <i class="fas fa-pencil prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="form8">Additional Notes: </label>
              <textarea type="text" id="eventAdditionalInfo" class="md-textarea form-control" rows="4"></textarea>
            </div>

        </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" id="closeBtn" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" id="saveBtnExisting" class="btn btn-outline-primary btn-sm pull-left">Save</button>
        <button type="button" id="saveBtnPending" class="btn btn-outline-primary btn-sm pull-left">Save</button>
        <button type="button" id="editBtn" class="btn btn-outline-primary btn-sm pull-left">Edit</button>
        <button type="button" id="editEvent" class="btn btn-outline-primary btn-sm pull-left">Edit</button>
        <button type="button" id="acceptEvent" class="btn btn-outline-success btn-sm pull-left">Accept</button>
        <button type="button" id="declineEvent" class="btn btn-outline-danger btn-sm pull-left">Decline</button>
        <button type="button" id="deleteEvent" class="btn btn-outline-danger btn-sm pull-left">Delete</button>
      </div>
    </div>
  </div></div></div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="/ubspectrum/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="javascript/eventsAdmin.js"></script>
</body>
</html>
