<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="partials/home.css">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
	<title>User Login</title>
	<script type="text/javascript" src="jquery.js"></script>
	<script>
		function myFunction() {
		  var x = document.getElementById("pass");
		  if (x.type === "password") {
		    x.type = "text";
		  } else {
		    x.type = "password";
		  }
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#email").on('input',function(){
				var email = $("#email").val();
				var emailx = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
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
					$("#passs").text("");
				}
				else
				{
					$("#passs").text("*");
					/*$("#passss").text("Password includes atleast 1-Uppercase,Lowercase,numerical and Special character.");*/
				}
			});

			$("form").submit(function(){
				var email = $("#email").val();

				if(email=="")
                {
                    $("#xemails").text("Email Required!");
                    return false;
                }
                else{
                    $("#xemails").text("");                    	
                }
            });

		});

		
	</script>
</head>
<body class="" style="background-image: url('images/index.png'); background-size: contain;">
	<!-- navbar -->
	<?php require('partials/_navbar.php'); ?>

	<!-- Login Form -->


	<?php
			$msg="";
			$err3="";
			/*database include*/
			include('partials/_db.php');

		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			
			$email = $_POST['email'];
			$pass = $_POST['pass'];

			$existsql = "select email from patient_details where email = '$email'";
			$result = mysqli_query($con,$existsql);
			$numexistrows = mysqli_num_rows($result);
			if($numexistrows > 0)
			{ 
				if(empty($email) && empty($pass))
				{
			        echo '<div class="text-white bg-red-500 bg-opacity-50" ><strong>Error!</strong> Email required.</div>';
					echo '<div class="text-white bg-red-500 bg-opacity-50" ><strong>Error!</strong> Password Required. </div>';
				}
				else{
					$qry ="call userlogin('$email','$pass')";
					$res = mysqli_query($con,$qry);	

					if(mysqli_num_rows($res)==1)
					{
						session_start();
						$_SESSION['logged'] = null;
						$_SESSION['appoint'] = null;
						if($_SESSION['logged']==null)
						{
							$_SESSION['logged'] = 1;
						}
						if($_SESSION['appoint']==null)
						{
							$_SESSION['appoint'] = 1;
						}
						$_SESSION['loggedin'] = true;
						$_SESSION['username'] = $email;
						header("Location: user_welcome.php");
					}
					else if(empty($email) && empty($pass))
					{
						
						echo '<div class="text-white bg-red-500 bg-opacity-50" ><strong>Error!</strong> Invalid Cerdentials. </div>';
					}
					else if((!empty($email) && empty($pass)) || (!empty($email) && mysqli_num_rows($res)==0))
					{
						session_start();
						$_SESSION['changed'] = null;
						if($_SESSION['changed']==null)
						{
							$_SESSION['changed'] = 1;
						}
						$passcode = rand(999999,9999999);
						$_SESSION['passcode'] = $passcode;
						$_SESSION['email'] = $email;
						$msg ='<a class="inline-block right-0 align-baseline font-light text-sm text-500 hover:text-yellow-400" href="change_pass.php">
			                  Forget Password?</a>';
						echo '<div class="text-white bg-red-500 bg-opacity-50" ><strong>Error!</strong> Invalid Cerdentials. </div>';
					}
				}
			
			}
			elseif(!empty($email))
			{
				$err3 = "Email ID do not exist. Create Account";
			}
	
		}			
	?>


	<section>
		<div class="h-screen font-sans login bg-cover">
		<div class="container mx-auto h-full flex flex-1 justify-center items-center">
		    <div class="w-full max-w-lg">
		      <div class="leading-loose">
		        <form id="loginform" method="post" class="max-w-sm m-4 p-10 bg-white bg-opacity-50 rounded shadow-xl">
		            <p class="text-black font-medium text-center text-lg font-bold">LOGIN</p>
		              <div class="">
		                <label class="block text-sm text-black" for="email">E-mail &nbsp;&nbsp;<span id="emails" style="color: red;"></span></label>
		                <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white" type="email" id="email"  placeholder="Enter Email" aria-label="email" name="email"
		                value="<?php if(isset($email)) echo $email; ?>">
		                &nbsp;&nbsp;<span id="xemails" style="color: red;"><?php echo $err3; ?></span>
		              </div>
		              <div class="mt-2">
		                <label class="block  text-sm text-black">Password:&nbsp;&nbsp;<span id="passs" style="color: red"></span><br/></label>
		                 <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white"
		                  type="password" id="pass" placeholder="Enter Password" arial-label="password" name="pass" >
		                  <input type="checkbox" onclick="myFunction()">Show Password
		                  &nbsp;&nbsp;<span id="xpasss" style="color: red"></span>
		                  		                  
		              </div>
		              <div class="mt-4 items-center flex justify-between">
		                <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 hover:bg-gray-800 rounded"
		                  type="submit">Login</button>
		              </div>
		              <center><?php echo $msg; ?></center>
		              <div class="text-center">
		                <a class="inline-block right-0 align-baseline font-light text-sm text-500 hover:text-yellow-400" href="user_register.php">
		                    Create an account?
		                </a>
		              </div>
		              <div class="text-center">
		                <a class="inline-block right-0 align-baseline font-light text-sm text-500 hover:text-yellow-400" href="Admin/index.php">
		                    Admin?
		                </a>
		              </div>

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