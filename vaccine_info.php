<?php
include("partials/_db.php");
$qry= "select v_id,v_name,when_to_give,dose_no,doze_amt,route,site from vaccination_details";

$res= mysqli_query($con,$qry)or die(mysqli_error($con));


if(mysqli_num_rows($res)==0)
{
  echo "no rows found";
}

?>

<!--<body style="background-color:rgba(255, 99, 71, 0.5);">-->
 
<body style="background-image:linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.6)), url(images/vac21.jpg); background-size:cover;">

<!--255, 99, 71, 0.5-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>


  <div class=" col-lg-12">
    <div class="box">
  
  <div class="box-header with-border">
  <div class="card-body">
  
    <div class="box-header with-border">
              <h3 class="box-title"><center>VACCINE-DETAILS</center></h3>
            </div>
  </div>
</div>

<table class="table table-success table-hover  table-bordered" border="5">
  <tr>
  
   <th><h1>No</h1></th>
  <th><h1>Vaccine Name</h1></th>
  <th><h1>When to give</h1></th>
  <th><h1>Number of doze</h1></th>
    <th><h1>Doze Amount</h1></th>
    <th><h1>Route</h1></th>
    <th><h1>Site</h1></th>
    
   
</tr>
  
<?php
  while($row=mysqli_fetch_array($res))
  {
  ?>

  <tr>
    
    <td><b><?php echo $row[0]?></b></td>
    <td><b><?php echo $row[1]?></b></td>
    <td><b><?php echo $row[2]?></b></td>
    <td><b><?php echo $row[3]?></b></td>
    <td><b><?php echo $row[4]?></b></td>
    <td><b><?php echo $row[5]?></b></td>
    <td><b><?php echo $row[6]?></b></td>
  </tr>

 
   <?php
   }

   mysqli_close($con);
?>

   </table>
 </div>
</div>

  
  <center><button class="btn btn-info badge-pill"><a href="user_welcome.php">Back</a></button></center>

</body>


