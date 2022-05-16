<?php
include("pcon.php");

$qry="delete from hospital where h_id=".$_GET["id"];
$res=mysqli_query($con,$qry);

if($res==1)
{
	header("Location:display_hospital.php");
}
mysqli_close($con);
?>