<?php
  require_once "Models/Event.php";
  require_once "../../../events/Models/EmailManager.php";
    require_once "../../../events/Models/Events.php";

  $eventId = $_POST['eventId'];
  $type = $_POST['type'];
  $reason = isset($_POST['reason']) ? $_POST['reason'] : NULL;
  $action = isset($_POST['action']) ? $_POST['action'] : '';
  if ($type == "recur") {
    Event::deleteRecurringEvent($eventId);
  } else {
    Event::deleteEvent($eventId);
  }

  if($action == "decline"){
      $eventInfo = Events::getEventInfo($eventId);
      $declineSubject= "The event ".$eventInfo["NAME"]." has been declined";
      $declineMessage = "The event ".$eventInfo["NAME"]." has been declined. The reason was: $reason. Thanks, UB Spectrum";
      $declineHTMLMessage = "Hi there, <br/>The event ".$eventInfo["NAME"]." has been declined. The reason was:<br/><br/> $reason <br/><br/></br> Thanks, UB<br/> Spectrum"; 

      $mail = new SpectrumEmail();
      $mail->sendMessage(array($eventInfo["ADDED_BY"]), $declineSubject, $declineHTMLMessage,$declineMessage);
  }

  



 ?>
