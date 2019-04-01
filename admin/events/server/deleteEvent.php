<?php
  require_once "Models/Event.php";

  $eventId = $_POST['eventId'];

  Event::deleteEvent($eventId);

 ?>
