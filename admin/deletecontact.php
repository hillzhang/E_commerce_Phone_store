<?php
//database connection
require_once('inc/DBConnect.php');
?>

<?php

$id=$_GET['id'];

$sql='delete from contact where CONTACTID='.$id;
 $stmt = OCIParse($db, $sql);
               if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt);
$query='select * from contact where CONTACTID='.$id;

$stmt1 = OCIParse($db, $query);
               if(!$stmt1)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt1);
			
			if(OCIFetch($stmt1)){
			
			include "contact.php";
         print '<script type="text/javascript">';
		print 'alert("Contact has been delete Unsuccessfully !!")';
		print '</script>'; 
	exit;
			
			}
else{
include "contact.php";
print '<script type="text/javascript">';
		print 'alert("Contact has been delete successfully !!")';
		print '</script>'; 
	exit;
	}
?>

