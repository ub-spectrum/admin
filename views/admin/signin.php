<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <style>
      input {
        margin-bottom:10px;
      }
    </style>
    <title>UB Spectrum Admin</title>
    <br>
    <h1>Sign into UB Spectrum Admin</h1>
    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
  </head>

  <body class="text-center"><br><br><br>
    <form class="form-signin" style="margin: 0 auto; width:250px;" align="center" action="../../server/signin.php" method="post">
      <h3 align="center">Sign in</h3>
      <label for="inputEmail">
      <input type="email" id="inputEmail" class="form-control" size=40 placeholder="Email address" name="username" required autofocus></label>
      <label for="inputPassword">
      <input type="password" id="inputPassword" name="password" size=40 class="form-control" placeholder="Password" required></label>
      <button class="btn btn-primary btn-block" type="submit">Sign in</button>
    </form>
    <button type="button" class="btn btn-link">Not an admin? Apply to be one</button>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<script>
  function callAlert() {
    alert("Username or password incorrect"); // this is the message in ""
  }
</script>
</html>
