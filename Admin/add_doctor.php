
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
  <title>AdminLTE | Doctor</title>
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

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(isset($_POST['btnsubmit']))
  {
    $doctor_name=$_POST["txtdoctorname"];
    $status=$_POST["txtstatus"];
    $mobile_no=$_POST["txtmobileno"];
    $h_id=$_POST["combo"];
    $tmp_path=$_FILES['upload_file']['tmp_name'];
    $dest_path=$_FILES['upload_file']['name'];

    if(move_uploaded_file($tmp_path,$dest_path))
    {
      //echo"sucessfulyy uploaded";
    }
    else
    {
      //echo"upload failed";
    }

    $qry= "INSERT INTO `doctor` (`d_id`, `d_name`, `pic`, `status`, `mobile_no`, `h_id`) VALUES (NULL, '$doctor_name', '$dest_path', '$status', '$mobile_no', '$h_id');";

    
    $res=mysqli_query($con,$qry) or die(mysqli_error($con));

    if($res==1)
    {
      header("location:display_doctor.php");
    }
  }
  
}
?>
<html>
<body>
<form method="post" enctype="multipart/form-data">

  Doctor Name: <input type="text" name="txtdoctorname"><br><br/>

  Status: <input type="radio" name="txtstatus"
   <?php if (isset($status) && $status=="yes") echo "checked";?>
    value="yes">Yes

   <input type="radio" name="txtstatus"
   <?php if (isset($status) && $status=="no") echo "checked";?>
    value="no">No
    <br><br/>


Mobile Number : <input type="text" name="txtmobileno"><br><br/>

Hospital Name:<select name="combo" class="combo">
    <?php 
      $qry1 = "select * from hospital";
      $res1 = mysqli_query($con,$qry1);
     /* var_dump($res1);
      if(!$res1)
        echo mysqli_error($con);*/
      while($row1 = mysqli_fetch_array($res1))
      {
      ?>
    <option value="<?php echo $row1[0];?>"> <?php  echo $row1[1]; ?></option>
    <?php
    }
    ?>
  </select><br><br>

    </select>

        pic: <input type="file" name="upload_file">  <br><br/>
  
  

  <input type="submit" name="btnsubmit" value="submit">
</form>
</body>
</html>



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





