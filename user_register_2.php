<?php 

	$fname=$_COOKIE["fname"];
	$lname=$_COOKIE["lname"];
	$email=$_COOKIE["email"];

	/*echo $fname."</br>";
	echo $lname."</br>";
	echo $email."</br>";*/


$err1=$err2=$err3=$err4=$err5="";
$v1=$v2=$v3=$v4=$v5="";
$infection="";
$como="";
$nutri="";
$maternal="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(isset($_POST["btnsubmit"]))
	{
		$infection="";
		$como="";
		$nutri="";
		$maternal="";

		include('partials/_db.php');

		$bweight=$_POST["bweight"];

		if(empty($bweight))
		{
			$err1 = "Birth Weight is Empty";
			$v1 = false; 
		}
		else
		{
			$v1 = true; 
		}

		if(!isset($_POST["infection"]))
		{
			$err2 = "Infection Required"; 
			$v2 = false;
		}
		else{
			$infection = $_POST["infection"];
			$v2 = true;
			
		}

		if(!isset($_POST["como"]))
		{
			$err3 = "Comorbidity Required"; 
			$v3 = false;
		}
		else{
			$como = $_POST["como"];
			$v3 = true;
			
		}

		if(!isset($_POST["nutri"]))
		{
			$err4 = "Nutritional Required"; 
			$v4 = false;
		}
		else{
			$nutri = $_POST["nutri"];
			$v4 = true;
			
		}

		if(!isset($_POST["maternal"]))
		{
			$err5 = "Maternal Antibodies Required";
			$v5 = false;
		}
		else{
			$maternal = $_POST["maternal"];
			$v5 = true;
			 
		}

		if($v1!=false && $v2!=false && $v3!=false && $v4!=false && $v5!=false)
		{
			$qry = "select p_id from patient_details where email='".$email."'";
			//print($qry);
			$res = mysqli_query($con,$qry);
			$row = mysqli_fetch_array($res);
			//echo $row[0];
			if($res)
			{
				$qry1="INSERT INTO `prevaccination_factor` (`pf_id`, `birth_weight`, `infection`, `comorbidity`, `neutritional_status`, `maternal_antibodies`, `p_id`) VALUES (NULL, '$bweight', '$infection', '$como', '$nutri', '$maternal', '".$row[0]."')";
				$res1 = mysqli_query($con,$qry1);
				//print($qry1);
				if($res1)
				{
					//echo '<div class="text-white bg-green-500 bg-opacity-50" ><strong style="color:green">Success! </strong>'.$fname.'&nbsp;'.$lname.' Your Form is submited successfully. Now you can Login.</div>';
					header("Location: user_login.php");
				}
				else
				{
					$dqry = "call deletepatient('".$row[0]."')";
					$dres = mysqli_query($con,$dqry);
					if(!$dres)
					{
						//die(mysqli_error($con));
					}
					echo '<div class="text-white bg-red-500 bg-opacity-50" ><strong>Error!</strong> Form not Submited!!</div>';
					//header("Location: user_register.php");
					//die(mysqli_error($con));
				}
				
			}
			else{
				echo '<div class="text-white bg-red-500 bg-opacity-50" ><strong>Error!</strong>Form Not Submitted!!</div>';
				//die(mysqli_error($con));
			}

		}
	}
}


?>

<!-- navbar -->
<?php require('partials/_navbar.php');?>

<!DOCTYPE html>
<html>
<head>
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
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>  
	<script type="text/javascript" src="jquery.js"></script>

	<!-- reset data -->
	<script type="text/javascript">
		function newfunction(){
			document.getElementById("regform").reset();
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#bweight").on('input',function(){
				var adds = $("#bweight").val();
				var addsx = /^[0-9]{1,2}$/;
				if(addsx.test(adds))
				{
					$("#pbweight").text("");
				}
				else
				{
					$("#pbweight").text("*");
				}
			});
		});

	</script>

