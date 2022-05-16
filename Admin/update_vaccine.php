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
  <title>AdminLTE | Vaccination Update</title>
  <?php  include_once("topscripts.php");?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <section class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php echo $string[0];?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo $string;?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
   <?php include_once("header.php");?>
  </section>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include_once("nav.php");?>

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

$qry1="select v_id,v_name,when_to_give,dose_no,doze_amt,route,site from vaccination_details where v_id=".$_GET["id"];
//print($qry1);
$res1 = mysqli_query($con,$qry1);
$row=mysqli_fetch_array($res1);
if(isset($_POST["btnupdate"]))
{ 

  $v_name=$_POST["txtvname"];
  $when_to_give=$_POST["txtwtg"];
  $doze_no=$_POST["txtdn"];
  $doze_amount=$_POST["txtda"];
  $route=$_POST["txtr"];
  $site=$_POST["txts"];

   $upqry1 ="update vaccination_details set v_name='$v_name',when_to_give='$when_to_give',dose_no='$doze_no',doze_amt='$doze_amount',route='$route',site='$site' where v_id=".$_GET["id"];

   $upres1=mysqli_query($con,$upqry1)or die(mysqli_error($con));;

   if($upres1==1)
   {

     header("location:display_vaccine.php",true); 
   }
}
   
   
?>

<body>
<form method="post" enctype="multipart/form-data">

 Vaccination Name: 
 <input type="text" name="txtvname" value="<?php echo $row[1]?>"><br><br>

  when to give: 
  <input type="text" name="txtwtg" value="<?php echo $row[2]?>"><br><br>
 
  doze Number: 
  <input type="text" name="txtdn" value="<?php echo $row[3]?>"><br><br>
 Doze Amount: 
 <input type="text" name="txtda" value="<?php echo $row[4]?>"><br><br>
 Route: 
 <input type="text" name="txtr" value="<?php echo $row[5]?>"><br><br>
 Site:
  <input type="text" name="txts" value="<?php echo $row[6]?>"><br><br>

  <input type="submit" name="btnupdate" value="submit" style="border-radius:6px; background-color: lightgreen;">
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


<?php
ob_end_flush();
?>









