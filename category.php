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
session_start();
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Phone Store</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="lightbox.css" type="text/css" media="screen" />
	
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="js/lightbox.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/java.js"></script>
<script type="text/javascript" src="js/loadXMLnXSL.js"></script>
<script type="text/javascript" src="js/livesearch.js"></script>
</head>
<body>
<!--menu header-->

<?php include("inc/header.php") ?>

<!-- end of header -->
	<form method="get" action="instantSearch.php">
	<div class="search_bar">
		 <input type="text" id= "search" name ="instantSearch" size="72" onkeyup="displayResult(this.value);" value=""/>			
			<input type="submit" value="Search" class="login_input" />			
				
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
				
					?>
    <div id="templatemo_content">
    	<!--left content-->
    	
    	<?php include("inc/leftcontent.php") ?>
    	
        <!-- end of content left -->
        <!--right content-->
        <div id="templatemo_content_right">
        	<div class="crumb_nav">
            <a href="index.php">Home</a> &gt;&gt; <a href="#">Categories</a> &gt;&gt; <?php echo showCategoryName();?>
            </div>
            
<?php
				echo showCategory();
				// Close the connection
					OCILogOff ($db);
?>
			
            
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>
    <!-- end of footer -->
<!--  Free CSS Template www.templatemo.com -->
</div> <!-- end of container -->

</body>
</html>