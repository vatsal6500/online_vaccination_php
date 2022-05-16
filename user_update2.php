<?php
//ob_start();
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
	header("Location: index.php");
	exit;
}
include('partials/_db.php');
$qry1 = "SELECT * FROM prevaccination_factor WHERE p_id =".$_GET["p_id"];
$res1 = mysqli_query($con,$qry1);
if(!$res1)
{
	die(mysqli_error($con));
}

$err1=$err2=$err3=$err4=$err5="";
$v1=$v2=$v3=$v4=$v5="";
$infection="";
$como="";
$nutri="";
$maternal="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(isset($_POST["btnupdate"]))
	{
		$infection="";
		$como="";
		$nutri="";
		$maternal="";		

		

		$bweight=$_POST["bweight"];

		if(empty($bweight))
		{
			$err1 = "Birth Weight is Empty"; 
		}
		if(!isset($_POST["infection"]))
		{
			$err2 = "Infection Required"; 
		}
		else{
			$infection = $_POST["infection"];
		}

		if(!isset($_POST["como"]))
		{
			$err3 = "Comorbidity Required"; 
		}
		else{
			$como = $_POST["como"];	
		}

		if(!isset($_POST["nutri"]))
		{
			$err4 = "Nutritional Required"; 
		}
		else{
			$nutri = $_POST["nutri"];
		}

		if(!isset($_POST["maternal"]))
		{
			$err5 = "Maternal Antibodies Required";			
		}
		else{
			$maternal = $_POST["maternal"];
		}
		
		$uqry = "UPDATE `prevaccination_factor` SET `birth_weight` = '$bweight', `infection` = '$infection', `comorbidity` = '$como', `neutritional_status` = '$nutri', `maternal_antibodies` = '$maternal' WHERE `prevaccination_factor`.`p_id` = ".$_GET["p_id"];
		$ures = mysqli_query($con,$uqry)or die(mysqli_error($con)) ;
		if($ures)
		{
			//mysqli_error($con);
			header("Location: user_profile.php");
		}
		
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>User | Update</title>

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
<body class="font-mono" style="background-image: url('images/user_bg.jpg');">

	<?php include_once('partials/_user_navbar.php');?>

		<div class="container mx-auto">
			<div class="flex justify-center px-6 my-12">
				<!-- Row -->
					<!-- Col -->
					<div class="w-full lg:w-7/12 bg-blue-300 p-5 rounded-lg lg:rounded-l-none shadow-2xl">
						<h3 class="pt-4 text-2xl ">Update PreVaccination Factors!</h3>
						
						<form method="post" id="regform" class="px-8 pt-6 pb-8 mb-4 bg-gray rounded" >
<!-- Weight -->
							<?php
							while($row1=mysqli_fetch_array($res1))
							{
							?>

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
									value="<?php echo $row1[1]; ?>"
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
							      <?php if($row1[2]=="yes") echo "checked"; ?>>
							      <label class="ml-2">Yes</label>
							    </label>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" name="infection" 
							      value="no" <?php if($row1[2]=="no") echo "checked"; ?> >
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
							     <?php if($row1[3]=="yes") echo "checked"; ?>
							      >
							      <label class="ml-2">Yes</label>
							    </label>
							    <label class="inline-flex items-center ml-6 text-lg">
							      <input type="radio" class="form-radio text-green-500" name="como" value="no"<?php if($row1[3]=="no") echo "checked"; ?>>
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
							     <?php if($row1[4]=="good") echo "checked"; ?> >
							      <label class="ml-2">Good</label>
							    </label>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" name="nutri" value="poor" <?php if($row1[4]=="poor") echo "checked"; ?>
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
							      <?php if($row1[5]=="yes") echo "checked"; ?>
							      >
							      <label class="ml-2">Yes</label>
							    </label>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" name="maternal" value="no" <?php if($row1[5]=="no") echo "checked"; ?>
							     >
							      <label class="ml-2">No</label>
							    </label>
							  </div>
							  <font style="color:royalblue;">* Antibodies are being metabolized and do not protect any longer</font>
							  <br/>
							  <b><span style="color: red;"><?php echo $err5; ?></span></b>

							</div><hr>

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
</body>
</html>