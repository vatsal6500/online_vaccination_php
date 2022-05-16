<?php
//ob_start();
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
	header("Location: index.php");
	exit;
}

include("partials/_db.php");

$qry1 = "SELECT * FROM patient_details WHERE p_id =".$_GET["p_id"];
$res1 = mysqli_query($con,$qry1);
if(!$res1)
{
	die(mysqli_error($con));
}

$err="";
$err1="";
$err2="";
$err3="";
$gender="";

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{

		if(isset($_POST['btnupdate']))
		{
			$gender="";
			
			include('partials/_db.php');

			$fname = $_POST['fname'];
			
			$lname = $_POST['lname'];
			
			$faname = $_POST['faname'];
			
			$mname = $_POST['mname'];
			
			$adds = $_POST['adds'];
			
			$pnum = $_POST['pnum'];
			
			$city = $_POST['city'];
			
			$weight = $_POST['weight'];
			
			if(!isset($_POST['gender']))
			{
				$err = "Gender is empty";
			}
			else
			{
				$gender = $_POST['gender'];
			}
			$dob = $_POST['dob'];
			if(!isset($_POST['dob']))
			{
				$err1 = "DOB is empty";
			}

			$uqry = "UPDATE `patient_details` SET `f_name` = '$fname', `l_name` = '$lname', `father_name` = '$faname', `mother_name` = '$mname', `address` = '$adds', `phone_no` = '$pnum', `city` = '$city', `dob` = '$dob', `weight` = '$weight', `dt` = 'current_timestamp()' WHERE `patient_details`.`p_id` = ".$_GET["p_id"];
			//printf($uqry);
			$ures = mysqli_query($con,$uqry);
			if($ures)
			{
				$_SESSION['logged']=1;
				header("Location: user_profile.php");
			}

		}
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title> User | Update </title>

	<link rel="stylesheet" type="text/css" href="partials/home.css">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">

	<style type="text/css">
		label{
			font-style: italic;
			font-size: 18px;
		}
		strong{
			color: red;
		}
	</style>
	<script type="text/javascript" src="jquery.js"></script>

	<!-- reset data -->
	<script type="text/javascript">
		function newfunction(){
			document.getElementById("regform").reset();
		}
	</script>
	<script type="text/javascript">
				$(document).ready(function(){

			$("#fname").on('input',function(){
				var fname = $("#fname").val();
				var fnamex = /^[a-zA-Z]{2,15}$/;
				if(fnamex.test(fname))
				{
					$("#pfname").text("");
				}
				else
				{
					$("#pfname").text("*");
				}
			});

			$("#lname").on('input',function(){
				var lname = $("#lname").val();
				var lnamex = /^[a-zA-Z]{2,15}$/;
				if(lnamex.test(lname))
				{
					$("#plname").text("");
				}
				else
				{
					$("#plname").text("*");
				}
			});

			$("#faname").on('input',function(){
				var faname = $("#faname").val();
				var fanamex = /^[a-zA-Z]{2,15}$/;
				if(fanamex.test(faname))
				{
					$("#pfaname").text("");
				}
				else
				{
					$("#pfaname").text("*");
				}
			});

			$("#mname").on('input',function(){
				var mname = $("#mname").val();
				var mnamex = /^[a-zA-Z]{2,15}$/;
				if(mnamex.test(mname))
				{
					$("#pmname").text("");
				}
				else
				{
					$("#pmname").text("*");
				}
			});

			$("#adds").on('input',function(){
				var adds = $("#adds").val();
				var addsx = /^[a-zA-Z0-9-,. ]{10,50}$/;
				if(addsx.test(adds))
				{
					$("#padds").text("");
				}
				else
				{
					$("#padds").text("*");
				}
			});

			$("#pnum").on('input',function(){
				var pnum = $("#pnum").val();
				var pnumx = /^(\+91-|\+91|0)?\d{10}$/;
				if(pnumx.test(pnum))
				{
					$("#ppnum").text("");
				}
				else
				{
					$("#ppnum").text("*");
				}
			});

			$("#city").on('input',function(){
				var city = $("#city").val();
				var cityx = /^[a-zA-Z ]{2,20}$/;
				if(cityx.test(city))
				{
					$("#pcity").text("");
				}
				else
				{
					$("#pcity").text("*");
				}
			});

			$("#weight").on('input',function(){
				var weight = $("#weight").val();
				var weightx = /^[0-9]{1,2}$/;
				if(weightx.test(weight))
				{
					$("#pweight").text("");
				}
				else
				{
					$("#pweight").text("*");
				}
			});


                $("form").submit(function(){

                    var fname = $("#fname").val();

					var lname = $("#lname").val();

					var faname = $("#faname").val();

					var mname = $("#mname").val();

					var adds = $("#adds").val();

					var pnum = $("#pnum").val();

					var city = $("#city").val();

					var weight = $("#weight").val();


                    if(fname=="")
                    {
                        $("#spfname").text("first name is empty");
                        return false;
                    }
                    else{
                        $("#spfname").text("");                    	
                    }

                    if(lname=="")
                    {
                        $("#splname").text("last name is empty");
                        return false;
                    }
                    else{
                        $("#splname").text("");                    	
                    }

                    if(faname=="")
                    {
                        $("#spfaname").text("Father name is empty");
                        return false;
                    }
                    else{
                        $("#spfaname").text("");                    	
                    }

                    if(mname=="")
                    {
                        $("#spmname").text("Mother name is empty");
                        return false;
                    }
                    else{
                        $("#spmname").text("");                    	
                    }

                    if(adds=="")
                    {
                        $("#spadds").text("Address name is empty");
                        return false;
                    }
                    else{
                        $("#spadds").text("");                    	
                    }

                    if(punm=="")
                    {
                        $("#sppnum").text("Phone number is empty");
                        return false;
                    }
                    else{
                        $("#sppunm").text("");                    	
                    }

                    if(city=="")
                    {
                        $("#spcity").text("city is empty");
                        return false;
                    }
                    else{
                        $("#spcity").text("");                    	
                    }

                    if(weight=="")
                    {
                        $("#spweight").text("Weight is empty");
                        return false;
                    }
                    else{
                        $("#spweight").text("");                    	
                    }

                });

		});

	</script>

</head>

</head>
<body class="font-mono" style="background-image: url('images/user_bg.jpg');">

		<?php include_once('partials/_user_navbar.php');?>

		<div class="container mx-auto">
			<div class="flex justify-center px-6 my-12">
				<!-- Row -->
					<!-- Col -->
					<div class="w-full lg:w-7/12 bg-blue-200 p-5 rounded-lg lg:rounded-l-none shadow-2xl">
						<h3 class="pt-4 text-2xl ">Update Patients Details</h3>
						
						<form method="post" id="regform" class="px-8 pt-6 pb-8 mb-4 bg-gray rounded" action="#">
							<?php
							while($row1=mysqli_fetch_array($res1))
							{
							?>
<!-- firstname -->
							<div class="mb-4 md:flex">
								<div class="mb-4 md:mr-2 md:mb-0">
									<label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
										First Name:&nbsp;<span id="pfname" style="color: red;"></span>
									</label>
									<input
										class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="fname"
										type="text"
										name="fname"
										placeholder="First Name"
										value="<?php echo $row1[1]; ?>"
									/>
									<b><span id="spfname" style="color: red;"></span></b>
								</div>
<!-- lastname -->
								<div class="md:ml-2">
									<label class="block mb-2  text-sm font-bold text-gray-700" for="lastName">
										Last Name:&nbsp;<span id="plname" style="color: red;"></span>
									</label>
									<input
										class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="lname"
										type="text"
										name="lname"
										placeholder="Last Name"
										value="<?php echo $row1[2]; ?>"
									/>
									<b><span id="splname" style="color: red;"></span></b>
								</div>
							</div>
<!-- gender -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700" for="gender">
										Gender:&nbsp;<span id="pgender" style="color: red;"></span>
									</label>
							  <div class="mt-2">
							    <label class="inline-flex items-center">
							      <input type="radio" class="form-radio" name="gender" id="gender" value="male"<?php if($row1[11]=="male") echo "checked"; ?>
							      >
							      <label class="ml-2">Male</label>
							    </label>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" id="gender" name="gender" value="female" <?php if($row1[11]=="female") echo "checked"; ?>
							     >
							      <label class="ml-2">Female</label>
							    </label>
							  </div>
							  <b><span style="color: red;"><?php echo $err;  ?></span></b>
							  <br/>
							  <br/>
							</div>
<!-- father name -->
							<div class="mb-4  md:flex">
								<div class="mb-4 md:mr-2 md:mb-0">
									<label class="block mb-2 text-sm font-bold text-gray-700" for="faname">
										Father Name:&nbsp;<span id="pfaname" style="color: red;"></span>
									</label>
									<input
										class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="faname"
										type="text"
										name="faname"
										placeholder="Father Name"
										value="<?php echo $row1[3]; ?>"
									/>
									<b><span id="spfaname" style="color: red;"></span></b>
								</div>
<!-- mother name -->
								<div class="md:ml-2">
									<label class="block mb-2  text-sm font-bold text-gray-700" for="mname">
										Mother Name:&nbsp;<span id="pmname" style="color: red;"></span>
									</label>
									<input
										class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="mname"
										type="text"
										name="mname"
										placeholder="Mother Name"
										value="<?php echo $row1[4]; ?>"
									/>
									<b><span id="spmname" style="color: red;"></span></b>
								</div>
							</div>

<!-- address -->
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="adds">
									Address:&nbsp;<span id="padds" style="color: red;"></span>
								</label>
								<textarea
									class="w-1/2 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									rows="3"
									id="adds"
									name="adds"
								><?php echo $row1[5]; ?></textarea>
								<b><span id="spadds" style="color: red;"></span></b>
							</div>
<!-- phone number -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="adds">
									Phone Number:&nbsp;<span id="ppnum" style="color: red;"></span>
								</label>
								<input
									class="w-max px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="pnum"
									type="text"
									name="pnum"
									placeholder="Phone Number"
									value="<?php echo $row1[8]; ?>"
								/>
								<b><span id="sppnum" style="color: red;"></span></b>
							</div>
<!-- City -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="city">
									Area&nbsp;<span id="pcity" style="color: red;"></span>
								</label>
								<input
									class="w-max px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="city"
									type="text"
									name="city"
									placeholder="City"
									value="<?php echo $row1[9]; ?>"
								/>
								<b><span id="spcity" style="color: red;"></span></b>
							</div>

<!-- DOB -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="dob">
									DOB:
								</label>
								<input
									class="w-max px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="dob"
									type="date"
									name="dob"
									value="<?php echo $row1[10]; ?>"
								/>
								<b><span style="color: red;"><?php echo $err1;  ?></span></b>
							</div>

<!-- Weight -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="weight">
									Weight:&nbsp;<span id="pweight" style="color: red;"></span>
								</label>
								<input
									class="w-20 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="weight"
									type="text"
									name="weight"
									placeholder="Weight"
									value="<?php echo $row1[12]; ?>"
								/>
							</div>

<!-- next button  and reset button-->							
							<div class="mb-6 ">
							</br>
								<button
									class="w-min px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-green-500 focus:outline-none focus:shadow-outline"
									name="btnupdate">
									Update
								</button>
							</div>
						<?php } ?>
						</form>
					</div>
			</div>
		</div>



</body>
</html>




<?php

//ob_end_flush();

?>