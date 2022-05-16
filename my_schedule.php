<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
    header("Location: index.php");
    exit;
}

include("partials/_db.php");

?>


<!DOCTYPE html>
<html>
<head>
	<title>User | Schedule</title>
	 <link rel="stylesheet" type="text/css" href="partials/home.css">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
</head>
<body>

<?php require('partials/_user_navbar.php'); ?>

<div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-blue-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Hospital Name</th>
                                <th class="py-3 px-6 text-left">Time</th>
                                <th class="py-3 px-6 text-left">Dr. Name</th>
                                <th class="py-3 px-6 text-left">Address</th>
                            </tr>
                        </thead>
                        <?php  

                        	

                        	$qry = "SELECT a.h_name,a.atime from appoint as a,patient_details as p where a.p_id=p.p_id and p.email='".$_SESSION['username']."'";
                        	$res = mysqli_query($con,$qry);
                        	if($res)
                        	{
	                        	while($row=mysqli_fetch_array($res))
	                        	{
	                        ?>
		                        <tbody class="text-gray-600 text-sm font-light">
		                            <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
		                                <td class="py-3 px-6 text-left">
		                                    <div class="flex items-center">
		                                        <span class="font-medium"><?php echo $row[0]; ?></span>
		                                    </div>
		                                </td>
		                                <td class="py-3 px-6 text-left">
		                                    <div class="flex items-center">
		                                        <div class="mr-2"><?php echo $row[1]; ?></div>
		                                    </div>
		                                </td>
		                                <?php
		                                	$q = "select dr_name,address from hospital where h_name ='".$row[0]."'";
		                                	$r = mysqli_query($con,$q);
		                                	if($res)
		                                	{
		                                		while($r1 = mysqli_fetch_array($r))
		                                		{
		                                ?>
		                                <td class="py-3 px-6 text-left">
		                                    <div class="flex items-center">
		                                        <div class="mr-2"><?php echo $r1[0]; ?></div>
		                                    </div>
		                                </td>
		                                <td class="py-3 px-6 text-left">
		                                    <div class="flex items-center">
		                                        <div class="mr-2"><?php echo $r1[1]; ?></div>
		                                    </div>
		                                </td>
		                                <?php 
		                            			}
		                            		}
		                                ?>
		                            </tr>
		                        </tbody>
	                        <?php  
	                        	}
	                        }
	                        else
	                        {
	                        ?>
	                        	<tbody class="text-gray-600 text-sm font-light">
		                            <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
		                                <td class="py-3 px-6 text-left">
		                                    <div class="flex items-center">
		                                        <span class="font-medium">No Appoinment Found!!</span>
		                                    </div>
		                                </td>
		                                <td class="py-3 px-6 text-left">
		                                    <div class="flex items-center">
		                                        <div class="mr-2"></div>
		                                    </div>
		                                </td>
		                            </tr>
		                        </tbody>
	                        <?php	
	                        }
	                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php require('partials/_footer.php'); ?>


</body>
</html>