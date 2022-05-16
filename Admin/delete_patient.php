<?php
include("pcon.php");
$q = "delete from appoint where p_id=".$_GET["id"];
$r = mysqli_query($con,$q) or die(mysqli_error($con));
$qry1 = "delete from prevaccination_factor where p_id=".$_GET["id"];
$res =  mysqli_query($con,$qry1) or die(mysqli_error($con));
$qry="delete from patient_details where p_id=".$_GET["id"];
$res=mysqli_query($con,$qry) or die(mysqli_error($con));

if($res==1)
{
	header("Location: display_patients.php");
}
mysqli_close($con);
?>