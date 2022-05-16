<!-- <?php





//$tomorrow  = date("m-d-y",mktime(0, 0, 0, date("m"),date("d")+384,date("Y")));
//echo "Tomorrow's Date:".$tomorrow."<br/>";

//echo "";

?> -->


<!-- <?php
//$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
//$lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
//$nextyear  = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1);
?> -->


<!-- Mail -->

<!-- mail(
    string $to,
    string $subject,
    string $message,
    array|string $additional_headers = [],
    string $additional_params = ""
): bool
 -->

 <!-- \r\n is used for new line in (windows) -->

<?php


/*include("partials/_db.php");*/

/*$qry = "SELECT f_name,l_name,dob,email FROM patient_details WHERE email = '" . $_SESSION['username'] . "'";
$res = mysqli_query($con,$qry); 
if(!$res)
{
    die(mysqli_error($con));
}
$row = mysqli_fetch_array($res);*/

//$to_email = "vatsaltailor6500@gmail.com";
//$to_email = "poojatailor145@gmail.com";
/*$to_email = "vatsaltailor6500@gmail.com";
$subject = "Simple email rest via Php.";
$body = "E vaccination test via php 2021 New Mail.";
$header = "From: e.vaccination.sender@gmail.com";*/

/*$today_date = date('d/m/Y');
echo $today_date;
*/
/*if(mail($to_email, $subject, $body, $header))
{
	echo "Success". $to_email; 	
}
else
{
	echo "failed";
}*/

/*$a = 10;
$b = 20;

$c = 100;

if(($a && $b) == $c)
{
	echo "true";
}
else
{
	echo "false";
}
*/

/*$end = "If you have already taken a vaccine then ignore the Message.<br/> Thank you.";
echo $end;
$start = "The vaccinaion for " . $row[0]. $row[1] ." is scheduled for Today(".$row[2].")";
echo $start;*/


echo rand(999999,9999999);

?>
















<!-- [mail function]
; For Win32 only.
; http://php.net/smtp
SMTP=smtp.gmail.com
; http://php.net/smtp-port
smtp_port=587

; For Win32 only.
; http://php.net/sendmail-from
sendmail_from = 104vatsaltailor@gmail.com

; For Unix only.  You may supply arguments as well (default: "sendmail -t -i").
; http://php.net/sendmail-path
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t" -->