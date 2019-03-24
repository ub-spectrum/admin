<?php
  require_once "../../events/Models/DatabaseConnector.php";

  class Login extends DatabaseConnector {

    public static function checkCredentials($username, $password) {
      // connect to database
      $conn = self::getDB();

      // process and call query
      $username = $conn->real_escape_string($username);
      $checkCredentials = "SELECT * from tbl_admin WHERE EMAIL='".$username."'";

      // get result
      $result = mysqli_query($conn, $checkCredentials);

      if ($result != NULL) {
        // get the result
        $r = mysqli_fetch_assoc($result);

        // verify the password
        if (password_verify($password, $r['PASSWORD'])) {
          // start the session if the username and password is correct
          session_start();
          $_SESSION['sessionID'] = session_id();
          // redirect to the homepage
          header("Location: ../views/admin/homepage.php");
        } else {
          echo '<script type="text/javascript">', 'callAlert();','</script>';
        }
      } else {
        echo '<script type="text/javascript">', 'callAlert();','</script>';
      }
    }

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





 ?>