</head>
<!-- <body class="bg-green-100"> -->
<body class="font-mono" style="background-image: url('images/user_bg.jpg');">

	<!-- Registration Form -->

		<!-- Container -->
		<div class="container mx-auto">
			<div class="flex justify-center px-6 my-12">
				<!-- Row -->
					<!-- Col -->
					<div class="w-full lg:w-7/12 bg-blue-300 p-5 rounded-lg lg:rounded-l-none shadow-2xl">
						<h3 class="pt-4 text-2xl ">PreVaccination Factors!</h3>
						
						<form method="post" id="regform" class="px-8 pt-6 pb-8 mb-4 bg-gray rounded">
<!-- Weight -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700 text-lg" for="bweight">
									Birth Weight:&nbsp;<span id="pbweight" style="color: red;"></span>
								</label>
								<input
									class="w-20  px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="bweight"
									type="text"
									name="bweight"
									placeholder="Weight"
									value="<?php if(isset($bweight)) echo $bweight; ?>"
								/>
								<b><span style="color: red;"><?php echo $err1; ?></span></b>
							</div><hr>

<!-- infection -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700 text-lg" for="infection">
										Infection:
									</label>
							  <div class="mt-2">
							    <label class="inline-flex items-center">
							      <input type="radio" class="form-radio" name="infection" value="yes"
							      >
							      <label class="ml-2">Yes</label>
							    </label>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" name="infection" value="no"
							      >
							      <label class="ml-2">No</label>
							    </label>
							  </div>
							  <br/>
							<b><span style="color: red;"><?php echo $err2; ?></span></b>
							</div><hr>

<!-- comorbidity -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700 text-lg" for="como">
										Comorbidity:
									</label>
							  <div class="mt-2">
							    <label class="inline-flex items-center text-lg">
							      <input type="radio" class="form-radio" name="como" value="yes"
							     
							      >
							      <label class="ml-2">Yes</label>
							    </label>
							    <label class="inline-flex items-center ml-6 text-lg">
							      <input type="radio" class="form-radio text-green-500" name="como" value="no">
							      <label class="ml-2">No</label>
							    </label>
							  </div>
							  <font style="color:royalblue;">* the simultaneous presence of two or more diseases or medical conditions in a Child.</font>
							  <br/>
							  <b><span style="color: red;"><?php echo $err3; ?></span></b>

							</div>	<hr>

<!-- Nutritional Status -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700 text-lg" for="nutri">
										Nutritional Status:
									</label>
							  <div class="mt-2">
							    <label class="inline-flex items-center">
							      <input type="radio" class="form-radio" name="nutri" value="good"
							      >
							      <label class="ml-2">Good</label>
							    </label>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" name="nutri" value="poor" 
							      >
							      <label class="ml-2">Poor</label>
							    </label>
							  </div>
							  <b><span style="color: red;"><?php echo $err4; ?></span></b>

							  <br/>
							</div><hr>

<!-- Maternal Antibodies -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700 text-lg" for="maternal">
										Maternal Antibodies:
									</label>
							  <div class="mt-2">
							    <label class="inline-flex items-center">
							      <input type="radio" class="form-radio" name="maternal" value="yes"
							      
							      >
							      <label class="ml-2">Yes</label>
							    </label>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" name="maternal" value="no" 
							     >
							      <label class="ml-2">No</label>
							    </label>
							  </div>
							  <font style="color:royalblue;">* Antibodies are being metabolized and do not protect any longer</font>
							  <br/>
							  <b><span style="color: red;"><?php echo $err5; ?></span></b>

							</div><hr>																											

<!-- submit button and reset button -->							
							<div class="mb-6 ">
							</br>
								<button
									class="w-min px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-green-500 focus:outline-none focus:shadow-outline"
									name="btnsubmit"
									id="btnsubmit">
									Submit
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
	</body>

	

</body>
</html>

