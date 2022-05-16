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
  <title>AdminLTE 2 | Doctor</title>
  <?php  include_once("topscripts.php"); ?>
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
     <!--PANEL CODE HERE..... END -->
    <?php
include("pcon.php");

if(isset($_POST["btnupdate"]))
{ 

 $doctor_name=$_POST["txtdoctorname"];
 $status=$_POST["txtstatus"];
 $mobile_no=$_POST["txtmobileno"];
 $h_id=$_POST["combo"];
 $tmp_path=$_FILES['upload_file']['tmp_name'];
 $dest_path=$_FILES['upload_file']['name'];

 if(move_uploaded_file($tmp_path,$dest_path))
 {
  echo"successfully uploaded";
 }
 else
 {
   echo"upload failed";
 }

   $upqry1 ="update doctor set d_name='$doctor_name',status='$status',mobile_no='$mobile_no',h_id='$h_id',pic='$dest_path' where d_id=".$_GET["id"];

   $upres1=mysqli_query($con,$upqry1);

   if($upres1==1)
   {
     header("location:display_doctor.php"); 
   }
}

$qry1="select d_name,status,mobile_no,pic from doctor where d_id=".$_GET["id"];
$res1 = mysqli_query($con,$qry1);
$row=mysqli_fetch_array($res1)
   
?>

<body>
<form method="post" enctype="multipart/form-data">

  doctor_name: <input type="text" name="txtdoctorname" value="<?php echo $row[0]?>"><br><br>

  Status:
  <input type="radio" name="txtstatus" value="yes" <?php if($row[1]=="yes") echo "checked"; ?>>Yes
  <input type="radio" name="txtstatus" value="no" <?php if($row[1]=="no") echo "checked"; ?>>No<br/><br/>

  
  Mobileno: <input type="text" name="txtmobileno" value="<?php echo $row[2]?>"><br><br/>

  Hospital:
  <select name="combo" class="combo">
    <?php 
      $qry1 = "select * from hospital";
      $res1 = mysqli_query($con,$qry1);
      while($row1 = mysqli_fetch_array($res1))
      {
      ?>
     <option value="<?php echo $row1[0];?>"> <?php  echo $row1[1]; ?></option>
    <?php
    }
    ?>
  </select><br/>

    </select><br>

    Image:<input type="file" name="upload_file"><img src="<?php echo $row[3]; ?>"></input>
    

  <input type="submit" name="btnupdate" value="submit">
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












