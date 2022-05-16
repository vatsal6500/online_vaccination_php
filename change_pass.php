<?php

session_start();

if(!isset($_SESSION['email']))
{
	header("Location: user_login.php");
	exit;
}
else
{
	if(isset($_SESSION['changed']) && $_SESSION['changed']==1)
	{	
		$to_email = $_SESSION['email'];
		$subject = "Passcode";
		$header = "From: e.vaccination.gujarat.gmail.com";
		$body = "This is your new temporary passcode: ".$_SESSION['passcode'];
		mail($to_email, $subject, $body, $header);
		$_SESSION['changed']++;
	}
}

$err2="";
$err3="";
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="partials/home.css">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
	<title>Change Password</title>
	<script type="text/javascript" src="jquery.js"></script>
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

			$("#passcode").on('input',function(){
				var pass = $("#passcode").val();
				var passx = /^[0-9]{7}$/;
				if(passx.test(pass))
				{
					$("#passcodex").text("");
				}
				else
				{
					$("#passcodex").text("*");
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
				var pass = $("#pass").val();
				var cpass = $("#cpass").val();
				var passcode = $("#passcode").val();

				if(passcode=="")
				{
					$("#passx").text("Passcode is empty");
					return false;
				}
				else
				{
					$("#passx").text("");
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
<body class="" style="background-image: url('images/user_bg.jpg');">
	<!-- navbar -->
	<?php require('partials/_navbar.php'); ?>

	<!-- Login Form -->


	<?php

			/*database include*/
			include('partials/_db.php');

		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			if(isset($_POST["btnsubmit"]))
			{
				include('partials/_db.php');
				$passcode = $_POST["passcode"];
				$npass = $_POST["pass"];
				$cnpass = $_POST["cpass"];
				if(($_SESSION['passcode']==$passcode) && ($npass==$cnpass))
				{
					$qry = "UPDATE `patient_details` SET `pass` = '$npass' WHERE `patient_details`.`email` =  '" . $_SESSION['email'] . "'";
					$res = mysqli_query($con,$qry);
					if($res)
			        {
			        	header("Location: user_login.php");
			        }
			        else
			        {
			        	die(mysqli_error($con));
			        }
				}
				else
				{
					$err3="passcode or password and confirm password do not match!";
				}
			}
		}			
	?>


	<section>
		<div class="h-screen font-sans login bg-cover">
		<div class="container mx-auto h-full flex flex-1 justify-center items-center">
		    <div class="w-full max-w-lg">
		      <div class="leading-loose">
		        <form id="loginform" method="post" class="max-w-sm m-4 p-10 bg-white bg-opacity-50 rounded shadow-xl">
		            <p class="text-black font-medium text-center text-lg font-bold">New Password</p>
		              <div class="">
		                <label class="block text-sm text-black" for="email">Passcode: &nbsp;&nbsp;<span id="passcodex" style="color: red;"></span></label>
		                <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white" type="text" id="passcode"  placeholder="Enter 7-digit Passcode from Email" aria-label="passcode" name="passcode">
		                &nbsp;<b><span id="passx" style="color: red;"></span></b>
		              </div>
		              <div class="mt-2">
		                <label class="block  text-sm text-black">New Password:&nbsp;&nbsp;<span id="ppass" style="color: red;"></span><br/></label>
		                 <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white"
		                  type="password" id="pass" placeholder="*******************" arial-label="password" name="pass" >
		                  &nbsp;<b><span id="sppass" style="color: red;"></span></b>
		              </div>
		              <div class="mt-2">
		                <label class="block  text-sm text-black">New Confirm Password:&nbsp;&nbsp;<span id="passs" style="color: red"></span><br/></label>
		                 <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white"
		                  type="password" id="cpass" placeholder="*******************" arial-label="password" name="cpass" >
		                  <input type="checkbox" onclick="myFunction()">Show Password
		              </div>
		              &nbsp;<b><span id="spcpass" style="color: red;"><?php echo $err2; ?></span></b>
							
		              <div class="mt-4 items-center flex justify-between">
		                <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-500 hover:bg-green-900 rounded" name="btnsubmit" 
		                  type="submit">Submit</button>
		              </div>
		              <div class="text-center">
		                <a class="inline-block right-0 align-baseline font-light text-sm text-500 hover:text-green-700" href="user_register.php">
		                    Create an account?
		                </a>
		              </div>
		              <br/><span id="ppasss" style="color: red;"><br/>
		              	<span><?php echo $err3; ?></span>
		        </form>

		      </div>
		    </div>
		  </div>
		</div>
	</section>	

	<!-- Footer -->
	<?php require('partials/_footer.php'); ?> 
</body>
</html>