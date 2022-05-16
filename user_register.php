<!-- navbar -->
<?php require('partials/_navbar.php');?>
<?php
$err="";
$err1="";
$err2="";
$err3="";
$gender="";
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{

		if(isset($_POST['btnnext']))
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
			
			$dob = $_POST['dob'];
			
			$weight = $_POST['weight'];
			
			$email = $_POST['email'];

			$pass = $_POST['pass'];
			
			$cpass = $_POST['cpass'];
			
			if(!isset($_POST['gender']))
			{
				$err = "Gender is empty";
			}
			else
			{
				$gender = $_POST['gender'];
			}

			if(!isset($_POST['dob']))
			{
				$err1 = "DOB is empty";
			}

			/*duplicate email checking*/
			$existsql = "select email from patient_details where email = '$email'";
			/*select email from patient_details where email = '$email'*/
			/*call existemail('$email')*/
			$result = mysqli_query($con,$existsql);
			$numexistrows = mysqli_num_rows($result);
			if($numexistrows > 0)
			{
				$err3 = "Email ID  already used."; 
				
			}
			else
			{
				if(($pass == $cpass) && !empty($pass) && !empty($cpass))
				{					
					$qry ="INSERT INTO `patient_details` (`f_name`, `l_name`, `father_name`,
					 `mother_name`, `address`, `email`, `pass`, `phone_no`, `city`,
					  `dob`, `gender`, `weight`, `dt`) VALUES ('$fname','$lname','$faname','$mname',
					   '$adds', '$email', '$pass', '$pnum', '$city',
					    '$dob', '$gender', '$weight', current_timestamp())";

					/*INSERT INTO `patient_details` (`f_name`, `l_name`, `father_name`,
					 `mother_name`, `address`, `email`, `pass`, `phone_no`, `country`, `state`, `city`,
					  `dob`, `gender`, `weight`, `dt`) VALUES ('$fname','$lname','$faname','$mname',
					   '$adds', '$email', '$pass', '$pnum', '$country', '$state', '$city',
					    '$dob', '$gender', '$weight', current_timestamp())

					    call insertpatient('$fname','$lname','$faname','$mname',
					   '$adds', '$email', '$pass', '$pnum', '$country', '$state', '$city',
					    '$dob', '$gender', '$weight')*/

					$res = mysqli_query($con,$qry);
					if($res)
			        {
			        	setcookie("fname",$fname,time()+(900),"user_register_2.php");
						setcookie("lname",$lname,time()+(900),"user_register_2.php");
						setcookie("email",$email,time()+(900),"user_register_2.php");
			        	header("Location: user_register_2.php");
			        }
				    else
				    {
				        echo '<div class="text-white bg-red-500 bg-opacity-50" ><strong>Error!</strong> Form not Submited.</div>';  
				        //die(mysqli_error($con));
				    }

			      /*setcookie("fname",$fname,time()+(900),"user_register_2.php");
					setcookie("lname",$lname,time()+(900),"user_register_2.php");
					setcookie("gender",$gender,time()+(900),"user_register_2.php");
					setcookie("faname",$faname,time()+(900),"user_register_2.php");
					setcookie("mname",$mname,time()+(900),"user_register_2.php");
					setcookie("adds",$adds,time()+(900),"user_register_2.php");
					setcookie("pnum",$pnum,time()+(900),"user_register_2.php");
					setcookie("country",$country,time()+(900),"user_register_2.php");
					setcookie("state",$state,time()+(900),"user_register_2.php");
					setcookie("city",$city,time()+(900),"user_register_2.php");
					setcookie("dob",$dob,time()+(900),"user_register_2.php");
					setcookie("weight",$weight,time()+(900),"user_register_2.php");
					setcookie("email",$email,time()+(900),"user_register_2.php");
			  	14  setcookie("pass",$pass,time()+(900),"user_register_2.php");
					header("Location: user_register_2.php");*/
				}
				else
				{
					$err2= "Password and Comfirm Password do not match";
				}	
			}
			mysqli_close($con);
		}
	}			
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="partials/home.css">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
	<title>User Registration</title>
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
	<script>
		function myFunction() {
		  var x = document.getElementById("cpass");
		  if (x.type === "password") {
		    x.type = "text";
		  } else {
		    x.type = "password";
		  }
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

			$("#email").on('input',function(){
				var email = $("#email").val();
				var emailx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(emailx.test(email))
				{
					$("#emails").text("");
				}
				else
				{
					$("#emails").text("*");
				}
			});

			$("#pass").on('input',function(){
				var pass = $("#pass").val();
				var passx = /^(?=.*[0-9]{1,})(?=.*[a-z]{1,})(?=.*[A-Z]{1,})(?=.*[!@#$%^&*?<>~]{1,})[a-zA-Z0-9~!@#$%^&*?<>]{5,}$/;
				if(passx.test(pass))
				{
					$("#ppass").text("");
					$("#ppasss").text("");
				}
				else
				{
					$("#ppass").text("*");
					$("#ppasss").text("Password includes atleast 1-Uppercase, Lowercase, Numerical and Special character.");
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

					var email = $("#email").val();

					var pass = $("#pass").val();

					var cpass = $("#cpass").val();

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

                    if(email=="")
                    {
                        $("#spemail").text("Email is empty");
                        return false;
                    }
                    else{
                        $("#spemail").text("");                    	
                    }

                    if(pass=="")
                    {
                        $("#sppass").text("Password is empty");
                        return false;
                    }
                    else{
                        $("#sppass").text("");                    	
                    }

                    if(cpass=="")
                    {
                        $("#spcpass").text("conmfirm Password is empty");
                        return false;
                    }
                    else{
                        $("#spcpass").text("");                    	
                    }

                });

		});

	</script>

</head>
<!-- <body class="bg-green-100"> -->
<body class="font-mono" style="background-image: url('images/user_bg.jpg');">

	<!-- Registration Form -->
	<section>
		<!-- Container -->
		<div class="container mx-auto">
			<div class="flex justify-center px-6 my-12">
				<!-- Row -->
					<!-- Col -->
					<div class="w-full lg:w-7/12 bg-blue-300 p-5 rounded-lg lg:rounded-l-none shadow-2xl">
						<h3 class="pt-4 text-2xl ">Patients Details</h3>
						
						<form method="post" id="regform" class="px-8 pt-6 pb-8 mb-4 bg-gray rounded" action="#">
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
										value="<?php if(isset($fname)) echo $fname; ?>"
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
										value="<?php if(isset($lname)) echo $lname; ?>"
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
							      <input type="radio" class="form-radio" name="gender" id="gender" value="male"
							      >
							      <label class="ml-2">Male</label>
							    </label>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" id="gender" name="gender" value="female"
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
										value="<?php if(isset($faname)) echo $faname; ?>"
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
										value="<?php if(isset($mname)) echo $mname; ?>"
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
								><?php if(isset($adds)) echo $adds; ?></textarea>
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
									value="<?php if(isset($pnum)) echo $pnum; ?>"
								/>
								<b><span id="sppnum" style="color: red;"></span></b>
							</div>

<!-- City -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="city">
									Area:&nbsp;<span id="pcity" style="color: red;"></span>
								</label>
								<input
									class="w-max px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="city"
									type="text"
									name="city"
									placeholder="Area"
									value="<?php if(isset($city)) echo $city; ?>"
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
									value="<?php if(isset($dob)) echo $dob; ?>"
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
									value="<?php if(isset($weight)) echo $weight; ?>"
								/>
							</div>


<!-- email -->
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="email">
									Email:&nbsp;<span id="emails" style="color: red;"></span>
								</label>
								<input
									class="w-1/2 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="email"
									type="email"
									name="email"
									placeholder="Email"
									value="<?php if(isset($email)) echo $email; ?>"
								/>
								<br/>
								<b><span style="color: red;"><?php echo $err3; ?></span>
								<b><span id="spemail" style="color: red;"></span></b>
							</div>

<!-- password and confirm password -->
							<div class="mb-4 md:flex">
								<div class="mb-4 md:mr-2 md:mb-0">
									<label class="block mb-2 text-sm font-bold text-gray-700" for="password">
										Password:&nbsp;<span id="ppass" style="color: red;"></span>
									</label>
									<input
										class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border  rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="pass"
										name="pass"
										type="password"
										placeholder="******************"
									/>
									
									<!-- &nbsp;<span id="ppass" style="color: red;"></span> -->
								</div>
								<div class="md:ml-2">
									<label class="block mb-2 text-sm font-bold text-gray-700" for="c_password">
										Confirm Password:
									</label>
									<input
										class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="cpass"
										name="cpass"
										type="password"
										placeholder="******************"
									/>
									<input type="checkbox" onclick="myFunction()">Show Password
								</div>
							</div>
							&nbsp;<b><span id="sppass" style="color: red;"><?php echo $err2; ?></span></b>
							<span id="ppasss" style="color: red;"></span>
							
<!-- next button  and reset button-->							
							<div class="mb-6 ">
							</br>
								<button
									class="w-min px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-green-500 focus:outline-none focus:shadow-outline"
									name="btnnext">
									Next
								</button>
								<button
									class="w-min px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-yellow-500 focus:outline-none focus:shadow-outline"
									name="btnreset"
									onclick="newfunction()"
									>
									Reset
								</button>
							</div>
<!-- login link -->							
							<hr class="mb-6 border-t" />
							<div class="text-center">
								<a
									class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
									href="user_login.php"
								>
									Already have an account? Login!
								</a>
							</div>
						</form>
					</div>
			</div>
			
		</div>
		</section>
		
	</body>
</html>




