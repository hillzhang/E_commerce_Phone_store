<?php 
//database connection
require_once('inc/DBConnect.php');
//functions for shopping cart
require_once('inc/functions4cart.php');
//functions for details
require_once('inc/functions4details.php');
//functions for category
require_once('inc/functions4category.php');
//start session
@session_start();
// Process actions
$detail = $_SESSION['detail'];
$category = $_SESSION['category'];
$action = $_GET['action'];

if($action == 'show') {
$detail = $_GET['id'];	
$category = $_GET['id'];
}



$_SESSION['detail'] = $detail;
$_SESSION['category'] = $category;

$username = $_SESSION['username'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Phone Store</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/loadXMLnXSL.js"></script>
<script type="text/javascript" src="js/livesearch.js"></script>
</head>
<body>
<!--menu header-->

<?php include("inc/header.php") ?>

<!-- end of header -->
	<form method="get" action="instantSearch.php">
	<div class="search_bar">
		 <input type="text" id= "search" name ="instantSearch" size="72" ;" value=""/>			
			<input type="submit" value="Search" class="login_input"/>			
				
			<div id="livesearch" class="livesearch"></div>	
			</div>
		</form>
		<div class="search_bar">
		<div class="bottom_search_bar">
            <a href="Search.php" class="advancedSearch">Advanced Search</a>
            </div>
       </div>
    <?php 
					echo showTotal4RightContent();
					// Close the connection
					OCILogOff ($db);
					?>
    <div id="templatemo_content">
    	<!--left content-->
    	
    	<?php include("inc/leftcontent.php"); ?>
    	
        <!-- end of content left -->
        <!--right content-->
        <div id="templatemo_content_right">
        	<div class="templatemo_product_box">
            	
				<h1><a href="details.php?action=show&amp;id=1"><script type="text/javascript">displayTitle(0);</script></a></h1>
				<div><a href="details.php?action=show&amp;id=1"><img src="images/iphone5s.gif" alt="" title="" border="0" height="150" width="100"/></a></div>
                <div class="product_info">
                	
                  
				  <p><script type="text/javascript">displayShortDesc(0);</script></p>
				  <h3>$560.00</h3>
                    <div class="buy_now_button"><a href="cart.php?action=add&amp;id=1">Buy Now</a></div>
                    <div class="detail_button"><a href="details.php?action=show&amp;id=1">Detail</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
            <div class="cleaner_with_width">&nbsp;</div>
            
            <div class="templatemo_product_box">
            	
				<h1><a href="details.php?action=show&amp;id=2"><script type="text/javascript">displayTitle(1);</script></a></h1>
				<div><a href="details.php?action=show&amp;id=2"><img src="images/iphone5c.gif" alt="" title="" border="0" height="150" width="100"/></a></div>    	    
                <div class="product_info">
                	
                    
					<p><script type="text/javascript">displayShortDesc(1);</script></p>
					<h3>$460.30</h3>
                    <div class="buy_now_button"><a href="cart.php?action=add&amp;id=2">Buy Now</a></div>
                    <div class="detail_button"><a href="details.php?action=show&amp;id=2">Detail</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
            <div class="cleaner_with_height">&nbsp;</div>
            
            <div class="templatemo_product_box">
            	
				<h1><a href="details.php?action=show&amp;id=3"><script type="text/javascript">displayTitle(2);</script></a></h1>
				<div><a href="details.php?action=show&amp;id=3"><img src="images/note3.gif" alt="" title="" border="0" height="150" width="100"/></a></div>       	    
                <div class="product_info">
                	
                    
					<p><script type="text/javascript">displayShortDesc(2);</script></p>
					<h3>$999.00</h3>
                    <div class="buy_now_button"><a href="cart.php?action=add&amp;id=3">Buy Now</a></div>
                    <div class="detail_button"><a href="details.php?action=show&amp;id=3">Detail</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
           <div class="cleaner_with_width">&nbsp;</div>
			
			<div class="templatemo_product_box">
            	
				<h1><a href="details.php?action=show&amp;id=4"><script type="text/javascript">displayTitle(3);</script></a></h1>
				<div><a href="details.php?action=show&amp;id=4"><img src="images/note2.gif" alt="" title="" border="0" height="150" width="100"/></a></div>
                <div class="product_info">
                	
                    
					<p><script type="text/javascript">displayShortDesc(3);</script></p>
					<h3>$509.50</h3>
                    <div class="buy_now_button"><a href="cart.php?action=add&amp;id=4">Buy Now</a></div>
                    <div class="detail_button"><a href="details.php?action=show&amp;id=4">Detail</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
            <div class="cleaner_with_height">&nbsp;</div>
            
            
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>
    <!-- end of footer -->

</div> <!-- end of container -->

</body>
</html>