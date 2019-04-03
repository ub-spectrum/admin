<?php
  require_once "../../../events/Models/DatabaseConnector.php";
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  class Event extends DatabaseConnector {

        public static function getEventInfo($id) {
          // connect to database
          $conn = self::getDB();

          // process and call query
          $username = $conn->real_escape_string($id);
          $eventInfo = "SELECT ID, NAME, VENUE, START_TIME, END_TIME, DESCRIPTION, LINK, COST, PHONE, EMAIL, UB_CAMPUS_LOCATION, ADDED_BY from tbl_events WHERE ID='".$id."'";

          // get result
          $result = mysqli_query($conn, $eventInfo);

          if ($result != NULL) {
            // get the result
            $r = mysqli_fetch_assoc($result);

            return json_encode($r);
          } else {
            //echo '<script type="text/javascript">', 'callAlert();','</script>';
          }
        }

        public static function deleteEvent($eventId) {
          // connect to database
          $conn = self::getDB();

          // process and call query
          $eventId = $conn->real_escape_string($eventId);
          $eventInfo = "UPDATE tbl_events SET APPROVAL_STATUS='delete' WHERE ID='".$eventId."'";

          // get result
          mysqli_query($conn, $eventInfo);
        }

        public static function updateEvent($eventId, $name, $addedBy, $venue, $startTime, $endTime, $description, $link, $cost, $phone, $email,$ubCampusLocation="", $approvalStatus = "pending", $categories="", $contacts=array()) {
          $conn = self::getDB();

          $name = $conn->real_escape_string($name);
          $venue = $conn->real_escape_string($venue);
          $startTime = $conn->real_escape_string($startTime);
          $endTime = $conn->real_escape_string($endTime);
          $description = $conn->real_escape_string($description);
          $link = $conn->real_escape_string($link);
          $cost = $conn->real_escape_string($cost);
          $phone = $conn->real_escape_string($phone);
          $email = $conn->real_escape_string($email);
          $ubCampusLocation = $conn->real_escape_string($ubCampusLocation);
          $categories = $conn->real_escape_string($categories);
          $approvalStatus = $conn->real_escape_string($approvalStatus);
          $addedBy = $conn->real_escape_string($addedBy);
          $categories = $conn->real_escape_string($categories);
          $eventId = $conn->real_escape_string($eventId);

          $eventId = (int)$eventId;

          $stmt = $conn->prepare("UPDATE tbl_events SET
            NAME=?,
            VENUE=?,
            START_TIME=DATE_FORMAT('".$startTime."', '%Y-%m-%dT%TZ'),
            END_TIME=DATE_FORMAT('".$endTime."', '%Y-%m-%dT%TZ'),
            DESCRIPTION=?,
            LINK=?,
            COST=?,
            PHONE=?,
            EMAIL=?,
            UB_CAMPUS_LOCATION=?,
            APPROVAL_STATUS=?,
            ADDED_BY=? WHERE ID='".$eventId."'");

          $stmt->bind_param("ssssdsssss", $name, $venue, $description, $link,
            $cost, $phone, $email, $ubCampusLocation, $approvalStatus, $addedBy);

          $stmt->execute();
          $last_id = $conn->insert_id;
          $stmt->close();

          if(strlen($categories) > 0){
              $categoryIdList = explode(",",$categories);
              $stmt =$conn->prepare("DELETE FROM tbl_event_categories
                WHERE EVENT_ID='".$eventId."'");
                $stmt->execute();
                $stmt->close();

                $stmt =$conn->prepare("INSERT INTO tbl_event_categories
                    (`EVENT_ID`,
                    `CATEGORY_ID`)
                    VALUES
                    (?,?);
                ");
              foreach ($categoryIdList as $categoryId) {
                  $stmt->bind_param("ii", $eventId, $categoryId);
                  $stmt->execute();
              }
              $stmt->close();
          }

          if(sizeof($contacts) > 0){

            $stmt =$conn->prepare("DELETE FROM tbl_event_contacts
              WHERE EVENT_ID='".$eventId."'");
              $stmt->execute();
              $stmt->close();

              $stmt =$conn->prepare("INSERT INTO tbl_event_contacts
                  (`EVENT_ID`,
                   `CONTACT_TYPE`,
                   `PERSON_NAME`,
                   `ADDITIONAL_INFO`)
                  VALUES
                  (?,?,?,?);
              ");
              foreach ($contacts as $contact) {
                  $stmt->bind_param("isss", $eventId, $contact['type'], $contact['name'], $contact['info']);
                  $stmt->execute();
              }
              $stmt->close();
          }
        }

        public static function updateFlyer($eventId, $additionalFile, $additionalFileSize, $additionalFileType) {
          $conn = self::getDB();
          $eventId = $conn->real_escape_string($eventId);
          $additionalFile= $conn->real_escape_string($additionalFile);
          $additionalFileSize = $conn->real_escape_string($additionalFileSize);
          $additionalFileType = $conn->real_escape_string($additionalFileType);

          $stmt = $conn->prepare("UPDATE tbl_events SET
            ADDITIONAL_FILE= '$additionalFile',
            ADDITIONAL_FILE_SIZE=?,
            ADDITIONAL_FILE_TYPE=? WHERE ID='".$eventId."'");

          $stmt->bind_param("is", $additionalFileSize, $additionalFileType);

          $stmt->execute();
          $last_id = $conn->insert_id;
          $stmt->close();
        }
  }
