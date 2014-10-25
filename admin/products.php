<?php
	//link to other php file	
	require_once("connection.php");	
	session_start();
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
		
		<h1><a href="admin.php">Administration</a> --> Products</h1>
		
		
		
        
        
			<div class="feat_prod_box_details">
            
            <?php 
		
		
		 $query1 = "SELECT * FROM phones" ;

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
									<td width = '15%'>ID</td>
									<td>Title</td>
									<td width = '20%'>Company</td>
									<td width = '10%'>Price</td>
									<td width = '15%'>Stock</td>
									<td width = '15%'>Action</td>
								</tr>";
								
								
		
		
		
		for($i=$Page_Start;$i<$Page_End;$i++) {
		
				$id = $Result["PHONEID"][$i];
				$title = $Result["TITLE"][$i];
				$company = $Result["COMPANY"][$i];
				$price = $Result["PRICE"][$i];
				$stock = $Result["QUANTITY"][$i];				
			
			
			
				echo "<tr>
									<td>" . $id . "</td>
									<td>" . $title . "</td>
									<td>" . $company . "</td>
									<td>" . $price . "</td>
									<td>" . $stock . "</td>
									
									<td><a href='editproduct.php?phoneid=". $id ."'>Edit</a> <a href='deleteproduct.php?phoneid=". $id ."'> Delete </a></td>
								</tr>";
								
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
        
            
            
            
            
            
            
                
                <form name='searchproduct' action='products.php' method='post'>
				
                
                <div class='form_row'>
                
                
					<h2>Search products by keyword</h2>
						<input type='text' name='title' id='title' class='contact_input'/>   
                        <input type='submit' value='search' /><br />
                        <a href="editproduct.php?phoneid=0"> Add a new Product </a><br />
                       
                </div>
                </form>
            <div>
            
           
            
            </div> 
             
                
                
                
                
                
                
               
				
				<?php
                $mess="There is no product match your search condition.";
                //get search info
                $title = strtoupper($_POST['title']);  
					
                if (!$title == "")
				{
					
					
					//build searching condition
					$strSearch = "";
					
					$strSearch .= "upper(title) like '". $title ."%'";
												  
					/* build sql statement using form data */
					$query = "SELECT * FROM phones where " . $strSearch;

					/* check the sql statement for errors and if errors report them */
					$stmt = OCIParse($connect, $query);
					
					//echo $query;
					
					if(!$stmt) {
						echo "An error occurred in parsing the sql string.\n";
						exit;
					}
					OCIExecute($stmt);
					echo "<table border='1' width = '100%'>
								<tr class='cart_title'>
									<td width = '15%'>ID</td>
									<td>Title</td>
									<td width = '20%'>Company</td>
									<td width = '10%'>Price</td>
									<td width = '15%'>Stock</td>
									<td width = '15%'>Action</td>
								</tr>";
					while (OCIFetch($stmt)){
						$mess="";
						$title = OCIResult($stmt,"TITLE");
						$id = OCIResult($stmt,"PHONEID");
						$company = OCIResult($stmt,"COMPANY");
						$price = OCIResult($stmt,"PRICE");
						$stock = OCIResult($stmt,"QUANTITY");
						
						
								echo "<tr>
									<td>" . $id . "</td>
									<td>" . $title . "</td>
									<td>" . $company . "</td>
									<td>" . $price . "</td>
									<td>" . $stock . "</td>
									
									<td><a href='editproduct.php?phoneid=". $id ."'>Edit</a> <a href='deleteproduct.php?phoneid=". $id ."'> Delete </a></td>
								</tr>";
							
						
						
					}
					echo "</table>";
					echo $mess;
                }
            ?>
				
				
				
                
				<div class="cleaner">&nbsp;</div>
            </div>
			
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>  
    <!-- end of footer -->

</div> <!-- end of container -->
</body>
</html>