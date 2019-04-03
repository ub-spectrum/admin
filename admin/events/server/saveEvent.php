<?php
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once "Models/Event.php";

    $name = $_POST['name'] or '';
    $venue = $_POST['venue'] or '';
    $description = $_POST['description'] or '';
    $link = $_POST['link'] or '';
    $ub_campus = $_POST['ub_campus'] or '';
    $cost = $_POST['cost'] or '';
    $date = $_POST['date'] or '';
    $start_time = $_POST['start_time'] or '';
    $end_time = $_POST['end_time'] or '';
    $posted_by = $_POST['addedBy'] or '';
    $type = $_POST['event_type'] or '';
    $flyer="";
    $flyerSize="";
    $flyerType="";

    $eventId = $_POST['event_id'] or '';

    if(isset($_FILES['flyer'] ) && $_FILES['flyer']['tmp_name'] != null){
        $flyer = file_get_contents($_FILES['flyer']['tmp_name']);
        $flyerSize = $_FILES['flyer']['size'];
        $file_info = new finfo(FILEINFO_MIME);
        $mime_type = $file_info->buffer($flyer);
        $flyerType = $mime_type;
        Event::updateFlyer($eventId, $flyer, $flyerSize,$flyerType);
    }

    $contact_count = $_POST['contact_count'] or 1;
    $ub_campus = $_POST['ub_campus'] or '';
    $categories =  $_POST['categories'] or '';

   $posted_by = htmlentities(   $posted_by);
   $name = htmlentities(   $name);
   $venue = htmlentities(   $venue);
   $description = htmlentities(   $description);
   $link = htmlentities(   $link);
   $ub_campus = htmlentities(   $ub_campus);
   $cost = htmlentities(   $cost);
   $date = htmlentities(   $date);
   $start_time = htmlentities(   $start_time);
   $end_time = htmlentities(   $end_time);
   $contact_count = htmlentities($contact_count);
   $eventId = htmlentities($eventId);
   $ub_campus = htmlentities($ub_campus);
   $type = htmlentities($type);
   $categories = htmlentities($categories);

    $start_time = "$date $start_time";
    $end_time = "$date $end_time";

    $contacts = array();
    for ($i=1; $i <= $contact_count; $i++) {
        $contactName = $_POST['contact_'.$i.'_name'] or '';
        $contactType = $_POST['contact_'.$i.'_type'] or '';
        $contactInfo = $_POST['contact_'.$i.'_info'] or '';

        $contactName = htmlentities($contactName);
        $contactType = htmlentities($contactType);
        $contactInfo = htmlentities($contactInfo);

        $contacts[] = array('name'=> $contactName, 'type' => $contactType, 'info' => $contactInfo);
    }


    if ($type == "existing") {
        $type = "accepted";
    }

    Event::updateEvent($eventId, $name, $posted_by, $venue, $start_time, $end_time, $description, $link, $cost, "", "", $ub_campus, $type, $categories, $contacts );

    header("Location: ../eventsAdmin.php");

?>
