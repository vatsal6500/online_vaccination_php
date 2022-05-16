<?php 

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
	header("Location: index.php");
	exit;
}

include("partials/_db.php");

$qry1 = "SELECT * FROM patient_details WHERE email = '" . $_SESSION['username'] . "'";
$res1 = mysqli_query($con,$qry1);
if(!$res1)
{
	die(mysqli_error($con));
}

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
							</label>
							<div class="mt-2">
								&nbsp;&nbsp;
							    <label class="inline-flex items-center">
							      <input type="radio" class="form-radio" name="gender" id="gender" value="male" <?php if($row1[13]=='male') echo "checked"; ?> disabled>
							      <label class="ml-2">Male</label>
							    </label>
							    <label class="inline-flex items-center ml-6">
							      <input type="radio" class="form-radio text-green-500" id="gender" name="gender" value="female" <?php if($row1[13]=='female') echo "checked"; ?>
							     disabled>
							      <label class="ml-2">Female</label>
							    </label>
							  </div>
							</div>
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

<!-- Country -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="country">
									Country:&nbsp;<span id="pcountry" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
									class="w-max px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="country"
									type="text"
									name="country"
									placeholder="Country"
									disabled
									value="<?php echo $row1[9]; ?>"
								/>
							</div>

<!-- State -->

							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="state">
									State:&nbsp;<span id="pstate" style="color: red;"></span>
								</label>&nbsp;&nbsp;
								<input
									class="w-max px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="state"
									type="text"
									name="state"
									placeholder="State"
									disabled
									value="<?php echo $row1[10]; ?>"
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
									value="<?php echo $row1[11]; ?>"
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
									value="<?php echo $row1[12]; ?>"
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
									value="<?php echo $row1[14]; ?>"
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
									class="w-max px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-green-500 focus:outline-none focus:shadow-outline"
									name="btnnext">
									Click to Update
								</button>
							</div>
							<hr>
						<?php } ?>