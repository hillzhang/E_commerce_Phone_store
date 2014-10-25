<?php
	//link to other php file	
	require_once("connection.php");	
	@session_start();
	
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
        	<h1><a href="admin.php">Administration</a> --> <a href="contact.php">View Contact</a>-->Replay</h1>
        	
        	<div class='feat_prod_box_details'>
        	<div class="form_row">
			<form action="sendemail.php" method="post">
			        <label class="contact"><strong>Send To:</strong></label>
			        <input class="contact_input" value="<?php $email=$_GET['email']; echo $email;?>"  type="text"/></br></br>
                    <label class="contact"><strong>Message:</strong></label>
                    <p><textarea class="contact_textarea" cols="" rows="" name="message"></textarea></p>
                   <input  class="submit" type="submit" name="send" value="Submit"  > 
				   </form>
					</div>
			
			<?PHP 
			
			
			$email=$_GET['email'];
			$name=$_GET['name'];
			session_start();
			$_SESSION['email']=$email;
			$_SESSION['name']=$name;
			
			
			
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