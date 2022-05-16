<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
    header("Location: index.php");
    exit;
}



include("partials/_db.php");

$qry = "SELECT f_name,l_name,dob,email FROM patient_details WHERE email = '" . $_SESSION['username'] . "'";
$res = mysqli_query($con,$qry); 
if(!$res)
{
    die(mysqli_error($con));
}
$row = mysqli_fetch_array($res);

$date = $row[2];
//$fdate = date_format(new DateTime($date),"m/d/Y");
//echo $date."</br>";
//echo $fdate;

$today_date = date('Y-m-d' ,strtotime('+ 0 years'.'+ 0 months'.'+ 0 days'));
$err = "";

$button = '<center><button class="btn btn-dark badge-pill"><a href="appoint.php">Appoint</a></button></center>';

$BCG_d1 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 0 months'.'+ 0 days'));

$OPV_d1 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 2 months'.'+ 0 days'));
$OPV_d2 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 4 months'.'+ 0 days'));
$OPV_d3 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 6 months'.'+ 0 days'));

$HPB_d1 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 0 months'.'+ 0 days'));
$HPB_d2 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 2 months'.'+ 0 days'));
$HPB_d3 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 6 months'.'+ 0 days'));
$HPB_d4 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 12 months'.'+ 0 days'));
$HPB_d5 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 18 months'.'+ 0 days'));

$DTP_d1 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 2 months'.'+ 0 days'));
$DTP_d2 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 4 months'.'+ 0 days'));
$DTP_d3 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 6 months'.'+ 0 days'));
$DTP_d4 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 18 months'.'+ 0 days'));
$DTP_d5 = date('Y-m-d', strtotime($date.'+ 5 years'.'+ 0 months'.'+ 0 days'));

$HIB_d1 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 2 months'.'+ 0 days'));
$HIB_d2 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 4 months'.'+ 0 days'));
$HIB_d3 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 6 months'.'+ 0 days'));
$HIB_d4 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 8 months'.'+ 0 days'));

$ROTA_d1 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 2 months'.'+ 0 days'));
$ROTA_d2 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 4 months'.'+ 0 days'));
$ROTA_d3 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 6 months'.'+ 0 days'));

$MMR_d1 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 12 months'.'+ 0 days'));
$MMR_d2 = date('Y-m-d', strtotime($date.'+ 5 years'.'+ 0 months'.'+ 0 days'));

$VARICELLA_d1 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 12 months'.'+ 0 days'));
$VARICELLA_d2 = date('Y-m-d', strtotime($date.'+ 5 years'.'+ 0 months'.'+ 0 days'));

$HPA_d1 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 12 months'.'+ 0 days'));
$HPA_d2 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 18 months'.'+ 0 days'));

$PCV_d1 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 2 months'.'+ 0 days'));
$PCV_d2 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 4 months'.'+ 0 days'));
$PCV_d3 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 6 months'.'+ 0 days'));
$PCV_d4 = date('Y-m-d', strtotime($date.'+ 0 years'.'+ 18 months'.'+ 0 days'));


