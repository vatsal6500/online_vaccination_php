<?php
ob_start();
session_start();
if(!isset($_SESSION['aloggedin']) || $_SESSION['aloggedin']!=true)
{
  header("Location: index.php");
  exit();
}

$string = $_SESSION['ausername'];

?>

<!DOCTYPE html>
<html>

<!-- Mirrored from adminlte.io/themes/AdminLTE/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Apr 2021 14:03:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <title>AdminLTE | Add Vaccine</title>
<?php  include_once("topscripts.php");?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php echo $string[0];?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo $string;?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
<?php include_once("header.php"); ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
<?php include_once("nav.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin
        <small>Home panel</small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <!--PANEL CODE HERE..... END -->
<?php
include("pcon.php");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(isset($_POST["btnsubmit"]))
  {
    $v_name=$_POST["txtvname"];
    $when_to_give=$_POST["txtwtg"];
    $doze_no=$_POST["txtdn"];
    $doze_amount=$_POST["txtda"];
    $route=$_POST["txtr"];
    $site=$_POST["txts"];

    $qry= "insert into vaccination_details(v_name,when_to_give,dose_no,doze_amt,route,site) values('$v_name','$when_to_give','$doze_no','$doze_amount','$route','$site')";
    
    $res=mysqli_query($con,$qry)or die(mysqli_error($con));

    if($res==1)
    {
      header("Location:display_vaccine.php");
    }
  }  
}
?>
<html>
<div class=" col-lg-30">
    <div class="">
  
  <div class="box-header with-border">
  <div class="card-body">
  
    <div class="box-header with-border">
              <h3 class="box-title">PATIENT-DETAILS</h3>
            </div>
  </div>
</div>
<form method="post">

	<b>Vaccine Name: </b>
  <input type="text" name="txtvname" style="border: 2px;"></center><br><br>

	<b>when to give: </b>
  <input type="text" name="txtwtg"></center><br><br>

	<b>Doze Number:</b> 
  <input type="text" name="txtdn"><br><br>

	<b>Doze Amount:</b> 
  <input type="text" name="txtda"><br><br>
	
  <b>Route:</b> 
  <input type="text" name="txtr"><br><br>
	
  <b>Site: </b>
  <input type="text" name="txts"><br><br>
	
	<input type="submit" name="btnsubmit" value="submit" style="border-radius:6px; background-color: lightgreen;">
</form>
</body>
</html>


    </section>

  
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once("footer.php");?>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php include_once("bottomscripts.php");?>
</body>

<!-- Mirrored from adminlte.io/themes/AdminLTE/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Apr 2021 14:03:18 GMT -->
</html>






<?php
ob_end_flush();
?>





