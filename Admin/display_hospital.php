<?php

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
  <title>AdminLTE | Hostital</title>
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

<!--<body style="background-color:rgba(255, 99, 71, 0.5);">-->


<!-- ====================================================================== -->

<?php
include("pcon.php");
$qry= "select h_id,h_name,address,dr_name from hospital";

$res= mysqli_query($con,$qry)or die(mysqli_error($con));


if(mysqli_num_rows($res)==0)
{
  echo "no rows found";
}

?>

<html>


<!--255, 99, 71, 0.5-->


  <div class=" col-lg-12">
    <div class="box">
  
  <div class="box-header with-border">
  <div class="card-body">
  
    <div class="box-header with-border">
              <h3 class="box-title">HOSPITAL-DETAILS</h3>
            </div>
  </div>
</div>

<table class="table table-bordered" border="5">



  <tr>
    <th><b>Hospital Name</b></th>
    <th><b>Address</b></th>    
    <th><b>Dr Name</b></th>
    <!-- <th><b>Status</b></th>
    <th><b>Username</b></th> -->
    <th><b>Action</b></th>
    <th><b>Action</b></th>
  </tr>
  
<?php
  while($row=mysqli_fetch_array($res))
  {
  ?>

  <tr>
    <td><i><?php echo $row[1]?></i></td>
    <td><i><?php echo $row[2]?></i></td>
    <td><i><?php echo $row[3]?></i></td>
    <!--  <td><i><?php echo $row[4]?></i></td>
    <td><i><?php echo $row[5]?></i></td> -->

   <td><button class="btn btn-warning badge-pill"><a href="update_hospital.php?id=<?php echo $row[0];?>">Edit</a></button></td>
     <td><button class="btn btn-danger badge-pill"><a href="delete_hospital.php?id=<?php echo $row[0];?>">Delete</a></button></td>


  </tr>
 
   <?php
   }

   mysqli_close($con);
?>
   </table>
  <button class="btn btn-dark badge-pill"><a href="add_hospital.php">Add Hospital</a></button>

  </div>
</body>
</html>
  

<!--<body style="background-color:rgba(255, 99, 71, 0.5);">-->

<!-------------------------------------------------------------------------------------------------------------------------->



   
 

     <!-- MAIN ADMIN PANEL CODE HERE..... START -->
 


     <!-- MAIN ADMIN PANEL CODE HERE..... END -->

    </section>

  
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require("footer.php"); ?>

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





<!-------------------------------------------------------------------------------------------------------------------------->


   