if(isset($_SESSION['logged']) && $_SESSION['logged']==1)
{
    $to_email = $row[3];
    $subject = "Vaccine Reminder:";
    $header = "From: e.vaccination.gujarat@gmail.com";
    $end = "\r\n \r\n If you have already taken a vaccine then ignore the Message.\r\n Thank you.";
    $start = "The vaccinaion for " . $row[0] ." ". $row[1] ." is scheduled for Today(".$today_date.")\r\n \r\n";
    $l = "http://localhost:8181/vaccine/index.php";
    $link = "\r\n \r\n Visit Vaccination Site for more information:".$l." \r\n";   
    //echo $start;
    //echo $to_email;

    if($HPB_d1 == $today_date)
    {
        $body = $start . "Bacillus Calmette Guerin(doze-1)\r\nHepatitis-B vaccine (Doze-1)" . $link . $end;
        mail($to_email, $subject, $body, $header);
    }

    if($OPV_d1 == $today_date)
    {
        $body = $start . "Oral Polio Vaccine(doze-1)\r\nHepatitis-B Vaccine(doze-2)\r\nDTaP/DTP(doze-1)\r\nHaemophilus Influenzae B Vaccine(doze-1)\r\nRotonaVirus Vaccine(doze-1)\r\nPneumococcal Conjugaye Vaccine(doze-1)" . $end;
        mail($to_email, $subject, $body, $header);
    }

    if($OPV_d2 == $today_date)
    {
        $body = $start . "Oral Polio Vaccine(doze-2)\r\nDTaP/DTP(doze-2)\r\nHaemophilus Influenzae B Vaccine(doze-2)\r\nRotonaVirus Vaccine(doze-2)\r\nPneumococcal Conjugaye Vaccine(doze-2)" . $link . $end;
        mail($to_email, $subject, $body, $header);
    }

    if($OPV_d3 == $today_date)
    {
        $body = $start . "Oral Polio Vaccine(doze-3)\r\nHepatitis-B Vaccine(doze-3)\r\nDTaP/DTP(doze-3)\r\nHaemophilus Influenzae B Vaccine(doze-3)\r\nRotonaVirus Vaccine(doze-3)\r\nPneumococcal Conjugaye Vaccine(doze-3)" . $link . $end;
        mail($to_email, $subject, $body, $header);
    }

    if($HIB_d4 == $today_date)
    {
        $body = $start . "Haemophilus Influenzae B Vaccine(Doze-4)" . $link . $end;
        mail($to_email, $subject, $body, $header);
    }

    if($HPB_d4 == $today_date)
    {
        $body = $start . "Hepatitis-B Vaccine(doze-4)\r\nMeasles Mumps Rubella Vaccine(doze-1)\r\nVaricella Vaccine(doze-1)\r\nHepatitis-A Vaccine(doze-1)" . $link . $end;
        mail($to_email, $subject, $body, $header);
    }

    if($HPB_d5 == $today_date)
    {
        $body = $start . "Hepatitis-B Vaccine(doze-5)\r\nDTaP/DTP(doze-4)\r\nPneumococcal Conjugaye Vaccine(doze-4)\r\nHepatitis-A Vaccine(doze-1)" . $link . $end;
        mail($to_email, $subject, $body, $header);
    }

    if($DTP_d5 == $today_date)
    {
        $body = $start . "DTaP/DTP(doze-5)\r\nMeasles Mumps Rubella Vaccine(doze-2)\r\nVaricella Vaccine(doze-2)" . $link . $end;
        mail($to_email, $subject, $body, $header);
    }
    $_SESSION['logged']++;
   // echo $_SESSION['logged'];
}

?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="partials/home.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    <title>Vaccine Dates</title>
</head>
 <header style="background-image: url('images/vac011.jpg');">
