<?php
ob_start();
session_start();
if(!isset($_SESSION['aloggedin']) || $_SESSION['aloggedin']!=true)
{
  //header("Location: index.php");
  //exit();
}

$string = $_SESSION['ausername'];

?>

<!DOCTYPE html>
<html>

<!-- Mirrored from adminlte.io/themes/AdminLTE/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Apr 2021 14:03:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <title>AdminLTE 2 | Feedback</title>
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
   
   
    
    <?php
include("pcon.php");
$qry= "select * from feedback";

$res= mysqli_query($con,$qry)or die(mysqli_error());


if(mysqli_num_rows($res)==0)
{
  echo "no rows found";
}

?>

<html>

<body style="background-image: url('vac10.jpg');background-size:cover;">

<!--255, 99, 71, 0.5-->


   <div class=" col-lg-30">
    <div class="box">
  
  <div class="box-header with-border">
  <div class="card-body">
  
    <div class="box-header with-border">
              <h3 class="box-title">FEEDBACK</h3>
            </div>
  </div>
</div>
  
<table class="table table-bordered" border="5">
  <tr>

    <th><b>Name</b></th>
    <th><b>Email</b></th>
    <th><b>Feedback</b></th>
    <th><b>Date</b></th>
    <th><b>Action</b></th>
  
</tr>
  
<?php
  while($row=mysqli_fetch_array($res))
  {
  ?>

  <tr>
    <td><b><?php echo $row[1]?></b></td>
    <td><b><?php echo $row[2]?></b></td>
    <td><b><?php echo $row[3]?></b></td>
    <td><b><?php echo $row[4]?></b></td>
  

    <!-- <td><button class="btn btn-warning badge-pill"><a href="billup.php?id=<?php echo $row[0];?>">Edit</a></button></td> -->

      <td><button class="btn btn-danger badge-pill"><a href="delete_feedback.php?id=<?php echo $row[0];?>">Delete</a></button></td>


  </tr>
 
   <?php
   }

   mysqli_close($con);
?>
   </table>
<!--    <td><b><button class="btn btn-info badge-pill"><a href="hosinsert.php">Add bill</a></button></b></td> -->

  </div>
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
































