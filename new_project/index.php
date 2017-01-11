<?php
session_start();
if (!file_exists("config.php") || !include_once "config.php") {
  header("location: install.php");
}
if (!defined('posnicEntry')) {
  define('posnicEntry', true);
}
if (isset($_SESSION['username'])) {
  if ($_SESSION['usertype'] == 'admin') // if session variable "username" does not exist.
    header("location: dashboard.php"); // Re-direct to index.php
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Salon | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

   <!-- Scripts -->
  <script src="js/lib/jquery.min.js" type="text/javascript"></script>
  <script src="js/lib/jquery.validate.min.js" type="text/javascript"></script>

  <script>
    /*$.validator.setDefaults({
     submitHandler: function() { alert("submitted!"); }
     });*/

    $(document).ready(function () {

      // validate signup form on keyup and submit
      $("#login-form").validate({
        rules: {
          username: {
            required: true,
            minlength: 3
          },
          password: {
            required: true,
            minlength: 3
          }
        },
        messages: {
          username: {
            required: "Please enter a username",
            minlength: "Your username must consist of at least 3 characters"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 3 characters long"
          }
        }
      });

    });

  </script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">

    <img width="60%" height="30%" src="images/company-logo.png">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login into System</p>

    <form action="checklogin.php" method="post" id="login-form" autocomplete="off">
      <p> <?php

        if (isset($_REQUEST['msg']) && isset($_REQUEST['type'])) {

          if ($_REQUEST['type'] == "error")
            $msg = "<div class='error-box round'>" . $_REQUEST['msg'] . "</div>";
          else if ($_REQUEST['type'] == "warning")
            $msg = "<div class='warning-box round'>" . $_REQUEST['msg'] . "</div>";
          else if ($_REQUEST['type'] == "confirmation")
            $msg = "<div class='confirmation-box round'>" . $_REQUEST['msg'] . "</div>";
          else if ($_REQUEST['type'] == "information")
            $msg = "<div class='information-box round'>" . $_REQUEST['msg'] . "</div>";

          echo $msg;
        }
        ?>

      </p>
      <div class="form-group has-feedback">
        <input type="text" class="form-control"  id="login-username" name="username" placeholder="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="login-password" name="password"  placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
<!--          <input type="submit" class="button round blue image-right ic-right-arrow" name="submit" value="LOG IN"/>-->
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>



<!--    <a href="forget_pass.php">I forgot my password</a><br>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
