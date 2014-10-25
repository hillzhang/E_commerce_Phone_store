
<?php
$username = $_SESSION['username'];

?>

<!-- Begin Header -->
<div id="templatemo_container">
	
    
    <div id="templatemo_header">
	<!--hello user-->
	<div class="logo"><a href="index.php"><img src="images/logo.gif" alt="" title="" border="0" /></a></div>  
		
			
		
    </div>
    
   <div id="templatemo_menu">
   
    	<ul>
         
			<li class="selected"><a href="index.php">Home</a></li>
			<li><a href="about.php">About Us</a></li>
            <li><a href="phones.php">Products</a></li>
			<li><a href="newrelease.php">New Releases</a></li>
			<li><a href="register.php">Register</a></li>
			<!--check username already exists to show suitable menu-->
			<?php echo'<li><a href="';
				if(empty($username)) 
					echo "myaccount.php"; 
				else 
					echo"userProfiles.php";
					echo'">My Account</a></li>'; 
			?>            
            
            <li><a href="contact.php">Contact Us</a></li>
            <?php 
			if(!empty($username)) {
				echo '<li><a href="userProfiles.php" class="helloUser">Hello "'.$username.' "</a></li>';			
				echo '<li><a href="logout.php" class="helloUser">Logout</a></li>';
			}else{
				echo '<li><a href="myaccount.php" class="helloUser">Login</a></li>';
			}
		?>	
					
    	</ul>
    </div> <!-- end of menu -->