<?php

include("pcon.php");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(isset($_POST["btnsubmit"]))
  {
    $username = $_POST["username"];
    if(empty($username))
    {
      echo '<div class="text-white bg-red-500 bg-opacity-50" ><strong>Error!</strong> UserName required.</div>';
    }
    $pass = $_POST["pass"];
    if(empty($pass))
    {
      echo '<div class="text-white bg-red-500 bg-opacity-50" ><strong>Error!</strong> Password required.</div>';
    }
    else
    {
      $qry ="call adminlogin('$username','$pass')";
      $res = mysqli_query($con,$qry);
      if(!$res)
      {
      echo '<div class="text-white bg-red-500 bg-opacity-50" ><strong>Error!</strong>Admin Not found!</div>';
      }
      if(mysqli_num_rows($res)==1)
      {
        session_start();
        $_SESSION['aloggedin'] = true;
        $_SESSION['ausername'] = $username;
        header("Location: admin.php");
      }
    }
  }
}

?>

<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE | Log in</title>
 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
 
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <link rel="stylesheet" type="text/css" href="home.css">
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your Admin page</p>

    <form method="post" >
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="username">
       
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
      </div>
      <div class="row">
        <div class="col-xs-8">
          <button type="submit" name="btnsubmit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><a href="../user_login.php">Back</a></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
    <!-- /.social-auth-links -->

    <!-- <a href="" class="text-center">Register a new admin</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
