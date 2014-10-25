<?php
	//link to other php file	
	require_once("connection.php");	
	
	
?>


<?php include("inc/header.php") ?> 
	<!-- end of header -->
    
    <div id="templatemo_content">
    	
        <div id="templatemo_content_left">
        	<div class="templatemo_content_left_section">
            <img src="images/bullet1.gif" alt="" title="" />
            	<h1>Tools</h1>
                <ul>
                    <li><a href="products.php">Products Admin</a></li>
                    <li><a href="orders.php">Orders Admin</a></li>
                    <li><a href="users.php">Users Admin</a></li>
					<li><a href="contact.php">View Contact</a></li>
            	</ul>
            </div>
			
            <div class="templatemo_content_left_section">
            <img src="images/bullet4.gif" alt="" title="" />
            	
                <a href="../index.php"><h1>User Website</h1></a>
            </div>
           
        </div> <!-- end of content left -->
        
        <div id="templatemo_content_right">
        	<h1><a href="admin.php">Administration</a> --> View Contact</h1>
        	
        	<div class='feat_prod_box_details'>
        	
			<?php 
		
		
		 $query1 = "SELECT * FROM contact" ;

					/* check the sql statement for errors and if errors report them */
					$stmt1 = OCIParse($connect, $query1);
					
					//echo $query;
					
					if(!$stmt1) {
						echo "An error occurred in parsing the sql string.\n";
						exit;
					}
					OCIExecute($stmt1);
					$Num_Rows = oci_fetch_all($stmt1, $Result);

			$Per_Page = 5;   // Per Page

			$Page = $_GET["Page"];
			if(!$_GET["Page"])
			{
				$Page=1;
			}

			$Prev_Page = $Page-1;
			$Next_Page = $Page+1;

			$Page_Start = (($Per_Page*$Page)-$Per_Page);
			if($Num_Rows<=$Per_Page)
			{
				$Num_Pages =1;
			}
			else if(($Num_Rows % $Per_Page)==0)
			{
				$Num_Pages =($Num_Rows/$Per_Page) ;
			}
			else
			{
				$Num_Pages =($Num_Rows/$Per_Page)+1;
				$Num_Pages = (int)$Num_Pages;
			}
			$Page_End = $Per_Page * $Page;
			if ($Page_End > $Num_Rows)
			{
				$Page_End = $Num_Rows;
			}
			
		echo "<table border='1' width = '100%'>
								<tr class='cart_title'>
									<td width = '5%'>ID</td>
									
									<td width = '15%'>Name</td>
									<td width = '12%'>Email</td>
									<td width = '12%'>Phone</td>
									<td width = '15%'>Company</td>
									<td width = '30%'>Message</td>
									<td width = '10%'></td>
									<td width = '10%'></td>
								</tr>";
								
								
								
		
		
		
		for($i=$Page_Start;$i<$Page_End;$i++) {
		
				$id = $Result["CONTACTID"][$i];
				$name = $Result["NAME"][$i];
				$email = $Result["EMIAL"][$i];
				$phone = $Result["PHONE"][$i];
				$company = $Result["COMPANY"][$i];				
			    $contact = $Result["CONTACT"][$i];
			    
			   
				echo "<tr>
									<td>" . $id . "</td>
									<td>" . $name . "</td>
									<td>" . $email . "</td>
									<td>" . $phone . "</td>
									<td>" . $company . "</td>
									<td>" . $contact . "</td>
									<td><a href='sendmsg.php?email=". $email ."&amp;name=".$name."'>Replay</a> </td>
									<td><a href='deletecontact.php?id=".$id."'>Delete</a> </td>
									</tr>
									";
								
			}
		
								echo"</table>";
		
	echo"<p>";
		if($Num_Rows > 1 && $Num_Pages == 1)
		
			echo" Total: ".$Num_Rows."Records - ".$Num_Pages."Page :";
		else if($Num_Pages > 1 && $Num_Rows == 1)
			echo "Total: ".$Num_Rows." Record - ".$Num_Pages."Pages :";
		else if($Num_Pages > 1 && $Num_Rows > 1)
			echo "Total: ".$Num_Rows." Records - ".$Num_Pages." Pages :";		
		else	
			echo "Total: ".$Num_Rows." Record - ".$Num_Pages." Page :";
			
		if($Prev_Page)
		{
			echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< Back</a> ";
		}

		for($i=1; $i<=$Num_Pages; $i++){
			if($i != $Page)
			{
				echo"[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i'>$i</a> ]";
			}
			else
			{
				echo "<strong> $i </strong>";
			}
		}
		if($Page!=$Num_Pages)
		{
			echo" <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>Next>></a> ";
		}
		echo "</p>";
		
		?>
			
			
			
			
        	</div>
        	
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>  
    <!-- end of footer -->
	 
</div> <!-- end of container -->
</body>
</html>