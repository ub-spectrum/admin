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
        if ($r['RANK'] == 1) {
          if (hash("sha3-256", $password) == $r['PASSWORD']) {
          // start the session if the username and password is correct
          session_start();
          $_SESSION['sessionID'] = session_id();
          // redirect to the homepage
          header("Location: ../views/admin/homepage.php");
        } else {
          header("Location: http://stark.cse.buffalo.edu/ubspectrum/admin/views/admin/signin.php?invalid=true");
        }
      } else {
        header("Location: http://stark.cse.buffalo.edu/ubspectrum/admin/views/admin/signin.php?access=false");
      }}
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

    public static function signUp($firstName, $lastName, $email, $password) {
      $conn = self::getDB();

      $fname = $conn->real_escape_string($firstName);
      $lname = $conn->real_escape_string($lastName);
      $em = $conn->real_escape_string($email);
      $pass = $conn->real_escape_string($password);
      $hash = hash("sha3-256", $password);
      $fullName = $fname ." ". $lname;
      $tempToken = uniqid();
      $approved = 0;

      $stmt = $conn->prepare("INSERT INTO tbl_admin(
                EMAIL,
                PASSWORD,
                RANK,
                FULL_NAME,
                TEMP_TOKEN) VALUES (
                ?,
                ?,
                ?,
                ?,
                ? );");

                $stmt->bind_param("ssiss",
                $email,
                $hash,
                $approved,
                $fullName,
                $tempToken);

                $stmt->execute();
                $stmt->close();

                header("Location: http://stark.cse.buffalo.edu/ubspectrum/admin/views/admin/signin.php");
    }



  }





 ?>
