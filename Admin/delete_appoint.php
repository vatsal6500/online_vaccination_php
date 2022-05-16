<?php
include("pcon.php");

$qry="delete from appoint where a_id=".$_GET["id"];
$res=mysqli_query($con,$qry);

if($res==1)
{
	header("Location:display_appoint.php");
}
mysqli_close($con);
?>