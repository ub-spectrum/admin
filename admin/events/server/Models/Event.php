<?php
  require_once "../../../events/Models/DatabaseConnector.php";

  class Event extends DatabaseConnector {

        public static function getEventInfo($id) {
          // connect to database
          $conn = self::getDB();

          // process and call query
          $username = $conn->real_escape_string($id);
          $eventInfo = "SELECT * from tbl_events WHERE ID='".$id."'";

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
  }
