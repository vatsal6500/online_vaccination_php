<?php

$con = mysqli_connect("localhost","root","");
$db = mysqli_select_db($con,'vaccination');

if(!$con)
{
	die(mysqli_error($con));
}

if(!$db)
{
	die(mysqli_error($con));
}

?>