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
  <title>AdminLTE 2 | Dashboard</title>
  <?php include_once("topscripts.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php echo $string[0]; ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo $string; ?></span>
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

      <body>

  

<form method="post" enctype="multipart/form-data">
   <?php
include("pcon.php");



if(isset($_POST["btnupdate"]))
{ 

 $hospital_name=$_POST["txthospitalname"];
 $address = $_POST['txtadd'];
 $dr = $_POST['txtdr'];

   $upqry1 ="update hospital set h_name='$hospital_name',address='$address',dr_name='$dr' where h_id=".$_GET["id"];

   $upres1=mysqli_query($con,$upqry1)or die(mysqli_error($con));

  if($upres1==1)
   {
      header("Location: display_hospital.php");
   }

 }

$qry1="select h_name,address,dr_name from hospital where h_id=".$_GET["id"];
$res1 = mysqli_query($con,$qry1);
$row=mysqli_fetch_array($res1)
   
?>

  Hospital Name: <input type="text" name="txthospitalname" value="<?php echo $row[0]?>"><br>
  Address: <input type="text" name="txtadd" value="<?php echo $row[1]; ?>" ><br><br>
  Dr Name: <input type="text" name="txtdr" value="<?php echo $row[2]; ?>" ><br><br>
  
 <input type="submit" name="btnupdate" value="submit" >


</form>
</body>
 <?php

 mysqli_close($con);

 ?>


    </section>

  
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once("footer.php"); ?>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php include_once("bottomscripts.php"); ?>
</body>

<!-- Mirrored from adminlte.io/themes/AdminLTE/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Apr 2021 14:03:18 GMT -->
</html>












