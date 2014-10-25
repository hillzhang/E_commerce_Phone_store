<?php

require_once('inc/DBConnect.php');


$sql = 'SELECT * FROM contact';

$stmt=OCIParse($db,$sql);
if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt); 

echo "<table border='1' width = '100%'>
								<tr class='cart_title'>
									<td width = '15%'>ID</td>
									<td>NAME</td>
									<td width = '20%'>EMAIL</td>
									<td width = '10%'>PHONE</td>
									<td width = '15%'>COMPANY</td>
									<td width = '15%'>MSG</td>
								</tr>";
         while(OCIFetch($stmt)) {

				$name= OCIResult($stmt,"NAME");				
				$email = OCIResult($stmt,"EMIAL");
				
				$phone = OCIResult($stmt,"PHONE");
				$company = OCIResult($stmt,"COMPANY");
				$id = OCIResult($stmt,"CONTACTID");
				$msg = OCIResult($stmt,"CONTACT");
				

							
			echo "<tr>
									<td>" . $id . "</td>
									<td>" . $name . "</td>
									<td>" . $email . "</td>
									<td>" . $phone . "</td>
									<td>" . $company . "</td>
									<td>" . $msg . "</td>
									
									
								</tr>";
								
			}
		
								echo"</table>";
              










?>