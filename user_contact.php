<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
	header("Location: index.php");
	exit;
}

include("partials/_db.php");

$qry = "SELECT f_name,l_name,dob,email FROM patient_details WHERE email = '" . $_SESSION['username'] . "'";
$res = mysqli_query($con,$qry); 
if(!$res)
{
    die(mysqli_error($con));
}
$row = mysqli_fetch_array($res);

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="partials/home.css">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<title>Contact Us</title>
</head>
<body class="bg-blue-300">
		<!-- nav bar -->
	 <?php require('partials/_user_navbar.php'); ?>

	<div class="container">
		<img style="height: 600px; width: 1550px;" src="https://www.who.int/images/default-source/imported/contact-us.tmb-1920v.jpg?sfvrsn=fa0e6c6e_6">
	</div>
	<div class="container" style="margin: 100px;" >
		<span style="font-size: 40px">For general inquries</span><br/><br/>
		<hr>
		<br/><br/><br/>
		<span style="font-style: 40px"> <b>Our Headquarters in Surat</b> </span><br/>
		<p>&nbsp;&nbsp;&nbsp;Adajan</p>
		<p>&nbsp;&nbsp;&nbsp;Surat</p>
		<p>&nbsp;&nbsp;&nbsp;India</p>
		<br/>
		<p>&nbsp;&nbsp;&nbsp;Telephone: +91-0261-634572</p>

	</div>
	<div class="container" style="margin: 100px;" >
		<span style="font-size: 20px">Follow us on Social Media</span><br/><br/>
		<hr>
		<br/>
		&nbsp;&nbsp;&nbsp;Facebook : <a href="https://facebook.com/ChildVaccination" target="_blank">https://facebook.com/ChildVaccination</a><br/>
		&nbsp;&nbsp;&nbsp;Twitter : <a href="https://twitter.com/ChildVaccination" target="_blank">https://twitter.com/ChildVaccination</a><br/>
		&nbsp;&nbsp;&nbsp;Instagram : <a href="https://instagram.com/ChildVaccination" target="_blank">https://instagram.com/ChildVaccination</a><br/>
	</div>


  <!-- footer -->
  <?php require('partials/_footer.php'); ?>

</body>
</html>