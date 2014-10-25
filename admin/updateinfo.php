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
        	
		<h1>Message</h1>
		
		<?php
			
			//Update product information
			$action = $_GET['action'];
			$title = $_POST['title'];
			$phoneid = $_POST['phoneid'];
			$category = $_POST['category'];
			$company = $_POST['company'];
			$price = $_POST['price'];
			$stock = $_POST['stock'];
			
			$year = $_POST['year'];
			$image = $_FILES['file']['name'];
						
			if ($action == 1) //Update
			{
				/* build sql statement using form data */
               
                $query = "update phones set TITLE = '". $title ."', COMPANY = '". $company ."', YEAR = ". $year .", PRICE =". $price .", CATEGORYID = ". $category .", QUANTITY = ". $stock .", IMAGE = '". $image ."'";
				$query .= " where PHONEID = " . $phoneid ;
				/* check the sql statement for errors and if errors report them */
				$stmt = OCIParse($connect, $query);
				//echo $query;
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				if (OCIExecute($stmt))
                {
                    $ok = 1;
                }
                else
                {
                    $ok = 0;
                }
			}
			elseif ($action == 2) //Insert
			{
				//get max product id
				$newphoneid = 0;
				$query = "select max(PHONEID) from phones";
				$stmt = OCIParse($connect, $query); 
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				
				OCIExecute($stmt);
				while(OCIFetch($stmt)) {
					$newphoneid = OCIResult($stmt,1);
				}
				
				$newphoneid++;
						
				/* build sql statement using form data */
				
                $query = "Insert into phones(PHONEID, TITLE, COMPANY, YEAR, PRICE, IMAGE, QUANTITY, CATEGORYID) ";
				$query .= " values (". $newphoneid .", '". $title ."','". $company ."', ". $year .", ". $price .",'". $image ."', ". $stock .", ". $category .")"; 
				/* check the sql statement for errors and if errors report them */
				$stmt = OCIParse($connect, $query);
				
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				if (OCIExecute($stmt))
                {
                    $ok = 1;
                }
                else
                {
                    $ok = 0;
                }
			}
			
			if ($ok == 1)
			{
				if ($action == 1)
				{
					echo "<h2>Product information is updated.</h2><br/>";
					echo"<h2><a href='products.pgp'>Cleck here to back</a></h2>";
				}
				else
				{
					echo "<h2>New product has been inserted.</h2><br/>";
				}
				//**********Upload file to server**********************
				$allowedExts = array("jpg", "jpeg", "gif", "png");
				$extension = end(explode(".", $_FILES["file"]["name"]));
				
				if ((($_FILES["file"]["type"] == "image/gif")
				|| ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/pjpeg")
				|| ($_FILES["file"]["type"] == "image/jpg"))
				&& ($_FILES["file"]["size"] < 20000)
				&& in_array($extension, $allowedExts))
				  {
				 
				  if ($_FILES["file"]["error"] > 0)
					{
					echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
					}
				  else
					{					
					if (file_exists("../images/" . $_FILES["file"]["name"]))
					  {
					  echo "But the image '". $_FILES["file"]["name"] . "' already exists. ";
					  }
					else
					  {
					  move_uploaded_file($_FILES["file"]["tmp_name"],
					  "../images/" . $_FILES["file"]["name"]);
					  echo "The image for this product is stored in: " . "images/" . $_FILES["file"]["name"];
					  }
					}				
				  }
				else
				  {				
					echo "But the image for this phone is invalid";
				  }
				//**********************End of upload file****************************
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