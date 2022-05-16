<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
	header("Location: index.php");
	exit;
}

/*if($_SERVER['METHOD_REQUEST'] == 'POST')
{

}*/
include("partials/_db.php");
//echo $_SESSION['username'] . "</br>" . $_SESSION['password'] . "</br>" . $_GET["email"];

$qry = "SELECT f_name,l_name FROM patient_details WHERE email = '" . $_SESSION['username'] . "'";
//print($qry);
$res = mysqli_query($con,$qry);
if(!$res)
{
	//die(mysqli_error($con));
}

$row = mysqli_fetch_array($res);



?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="partials/home.css">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
	<title>Welcome <?php echo $row[0]."&nbsp;".$row[1]; ?> </title>
	
</head>
<body class="" >
	<!--nav bar -->
	<?php require('partials/_user_navbar.php'); ?>
	<form method="post">
		<section class="text-gray-600 body-font bg-green-50" style="background-image:linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.6)), url(images/vac21.jpg); background-size:cover;">
  <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
    <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
      <div class="text-center">
        <br/><center>
       <br/><center>
        <a class="inline-flex items-center bg-blue-100 border-0 py-1 px-3 focus:outline-none hover:bg-green-400 rounded text-base mt-4 md:mt-0" href="vaccine_table.php">Make My Schedule</a>
      </div><br></center>
      <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">If you nurture your child well
        <br class="hidden lg:inline-block">he will become the nation's pride
      </h1>
      <p class="mb-8 leading-relaxed"></p>
      <ul>  

    <li class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white" style="font-size: 20px" ><b>Vaccine recipients to locate and schedule vaccination appointments, complete prescreening questionnaires to expedite appointments, receive text reminders for appointments and follow-up needs (for multiple doses as applicable), and access an immunization certification using a PC or tablet.</b></li><br>

    <li class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white" style="font-size: 20px">
     <b>Text or email reminders and notifications regarding the appointments</b></li><br>

     <li class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white" style="font-size: 20px"><b>View or download the immunization certificate from the vaccine recipients portal for providing to school, day care and camp entry and to meet employment requirements</b></li>
    </ul>
    </div>
    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 shadow-2xl">
      <img class="object-cover object-center rounded" alt="hero" src="images/vac011.jpg"><br/>
    </div>
  </div>
<center><button class="inline-flex items-center bg-red-400 border-0 py-1 px-3 focus:outline-none  rounded text-base mt-4 md:mt-0"><a href="pdf.pdf" target="_blank" download="us-gps-mass-vaccination-user-journey.pdf">Download a pdf</a></button><br><b style="color: white">Genral vaccination chart</b></center>

</section>
	</form>

	<!-- News -->
	<?php require('partials/_news.php'); ?>

	<!-- feedback -->
		<?php require('partials/user_feedback.php'); ?>

	<!-- Footer -->
	<?php require('partials/_footer.php'); ?>
</body>
</html>