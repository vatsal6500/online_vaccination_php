<?php

session_start();
if(!isset($_SESSION['aloggedin']) || $_SESSION['aloggedin']!=true)
{
  header("Location: index.php");
  exit();
}


include("pcon.php");

$qry="delete from vaccination_details where v_id=".$_GET["id"];
$res=mysqli_query($con,$qry);

if($res==1)
{
	header("Location:display_vaccine.php");
}
mysqli_close($con);
?>