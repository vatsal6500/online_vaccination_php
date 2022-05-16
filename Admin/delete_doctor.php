<?php
include("pcon.php");

$qry="delete from doctor where d_id=".$_GET["id"];
$res=mysqli_query($con,$qry);

if($res==1)
{
	header("Location:display_doctor.php");
}
mysqli_close($con);
?>