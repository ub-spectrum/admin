<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <?php include('/ubspectrum/events/head-tags.php') ?>
    <style>
      input {
        margin-bottom:10px;
      }
      h8 {
        color: red;
        display: none;
      }
    </style>
    <script src="/ubspectrum/pdfjs/build/pdf.js"></script>
    <script src="/ubspectrum/pdfThumbnails.js"></script>
    <script src="/ubspectrum/events/tagify.min.js"></script>
    <link rel="stylesheet" href="/ubspectrum/events/tagify.css">

    <title>UB Spectrum Admin</title>
    <?php include('/ubspectrum/events/navbar-bootstrap.php')?>
    <br>
    <h1>Sign into UB Spectrum Admin</h1>
    <link rel="stylesheet" type="text/css" href="/ubspectrum/bootstrap/css/bootstrap.min.css">
  </head>

  <body class="text-center"><br><br>

    <form class="form-signin" style="margin: 0 auto; width:250px" align="center" action="server/signin.php" method="post">
      <h3 align="center">Sign in</h3>
      <h8 id="error" align="center">Username or password is incorrect</h8>
      <label for="inputEmail">
      <input type="email" id="inputEmail" class="form-control input-sm" size=40 placeholder="Email address" name="username" required autofocus></label>
      <label for="inputPassword">
      <input type="password" id="inputPassword" name="password" size=40 class="form-control" placeholder="Password" required></label>
      <button class="btn btn-primary btn" type="submit">Sign in</button>
    </form>
    <button type="button" onclick="window.location.href='SignUp.php'" class="btn btn-link">Not an admin? Apply to be one</button><br><br>
    <h8 id="access" align="center">Admin Request Pending</h8>
    <?php include('/ubspectrum/events/footer-bootstrap.php') ?>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="/ubspectrum/bootstrap/js/bootstrap.min.js"></script>
<script>
  window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const isInvalid = urlParams.get('invalid');
    const hasAccess = urlParams.get('access');
    if (isInvalid !== null || isInvalid === "true") {
      document.getElementById("error").style.display = "block";
    } else if (hasAccess !== null || hasAccess === "false") {
      document.getElementById("access").style.display = "block";
    }
  }
</script>
</html>