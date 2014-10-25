<?php
//database connection
require_once('inc/DBConnect.php');
session_start();
$email1=$_SESSION['email'];
$name=$_SESSION['name'];

?>

<?php 
$msg=$_POST['message'];


$mysite = 'www.phonestore.com.au';
$admin = 'Phone Store Admin';
$myemail = 'linshan@deakin.edu.au';

$subject = "Reply from ".$mysite;
$message = " Dear: ".$name." ;
           ".$msg." ;
		   Thank for your messge, we will try our best to improve our services!
       $mysite;
   ";
    
mail($email1, $subject, $message, "From: $mysite <$myemail>\nX-Mailer:PHP/" . phpversion());

include "sendmsg.php";
print '<script type="text/javascript">';
		print 'alert("Message has been send successfully !!")';
		print '</script>'; 
	exit;













?>

