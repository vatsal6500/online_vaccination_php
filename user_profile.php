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


$qry1 = "SELECT * FROM patient_details WHERE email = '" . $_SESSION['username'] . "'";
$res1 = mysqli_query($con,$qry1);
if(!$res1)
{
	die(mysqli_error($con));
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="partials/home.css">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
	<title>Profile</title>
</head>
<body>

		<!-- User Nav Bar -->
		<?php require('partials/_user_navbar.php'); ?>

		<body class="font-mono" style="background-color: royalblue">

	<!-- Registration Form -->

		<!-- Container -->
		<div class="container mx-auto ">

			<div class="flex justify-center px-3 my-12">
				<!-- Row -->
					<!-- Col -->
					<div class="w-max lg:w-6/12 bg-blue-300 p-5 rounded-lg lg:rounded-l-none shadow-2xl">
						<h3 class="pt-4 text-2xl ">Personal Information</h3><br/>
						<hr>
						<form method="post" class="px-8 pt-6 pb-8 mb-4 bg-gray rounded">
							<?php
							while($row1=mysqli_fetch_array($res1))
							{
							?>
<!-- firstname -->
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="adds">
									First Name:&nbsp;<span id="pfname" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
										class="w-min px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="fname"
										type="text"
										name="fname"
										placeholder="First Name"
										disabled
										value="<?php echo $row1[1]; ?>"
									/>
							</div>
<!-- lastname -->	
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="adds">
									Last name:&nbsp;<span id="ppnum" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
										class="w-min px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="lname"
										type="text"
										name="lname"
										placeholder="Last Name"
										disabled
										value="<?php echo $row1[2]; ?>"
									/>
							</div>
<!-- gender -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700" for="gender">
										Gender:&nbsp;<span id="pgender" style="color: red;"></span>
							</label>&nbsp;&nbsp;
							<input
									class="w-min px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="lname"
									type="text"
									name="lname"
									disabled
									value="<?php echo $row1[11]; ?>"
									/>
							</div><br/>
<!-- father name -->
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="adds">
									Father Name:&nbsp;<span id="ppnum" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
										class="w-min px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="faname"
										type="text"
										name="faname"
										placeholder="Father Name"
										disabled
										value="<?php echo $row1[3]; ?>"
									/>
							</div>
<!-- mother name -->
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="adds">
									Mother Name:&nbsp;<span id="ppnum" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
										class="w-min px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="mname"
										type="text"
										name="mname"
										placeholder="Mother Name"
										disabled
										value="<?php echo $row1[4]; ?>"
									/>
							</div>

<!-- address -->
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="adds">
									Address:&nbsp;<span id="padds" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<textarea
									class="w-1/2 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									rows="3"
									id="adds"
									name="adds"
									disabled
								><?php echo $row1[5]; ?></textarea>
							</div>
<!-- phone number -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="adds">
									Phone Number:&nbsp;<span id="ppnum" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
									class="w-max px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="pnum"
									type="text"
									name="pnum"
									placeholder="Phone Number"
									disabled
									value="<?php echo $row1[8]; ?>"
								/>
							</div>
<!-- City -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="city">
									City:&nbsp;<span id="pcity" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
									class="w-max px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="city"
									type="text"
									name="city"
									placeholder="City"
									disabled
									value="<?php echo $row1[9]; ?>"
								/>
							</div>

<!-- DOB -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="dob">
									DOB:
								</label>&nbsp;&nbsp;
								<input
									class="w-max px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="dob"
									type="date"
									name="dob"
									disabled
									value="<?php echo $row1[10]; ?>"
								/>
							</div>

<!-- Weight -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="weight">
									Weight:&nbsp;<span id="pweight" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
									class="w-20 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="weight"
									type="text"
									name="weight"
									placeholder="Weight"
									disabled
									value="<?php echo $row1[12]; ?>"
								/>
							</div>


<!-- email -->
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="email">
									Email:&nbsp;<span id="emails" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
									class="w-1/2 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="email"
									type="email"
									name="email"
									placeholder="Email"
									disabled
									value="<?php echo $row1[6]; ?>"
								/>
								<br/>
							</div>
							<div class="mb-6 ">
							</br>
								<button
									class="w-max px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-yellow-500 focus:outline-none focus:shadow-outline"
									name="btnupdate">
									<a href="user_update.php?p_id=<?php echo $row1[0]; ?>">Click to Update</a>
								</button>
							</div>
							<hr>
						<?php 
						$qry2 = "SELECT * FROM prevaccination_factor WHERE p_id = '" . $row1[0] . "'";
						//printf($qry2);	

						$res2 = mysqli_query($con,$qry2);
						if(!$res2)
						{
							die(mysqli_error($con));
						}


					 	?>
							
					</div>


<!-- Prevaccination factor -->

					<div class="w-max lg:w-6/12 bg-blue-300 p-5 rounded-lg lg:rounded-l-none shadow-2xl">
						<h3 class="pt-4 text-2xl ">PreVaccination Factors!</h3>
						<br/><hr><br/>
						<form method="post" id="regform" class="px-8 pt-6 pb-8 mb-4 bg-gray rounded">
<!-- Weight -->
							<?php 

								while($row2=mysqli_fetch_array($res2))
								{

							 ?>
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700 text-lg" for="bweight">
									Birth Weight:&nbsp;<span id="pbweight" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
									class="w-20  px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="bweight"
									type="text"
									name="bweight"
									disabled
									placeholder="Weight"
									value="<?php echo $row2[1] ?>"
								/>
								
							</div><hr>

<!-- infection -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700 text-lg" for="infection">
										Infection:
									</label>&nbsp;&nbsp;
							<input
									class="w-min px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="lname"
									type="text"
									name="lname"
									disabled
									value="<?php echo $row2[2]; ?>"
									/>
							</div><br/><hr>

<!-- comorbidity -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700 text-lg" for="como">
										Comorbidity:
									</label>&nbsp;&nbsp;
							<input
									class="w-min px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="lname"
									type="text"
									name="lname"
									disabled
									value="<?php echo $row2[3]; ?>"
									/>
								<br/>
							  <font style="color:royalblue;"><li> the simultaneous presence of two or more diseases or medical conditions in a Child.</li></font>

							</div><br/>	<hr>

<!-- Nutritional Status -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700 text-lg" for="nutri">
										Nutritional Status:
									</label>&nbsp;&nbsp;
							<input
									class="w-min px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="lname"
									type="text"
									name="lname"
									disabled
									value="<?php echo $row2[4]; ?>"
									/>
							</div><br/><hr>

<!-- Maternal Antibodies -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700 text-lg" for="maternal">
										Maternal Antibodies:
									</label>&nbsp;&nbsp;
							<input
									class="w-min px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="lname"
									type="text"
									name="lname"
									disabled
									value="<?php echo $row2[5]; ?>"
									/>
								<br/>
							  <font style="color:royalblue;"><li> Antibodies are being metabolized and do not protect any longer</li></font>
							  <br/>
							 <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
							</div>
							
							<div class="mb-6 ">
							</br>
								<button
									class="w-max px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-yellow-500 focus:outline-none focus:shadow-outline"
									name="btnupdate">
									<a href="user_update2.php?p_id=<?php echo $row1[0]; ?>">Click to Update</a>
								</button>
							</div>
							<hr>		
							<?php
								}
							?>																
			</div>
		</div>
		<?php 
			}
		?>
		</form>
</body>
</html>