<body>
   <?php require('partials/_user_navbar.php');?>
              <div class=" col-lg-12">
               <div class="box">
  
               <div class="box-header with-border">
                  <div class="card-body">
  
                      <div class="box-header with-border">
               <h3 class="box-title"></h3>
                   </div>
                </div>
                  </div>
                          <center><table class="table table-info" style="width: 1400px"></center>

                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left" style="font-size: 20px"><b>Vaccination Name</b></th>
                                <th class="py-3 px-6 text-center" style="font-size: 20px"><b>Doze-1</b></th>
                                <th class="py-3 px-6 text-center" style="font-size: 20px"><b>Doze-2</b></th>
                                <th class="py-3 px-6 text-center" style="font-size: 20px"><b>Doze-3</b></th>
                                <th class="py-3 px-6 text-center" style="font-size: 20px"><b>Doze-4</b></th>
                                <th class="py-3 px-6 text-center" style="font-size: 20px"><b>Doze-5</b></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium" style="font-size: 18px"><b>Bacillus calmette-guerin (BCG)</b></span>
                                    </div>
                                </td>
                               <!-- <td class="py-3 px-6 text-left">
                                    <div class="flex items-center justify-center">
                                        <span style="color:red;"><b><?php echo $BCG_d1; ?></b></span>
                                    </div>
                                </td>
                                
                                <td class="py-3 px-6 text-center">-->

                                <?php if($BCG_d1<$today_date)
                                { ?>    
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-success badge-pill"><a href="" ></a><?php echo $BCG_d1; ?></button>

                               
                            </td>
                            <?php 
                           }
                           elseif($BCG_d1==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $BCG_d1; ?></button>

                               
                            </td> <?php
                           }
                          else
                            { ?>
                               <td class="py-3 px-6 text-center">
                                <button class="btn btn-danger badge-pill"  onclick="myFunction();"><a href=""></a><?php echo $BCG_d1; ?></button>
                                
                            </td></center>
                        <?php } ?>

                    

                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <span><?php  ?></span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                    </div>
                                </td>
                                <td></td>
                               
                            </tr>
                            <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium" style="font-size: 18px"><b>Oral polio Vaccine (OPV)</b></span>
                                    </div>
                                </td>
                                
                                 
                                   <?php
                                            if($OPV_d1<$today_date)
                               {  ?>
                                 <td class="py-3 px-6 text-center">

                                    <button class="btn btn-success badge-pill" ><a href=""></a><?php echo $OPV_d1; ?></button>
                                </td>
                               <?php    } 
                               elseif($OPV_d1==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $OPV_d1; ?></button>
                                </td> <?php
                                }
                               else
                               {
                                   ?>
                            
                               <td class="py-3 px-6 text-center">
                                   <button class="btn btn-danger badge-pill" onclick="opv1();"><a href=""></a><?php echo $OPV_d1; ?></button>
                               </td>

                                <?php } 
                                ?>
                                    
                               
                                
                                <?php
                                    if($OPV_d2<$today_date)
                               {  ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $OPV_d2; ?></button>
                                </td>
                                <?php
                            } 
                            elseif($OPV_d2==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $OPV_d2; ?></button>

                               
                            </td> <?php
                             }
                            else
                                { ?>
                                    <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="opv2();"><a href=""></a><?php echo $OPV_d2; ?></button>
                               <?php    } 
                                   ?>
                                </td>

                          <?php    if($OPV_d3<$today_date) 
                          {  ?> 
               
                                <td class="py-3 px-6 text-center">
                                     <button class="btn btn-success badge-pill" ><a href=""></a><?php echo $OPV_d3; ?></button>
                                </td>
                            <?php }
                             elseif($OPV_d3==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $OPV_d3; ?></button>
                                </td> <?php
                                }
                                 else
                                { ?>
                                <td class="py-3 px-6 text-center">
                                     <button class="btn btn-danger badge-pill" onclick="opv3();"><a href=""></a><?php echo $OPV_d3; ?></button>
                                </td>
                               <?php } ?>

                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        
                                    </div>
                                </td>

                                <td></td>


                                
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium" style="font-size: 18px"><b>Hepatitis-B vaccine</b></span>
                                    </div>
                                </td>

                                <?php 
                                if($HPB_d1<$today_date)
                                    { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $HPB_d1; ?></button>
                                </td>
                                <?php
                                 }
                                  elseif($HPB_d1==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HPB_d1; ?></button>
                                </td> <?php
                                }
                                 else
                                 {
                                    ?>
                                     <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="hpb1();"><a href=""></a><?php echo $HPB_d1; ?></button>
                                </td>
                                <?php } ?>
                                
                                <?php 
                                if($HPB_d2<$today_date)
                                    { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill" ><a href=""></a><?php echo $HPB_d2; ?></button>
                                </td>
                                <?php
                                }
                                 elseif($HPB_d2==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HPB_d2; ?></button>
                                </td> <?php
                                }
                                else
                                    { ?>
                                         <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="hpb2();"><a href=""></a><?php echo $HPB_d2; ?></button>
                                </td>
                            <?php } ?>
                      <?php 
                                if($HPB_d3<$today_date)
                                { ?>          
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $HPB_d3; ?></button>
                                </td>
                                <?php
                                 }
                                  elseif($HPB_d3==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HPB_d3; ?></button>
                                </td> <?php
                                }
                                 else
                                 {
                                    ?>
                             <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="hpb3();"><a href=""></a><?php echo $HPB_d3; ?></button>
                                    </td>
                                <?php } ?>
                                
                             
                        <?php  if($HPB_d4<$today_date)
                                { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill" ><a href=""></a><?php echo $HPB_d4; ?></button>
                                </td>
                               <?php
                                }
                                 elseif($HPB_d4==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HPB_d4; ?></button>
                                </td> <?php
                                }
                                else
                                { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="hpb4();"><a href=""></a><?php echo $HPB_d4; ?></button>
                                </td>
                            <?php } ?>
                          
                     <?php    if($HPB_d5<$today_date)
                        { ?>
                            <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $HPB_d5; ?></button>
                                </td>

                                <?php 
                            }
                             elseif($HPB_d5==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HPB_d5; ?></button>
                                </td> <?php
                                }
                            else
                            {  ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="hpb5();"><a href=""></a><?php echo $HPB_d5; ?></button>

                                </td>
                            <?php } ?>
                            </tr>
                            <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center">
                                        <span class="font-medium" style="font-size: 18px"><b>DTaP/DTP</b></span>
                                    </div>
                                </td>
                            <?php if($DTP_d1<$today_date)
                            {  ?>    
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill" ><a href=""></a><?php echo $DTP_d1; ?></button>
                                </td>
                                <?php
                            }
                             elseif($DTP_d1==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $DTP_d1; ?></button>
                                </td> <?php
                                }
                            else
                            { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="dtp1();"><a href=""></a><?php echo $DTP_d1; ?></button>
                                </td>

                            <?php } ?>

                            <?php if($DTP_d2<$today_date)
                            {  ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $DTP_d2; ?></button>
                                </td>
                                <?php 
                            }
                             elseif($DTP_d2==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $DTP_d2; ?></button>
                                </td> <?php
                                }
                            else
                            { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="dtp2();"><a href=""></a><?php echo $DTP_d2; ?></button>
                                </td>
                              <?php } ?>  

                               
                               <?php if($DTP_d3<$today_date)
                               { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $DTP_d3; ?></button>
                                </td>
                                <?php 
                            }
                             elseif($DTP_d3==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $DTP_d3; ?></button>
                                </td> <?php
                                }
                            else
                            { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="dtp3();"><a href=""></a><?php echo $DTP_d3; ?></button>
                                </td>
                            <?php } ?>

                            <?php if($DTP_d4<$today_date)
                                { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill" ><a href=""></a><?php echo $DTP_d4; ?></button>
                                </td>
                                <?php
                            }
                             elseif($DTP_d4==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $DTP_d4; ?></button>
                                </td> <?php
                                }
                            else
                            { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="dtp4();"><a href=""></a><?php echo $DTP_d4; ?></button>
                                
                               </td>
                                <?php } ?>
                            
                             
                        <?php if($DTP_d5<$today_date)
                               { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $DTP_d5; ?></button>
                                     </td>
                               <?php 
                           }
                            elseif($DTP_d5==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $DTP_d5; ?></button>
                                </td> <?php
                                }
                           else
                            {    ?>
                               
                             <td class="py-3 px-6 text-center">
                               <button class="btn btn-danger badge-pill" onclick="dtp5();"><a href=""></a><?php echo $DTP_d5; ?></button>
                           </td>
                          
                           <?php } ?>
                         
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium" style="font-size: 18px"><b>Haemophilus influenzae B(HiB)</b></span>
                                    </div>
                                </td>

                    <?php    if($HIB_d1<$today_date)
                           { ?>        
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $HIB_d1; ?></button>
                                </td>
                             <?php 
                         }
                          elseif($HIB_d1==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HIB_d1; ?></button>
                                </td> <?php
                                }
                         else
                            { ?>
                        <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="hib1();"><a href=""></a><?php echo $HIB_d1; ?></button>     

                                </td>

                            <?php } ?>
                            
                   <?php    if($HIB_d2<$today_date)
                   { ?>

                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $HIB_d2; ?></button>
                                </td>

                                <?php
                            }
                             elseif($HIB_d2==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HIB_d2; ?></button>
                                </td> <?php
                                }
                            else
                            { ?>

                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="hib2();"><a href=""></a><?php echo $HIB_d2; ?></button>
                         </td>
                               <?php } ?>     
                           
                           <?php if($HIB_d3<$today_date)
                           { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $HIB_d3; ?></button>
                                </td>

                             <?php
                             }
                              elseif($HIB_d3==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HIB_d3; ?></button>
                                </td> <?php
                                }
                             else
                             { ?>

                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="hib3();"><a href=""></a><?php echo $HIB_d3; ?></button>
                                </td>
                             <?php } ?>
                                
                         <?php if($HIB_d4<$today_date)
                         { ?>

                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $HIB_d4; ?></button>
                                </td>

                                <?php 
                            }
                             elseif($HIB_d4==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HIB_d4; ?></button>
                                </td> <?php
                                }
                            else
                            { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="hib4();"><a href=""></a><?php echo $HIB_d4; ?></button>
                              </td>
                                <?php } ?>    
                            
                                <td></td>
                                
                            </tr>
                            <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center">
                                        <span class="font-medium" style="font-size: 18px"><b>RotaVirus Vaccine</b></span>
                                    </div>
                                </td>

                         <?php if($ROTA_d1<$today_date)
                         { ?>
                                
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill" ><a href=""></a><?php echo $ROTA_d1; ?></button>
                                </td>
                            <?php 
                            }
                             elseif($ROTA_d1==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $ROTA_d1; ?></button>
                                </td> <?php
                                }
                            else
                            { ?>

                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="rota1();"><a href=""></a><?php echo $ROTA_d1; ?></button>
                                </td>
                            <?php } ?>

                         <?php if($ROTA_d2<$today_date)
                             { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $ROTA_d2; ?></button>
                                </td>
                            <?php
                            }
                             elseif($ROTA_d2==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $ROTA_d2; ?></button>
                                </td> <?php
                                }
                            else
                            { ?> 
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="rota2();"><a href=""></a><?php echo $ROTA_d2; ?></button>
                                </td>
                                <?php } ?> 

                           <?php if($ROTA_d3<$today_date)
                            { ?>

                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $ROTA_d3; ?></button>
                                </td>
                            <?php
                        }
                         elseif($ROTA_d3==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $ROTA_d3; ?></button>
                                </td> <?php
                                }
                        else
                        {   ?>

                             <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="rota3();"><a href=""></a><?php echo $ROTA_d3; ?></button>
                                </td>
                                 <?php }  ?>
                                
                                <td></td>
                                <td></td>
                                
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium" style="font-size: 18px"><b>Measles Mumps Rubella (MMR)</b></span>
                                    </div>
                                </td>
                         <?php if($MMR_d1<$today_date)
                           { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $MMR_d1; ?></button>
                                </td>
                            <?php
                        }
                         elseif($MMR_d1==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $MMR_d1; ?></button>
                                </td> <?php
                                }
                        else
                        { ?>
                            <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="mmr1();"><a href=""></a><?php echo $MMR_d1; ?></button>
                                </td>
                               <?php } ?> 

                <?php if($MMR_d2<$today_date)
                    { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $MMR_d2; ?></button>
                                </td>
                      <?php 
                  }
                   elseif($MMR_d2==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $MMR_d2; ?></button>
                                </td> <?php
                                }
                  else
                    { ?>
                        <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="mmr2();"><a href=""></a><?php echo $MMR_d2; ?></button>
                                </td>
                         <?php } ?>       

                                <td class="py-3 px-6 text-center">
                                    
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        
                                    </div>
                                </td>
                                <td></td>
                                
                            </tr>
                            <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">

                             
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium" style="font-size: 18px"><b>Varicella Vaccine</b></span>
                                    </div>
                                </td>

                     <?php if($VARICELLA_d1<$today_date)
                               { ?>            
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $VARICELLA_d1; ?></button>
                                </td>

                                <?php
                            }
                             elseif($VARICELLA_d1==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $VARICELLA_d1; ?></button>
                                </td> <?php
                                }
                            else
                                { ?>

                                    <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="var1();"><a href=""></a><?php echo $VARICELLA_d1; ?></button>
                                </td>

                            <?php } ?>

                  <?php if($VARICELLA_d2<$today_date)
                       { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $VARICELLA_d2; ?></button>
                                </td>

                                <?php
                            }
                             elseif($VARICELLA_d2==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $VARICELLA_d2; ?></button>
                                </td> <?php
                                }
                            else
                                { ?>
                                    <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="var2();"><a href=""></a><?php echo $VARICELLA_d2; ?></button>
                                </td>

                            <?php } ?>
                                <td class="py-3 px-6 text-center">
                                    
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        
                                    </div>
                                </td>
                                <td></td>
                                
                            </tr>
                            <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium" style="font-size: 18px"><b>Hepatitis-A Vaccine</b></span>
                                    </div>
                                </td>
                    <?php if($HPA_d1<$today_date)
                         { ?>                   
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $HPA_d1; ?></button>
                                </td>
                            <?php
                            }
                             elseif($HPA_d1==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HPA_d1; ?></button>
                                </td> <?php
                                }
                            else
                            { ?>    
                            <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="hpa1();"><a href=""></a><?php echo $HPA_d1; ?></button>
                                </td>

                                <?php } ?> 
                    <?php if($HPA_d2<$today_date)
                     { ?>              
                                 <td class="py-3 px-6 text-center">
                                   <button class="btn btn-success badge-pill"><a href=""></a><?php echo $HPA_d2; ?></button>
                                </td>
                          <?php
                      }
                       elseif($HPA_d2==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $HPA_d2; ?></button>
                                </td> <?php
                                }
                      else
                        { ?>
                            <td class="py-3 px-6 text-center">
                                   <button class="btn btn-danger badge-pill" onclick="hpa2();"><a href=""></a><?php echo $HPA_d2; ?></button>
                                </td>
                            <?php } ?>

                                <td class="py-3 px-6 text-center">
                                    
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        
                                    </div>
                                </td>
                                <td></td>
                                
                            </tr>
                            <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium" style="font-size: 18px"><b>Pneumococcal Conjugate (PCV)</b></span>
                                    </div>
                                </td>
                              <?php if($PCV_d1<$today_date)
                                { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $PCV_d1; ?></button>
                                </td>
                                <?php
                            }
                             elseif($PCV_d1==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $PCV_d1; ?></button>
                                </td> <?php
                                }
                            else
                                { ?>
                                    <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill" onclick="pcv1();"><a href=""></a><?php echo $PCV_d1; ?></button>
                                </td>
                            <?php } ?>

                         <?php if($PCV_d2<$today_date)
                          { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $PCV_d2; ?></button>
                                </td>

                                <?php 
                            }
                             elseif($PCV_d2==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $PCV_d2; ?></button>
                                </td> <?php
                                }
                            else
                                { ?>
                                    <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill"  onclick="pcv2();"><a href=""></a><?php echo $PCV_d2; ?></button>
                                </td>
                            <?php  } ?>

                  <?php if($PCV_d3<$today_date)
                    { ?>
                                <td class="py-3 px-6 text-center">
                                    <button class="btn btn-success badge-pill"><a href=""></a><?php echo $PCV_d3; ?></button>
                                </td>
                                <?php
                            }
                             elseif($PCV_d3==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $PCV_d3; ?></button>
                                </td> <?php
                                }
                            else
                                { ?>
                                    <td class="py-3 px-6 text-center">
                                    <button class="btn btn-danger badge-pill"  onclick="pcv3();"><a href=""></a><?php echo $PCV_d3; ?></button>
                                </td>
                            <?php } ?>

                         <?php if($PCV_d4<$today_date)
                         {  ?>

                                <td class="py-3 px-6 text-center">
                                   <button class="btn btn-success badge-pill"><a href=""></a><?php echo $PCV_d4; ?></button>
                                </td>
                            <?php
                        }
                         elseif($PCV_d4==$today_date) { ?>
                                   
                                    <td class="py-3 px-6 text-center">
                                <button class="btn btn-warning badge-pill"><a href="" ></a><?php echo $PCV_d4; ?></button>
                                </td> <?php
                                }
                        else
                            { ?>
                                 <td class="py-3 px-6 text-center">
                                   <button class="btn btn-danger badge-pill"  onclick="pcv4();"><a href=""></a><?php echo $PCV_d4; ?></button>
                                </td>
                              <?php } ?>  
                                <td></td>
                                
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

              
        <?php  
            
        if(isset($_SESSION['appoint']) && $_SESSION['appoint']==1)
        {
            if($BCG_d1==$today_date)
            {
                echo $button;
            }
            if($OPV_d1 == $today_date)
            {
                echo $button;
            }
            if($OPV_d2 == $today_date)
            {
                echo $button;
            }
            if($OPV_d3 == $today_date)
            {
                echo $button;
            }
            if($HIB_d4 == $today_date)
            {
                echo $button;
            }
            if($HPB_d4 == $today_date)
            {
                echo $button;
            }
            if($HPB_d5 == $today_date)
            {
                echo $button;
            }
            if($DTP_d5 == $today_date)
            {
                echo $button;
            }
        }

        ?>

    <!-- footer -->
    <?php require('partials/_footer.php'); ?> 

  

