<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
    header("Location: index.php");
    exit;
}
$err1=$err2="";
$v1=$v2=
$t="";
$hname="";

include("partials/_db.php");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(isset($_POST["btnschedule"]))
	{
		$t="";
		$hname=$_POST["hname"];
		

		if(!isset($_POST["t"]))
		{
			$err2 = "Select Time"; 
			$v1 = false;
		}
		else{
			$t = $_POST["t"];
			//echo $t;
			$v1 = true;
			
		}

		if($v1!=false)
		{
			$qry = "select p_id from patient_details where email='".$_SESSION['username']."'";
			//print($qry);
			$res = mysqli_query($con,$qry);
			$row = mysqli_fetch_array($res);
			if($res)
			{
				$q = "select dr_name,address from hospital where h_name='".$_POST['hname']."'";
				$r = mysqli_query($con,$q);
				$r1 = mysqli_fetch_array($r);

				$qry1 = "INSERT INTO `appoint` (`a_id`, `h_name`, `atime`, `p_id`) VALUES (NULL, '$hname', '$t', '".$row[0]."')";
				$res1 = mysqli_query($con,$qry1);
				//print($qry1);
				if($res1)
				{
					$to_email = $_SESSION['username'];
	    		$subject = "Appoinment";
	   			$header = "From: e.vaccination.gujarat@gmail.com";
	   			$body = "Your Appoinment is be Scheduled \r\nTime: ".$_POST["t"]."\r\nHospital Name: ".$_POST["hname"]."\r\nDr. Name: ".$r1[0]."\r\nAddress: ".$r1[1].""."\r\n\r\nThank You:-)";
	   			mail($to_email, $subject, $body, $header);
	   			$_SESSION["appoint"]++;
					header("Location: my_schedule.php");
				}
			}
			else{
				$to_email = $_SESSION['username'];
    			$subject = "Appoinment";
   				$header = "From: e.vaccination.gujarat@gmail.com";
   				$body = "Your Appoinment cannot be Scheduled.\r\nTry again After Some Time!\r\n\r\nThank You.";
   				mail($to_email, $subject, $body, $header);
   				$_SESSION["appoint"]=1;
			}
		}

	}
}
?>
<html>


<title>User | Appoinment</title>

  <link rel="stylesheet" type="text/css" href="partials/home.css">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">

 <?php require('partials/_user_navbar.php'); ?>

<body class="font-mono" style="background-image: url('images/user_bg.jpg');">

	<!-- Registration Form -->

		<!-- Container -->
		<div class="container mx-auto">
			<div class="flex justify-center px-6 my-12">
				<!-- Row -->
					<!-- Col -->
					<div class="w-full lg:w-7/12 bg-blue-300 p-5 rounded-lg lg:rounded-l-none shadow-2xl">
						<h3 class="pt-4 text-2xl "><center>Place Appoinment</center></h3><br/><hr>
						
						<form method="post" id="regform" class="px-8 pt-6 pb-8 mb-4 bg-gray rounded">
<!-- Hospital -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700 text-lg" for="bweight">
									Select Hospital:&nbsp;<span id="pbweight" style="color: red;"></span>
								</label>
								<b>Click to select hosptial:<b/>
								<select name="hname" id="hname" style="opacity: 0.5"
								class="w-max px-4 py-3 mb-3  text-gray-700  rounded shadow appearance-none focus:outline-none focus:shadow-outline shadow-lg ml-6">
								    <?php 
								    	$qry2 = "select h_name from hospital";
								    	$res2 = mysqli_query($con,$qry2);
								    	while($row2 = mysqli_fetch_array($res2))
								    	{
								    ?>
								    <option value="<?php echo $row2[0]; ?>"><?php echo $row2[0]; ?></option>
								    <?php  
								    	}
								    ?>
								    
								</select>
								<b><span style="color: red;"><?php echo $err1; ?></span></b>
							</div><hr>

<!-- timing -->
							<div class="mt-4">
							  <label class="block mb-2  text-sm font-bold text-gray-700 text-lg" for="infection">
										Select Timing:
									</label>
							  <div class="mt-2">
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio" name="t" value="2:00 to 3:00 PM"
							      >
							      <label class="ml-2">2:00 to 3:00 PM</label>
							    </label><br/><br/>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" name="t" value="3:00 to 4:00 PM"
							      >
							      <label class="ml-2">3:00 to 4:00 PM</label>
							    </label><br/><br/>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" name="t" value="4:00 to 5:00 PM"
							      >
							      <label class="ml-2">4:00 to 5:00 PM</label>
							    </label>
							  </div>
							  <br/>
							<b><span style="color: red;"><?php echo $err2; ?></span></b>
							</div><hr>																											

							
							<div class="mb-6 ">
							</br>
								<button
									class="w-min px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-green-500 focus:outline-none focus:shadow-outline"
									name="btnschedule">
									Schedule
								</button>
								<button
									class="w-min px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-yellow-500 focus:outline-none focus:shadow-outline"
									name="btncancle"
									>
									<a href="vaccine_table.php" >Cancle</a>
								</button>
							</div>
						</form>
					</div>
			</div>
		</div>
	</body>


</body>
</html>
	