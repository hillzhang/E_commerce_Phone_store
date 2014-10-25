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
        	
		<h1><a href="admin.php">Administration</a> --> <a href="products.php">Products</a> --> Remove product</h1>
		<?php
			$phoneid = strtoupper($_GET['phoneid']); 
			//Check if product have order
			$count = 0;
			
			$query = "select count(*) from orderSummary where phoneid = " . $phoneid;
			$stmt = OCIParse($connect, $query); 
			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			
			OCIExecute($stmt);
			while(OCIFetch($stmt)) {
				$count = OCIResult($stmt,1);
			}
			
			//////////////////////////
			
			
			if ($count == 0)
			{
			
			
				
				// build sql statement using form data 
				
				$query = "delete phones where phoneid = " . $phoneid;			
				// check the sql statement for errors and if errors report them 
				$stmt = OCIParse($connect, $query);
				//echo $query;
				
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				if (OCIExecute($stmt))
				{
					echo "This product has been removed from catelog";
				}
				else
				{
					echo "Can not remove this product";
				}
				
			}
			else
			{
				echo "This product have an order.";
			}
			
		?>
            
			
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>  
    <!-- end of footer -->

</div> <!-- end of container -->
</body>
</html>