<!--

thead{
  background-color: lightgrey;
  width: 150px;
  border: 10px solid darkcyan;
  padding: 20px;
  margin: 10px;
}

tbody{
  background-color: lightgrey;
  width: 150px;
  border: 10px solid darkcyan;
  padding: 20px;
  margin: 10px;
}

td{
  background-color: lightgrey;
  width: 150px;
  border: 10px solid darkcyan;
  padding: 20px;
  margin: 10px;
}
-->
<!--<style>

table tr td, table tr th{
    background-color: rgba(0,0,40, 0.9) !important;
}

</style>-->
        <?php
    $date1 = strtotime($BCG_d1);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function myFunction() {alert('Vaccine:- Bacillus calmette-guerin\\n' +'Doze Number:-1\\n' + 'Doze Amount:- 0.1ml\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Left-Upper Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

        <?php
    $date1 = strtotime($OPV_d1);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function opv1() {alert('Vaccine:- Oral polio Vaccine (OPV)\\n' +'Doze Number:-1\\n' + 'Doze Amount:- 2 Drops\\n' + 'Route:- Intra-Oral \\n' + 'Site:- Oral\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($OPV_d2);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function opv2() {alert('Vaccine:- Oral polio Vaccine (OPV)\\n' +'Doze Number:-2\\n' + 'Doze Amount:- 2 Drops\\n' + 'Route:- Oral \\n' + 'Site:- Oral\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>
<?php
    $date1 = strtotime($OPV_d3);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function opv3() {alert('Vaccine:- Oral polio Vaccine (OPV)\\n' +'Doze Number:-3\\n' + 'Doze Amount:- 2 Drops\\n' + 'Route:- Oral \\n' + 'Site:- Oral\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($OPV_d3);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function opv3() {alert('Vaccine:- Oral polio Vaccine (OPV)\\n' +'Doze Number:-3\\n' + 'Doze Amount:- 2 Drops\\n' + 'Route:- Oral \\n' + 'Site:- Oral\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

<?php
    $date1 = strtotime($HPB_d1);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hpb1() {alert('Vaccine:- Hepatitis-B vaccine\\n' +'Doze Number:-1\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Antero-Lateral side of mid-thigh\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($HPB_d2);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hpb2() {alert('Vaccine:- Hepatitis-B vaccine\\n' +'Doze Number:-2\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Antero-Lateral side of mid-thigh\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($HPB_d3);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hpb3() {alert('Vaccine:- Hepatitis-B vaccine\\n' +'Doze Number:-3\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Antero-Lateral side of mid-thigh\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>
      
<?php
    $date1 = strtotime($HPB_d4);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hpb4() {alert('Vaccine:- Hepatitis-B vaccine\\n' +'Doze Number:-4\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Antero-Lateral side of mid-thigh\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($HPB_d5);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hpb5() {alert('Vaccine:- Hepatitis-B vaccine\\n' +'Doze Number:-5\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Antero-Lateral side of mid-thigh\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($DTP_d1);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function dtp1() {alert('Vaccine:- DTaP/DTP\\n' +'Doze Number:-5\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>


      <?php
    $date1 = strtotime($DTP_d2);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function dtp2() {alert('Vaccine:- DTaP/DTP\\n' +'Doze Number:-2\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:-  Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($DTP_d3);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function dtp3() {alert('Vaccine:- DTaP/DTP\\n' +'Doze Number:-3\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($DTP_d4);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function dtp4() {alert('Vaccine:- DTaP/DTP\\n' +'Doze Number:-4\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>


      <?php
    $date1 = strtotime($DTP_d5);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function dtp5() {alert('Vaccine:- DTaP/DTP\\n' +'Doze Number:-5\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

       <?php
    $date1 = strtotime($HIB_d1);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hib1() {alert('Vaccine:- Haemophilus influenzae B(HiB)\\n' +'Doze Number:-1\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>
      
 <?php
    $date1 = strtotime($HIB_d2);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hib2() {alert('Vaccine:- Haemophilus influenzae B(HiB)\\n' +'Doze Number:-2\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($HIB_d3);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hib3() {alert('Vaccine:- Haemophilus influenzae B(HiB)\\n' +'Doze Number:-3\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>
      
      <?php
    $date1 = strtotime($HIB_d4);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hib4() {alert('Vaccine:- Haemophilus influenzae B(HiB)\\n' +'Doze Number:-4\\n' + 'Doze Amount:- 0.5 ML\\n' + 'Route:- Intra-Muscluar \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

       <?php
    $date1 = strtotime($ROTA_d1);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function rota1() {alert('Vaccine:- RotaVirus Vaccine\\n' +'Doze Number:-1\\n' + 'Doze Amount:-1.0 ML\\n' + 'Route:-Oral \\n' + 'Site:- Oral\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

       <?php
    $date1 = strtotime($ROTA_d2);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function rota2() {alert('Vaccine:- RotaVirus Vaccine\\n' +'Doze Number:-2\\n' + 'Doze Amount:-1.0 ML\\n' + 'Route:-Oral \\n' + 'Site:- Oral\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

       <?php
    $date1 = strtotime($ROTA_d3);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function rota3() {alert('Vaccine:- RotaVirus Vaccine\\n' +'Doze Number:-3\\n' + 'Doze Amount:-1.0 ML\\n' + 'Route:-Oral \\n' + 'Site:- Oral\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

       <?php
    $date1 = strtotime($MMR_d1);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function mmr1() {alert('Vaccine:-Measles Mumps Rubella (MMR)\\n' +'Doze Number:-1\\n' + 'Doze Amount:-0.5 ML\\n' + 'Route:-Sub-Cutaneous \\n' + 'Site:- Right-Upper Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

  <?php
    $date1 = strtotime($MMR_d2);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function mmr2() {alert('Vaccine:-Measles Mumps Rubella (MMR)\\n' +'Doze Number:-2\\n' + 'Doze Amount:-0.5 ML\\n' + 'Route:-Sub-Cutaneous \\n' + 'Site:- Right-Upper Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>
      
      <?php
    $date1 = strtotime($VARICELLA_d1);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function var1() {alert('Vaccine:-Varicella Vaccine\\n' +'Doze Number:-1\\n' + 'Doze Amount:-0.5 ML\\n' + 'Route:-Intra-Muscular \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($VARICELLA_d2);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function var2() {alert('Vaccine:-Varicella Vaccine\\n' +'Doze Number:-2\\n' + 'Doze Amount:-0.5 ML\\n' + 'Route:-Intra-Muscular \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

       <?php
    $date1 = strtotime($HPA_d1);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hpa1() {alert('Vaccine:-Hepatitis-A Vaccine\\n' +'Doze Number:-1\\n' + 'Doze Amount:-0.5 ML\\n' + 'Route:-Intra-Muscular \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

       <?php
    $date1 = strtotime($HPA_d2);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function hpa2() {alert('Vaccine:-Hepatitis-A Vaccine\\n' +'Doze Number:-2\\n' + 'Doze Amount:-0.5 ML\\n' + 'Route:-Intra-Muscular \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($PCV_d1);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function pcv1() {alert('Vaccine:-   Pneumococcal Conjugate (PCV)\\n' +'Doze Number:-1\\n' + 'Doze Amount:-0.5 ML\\n' + 'Route:-Intra-Muscular \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($PCV_d2);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function pcv2() {alert('Vaccine:-   Pneumococcal Conjugate (PCV)\\n' +'Doze Number:-2\\n' + 'Doze Amount:-0.5 ML\\n' + 'Route:-Intra-Muscular \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($PCV_d3);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function pcv3() {alert('Vaccine:-   Pneumococcal Conjugate (PCV)\\n' +'Doze Number:-3\\n' + 'Doze Amount:-0.5 ML\\n' + 'Route:-Intra-Muscular \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>

      <?php
    $date1 = strtotime($PCV_d4);
    $date2 = strtotime($today_date);    
    $diff = abs($date1-$date2);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years)
                               / (30*60*60*24)); 
    $days = floor(($diff - $years - 
             $months)/ (60*60*24));
      echo "<script type='text/javascript'> function pcv4() {alert('Vaccine:-   Pneumococcal Conjugate (PCV)\\n' +'Doze Number:-4\\n' + 'Doze Amount:-0.5 ML\\n' + 'Route:-Intra-Muscular \\n' + 'Site:- Upper-Arm\\n\\n\\n' + 'Remainng days for vaccine:- $days\\n');}</script>" ?>
   
 
       
</body>
</header>
</html>