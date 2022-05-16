<?php

$qry = "SELECT f_name,l_name,dob,email FROM patient_details WHERE email = '" . $_SESSION['username'] . "'";
$res = mysqli_query($con,$qry); 
if(!$res)
{
    die(mysqli_error($con));
}
$row = mysqli_fetch_array($res);

?>

<!-- <header class="text-white body-font bg-grey-600 sticky top-0" style="background-image:linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.2)), url(images/vac12.jpg); background-size: auto;"> -->
	<header class="text-white body-font bg-grey-600 sticky top-0" style="background-image:linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.2)), url(images/vac12.jpg); background-size: auto;">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <!-- <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0"
    href="index.php">
      <span class="ml-3 text-xl">Vaccination</span>
    </a> -->
         <img class="object-cover object-center rounded" alt="hero" src="images/logo2.jpg" height="100px" width="100px">
         <span class="ml-3 text-xl"><b style="text-transform: uppercase;font-size: 25px"><?php echo $row[0]."&nbsp;".$row[1]; ?></b><br><i class="fa fa-circle text-success"></i> </span>
	    <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center">
	      <a class="mr-5 hover:text-gray-900" href="user_welcome.php">Home</a>
	      <a class="mr-5 hover:text-gray-900" href="vaccine_table.php">My Schedule</a>
	      <a class="mr-5 hover:text-gray-900" href="vaccine_info.php">Vaccine Details</a>
	      <a class="mr-5 hover:text-gray-900" href="user_profile.php">Profile</a>
	      <a class="mr-5 hover:text-gray-900" href="my_schedule.php">Conformation</a>
	      <!-- <a class="mr-5 hover:text-gray-900" href="blog.php">Blogs</a> -->
<!-- 	      <li class="dropdown">
	        <a href="javascript:void(0)" class=" mr-5 hover:text-gray-900 dropbtn">About us</a>
	        <div class="dropdown-content">
	          <a href="#">What we do</a>
	          <a href="#">What we are</a>
	          <a href="#">Where we work</a>
	        </div>
	      </li>
 -->	    </nav>
	      <form method="post">
	      <button class="inline-flex items-center bg-black-100 border-0 py-1 px-3 focus:outline-none hover:bg-red-400 rounded text-base mt-4 md:mt-0" name="btnlogout"><a href="user_logout.php">Logout</a>
	      </button>
	    </form>
	  </div>
	</header>	