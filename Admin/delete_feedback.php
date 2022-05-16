<?php
include("pcon.php");

$qry="delete from feedback where f_id=".$_GET["id"];
$res = mysqli_query($con,$qry);

if($res==1)
{
	header("Location: display_feedback.php");
}
mysqli_close($con);
?>