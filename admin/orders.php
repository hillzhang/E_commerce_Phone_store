<?php 
//database connection
require_once('inc/DBConnect.php');
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
		
		<h1><a href="admin.php">Administration</a> --> <a href="orders.php">Orders</a></h1>
        <div>    
			<div class="feat_prod_box_details">
                <form name='searchUser' action='orders.php?action=search' method='post'>
				<div class='form_row'>
					<h2>Search order by orderID</h2>
						<input type='text' name='keywords' id='keywords' class='contact_input'/>   
                        <input type='submit' value='search' />
						<a href="orders.php">view All</a>
                </div>
                </form>
              
                
                <?php
				
				
				
				
				
				

                switch ($_GET['action'])
                {
                //search function
                case 'search':
                    //param $keywords $action
                    extract($_POST);
					
					
					
                    $sql = "SELECT * from orders where ORDERID = '$keywords'";
                    //echo $sql;
                   
                    $stmt = OCIParse($db, $sql); 
                  
                    if(!$stmt)  {
                        echo "An error occurred in parsing the sql string.\n"; 
                        exit; 
                      }
                    OCIExecute($stmt);
                    //table title
                    $output[]="
                    <table border='1' width = '100%'>
					<tr class='cart_title'>
						<td width = '10%'>Order ID</td>
						<td width = '20%'>Date</td>
                        <td width = '15%'>User ID</td>
						<td width = '15%'>Ship To</td>
						<td width = '15%'>Status</td>
						<td width = '25%'>Action</td>
					</tr>
                    ";
                    while(OCIFetch($stmt)) {
                        $orderid = OCIResult($stmt,1);
                        $username = OCIResult($stmt,2);
                        $orderdate = OCIResult($stmt,3);
                        $ordertotal = OCIResult($stmt,4);
                        $status = OCIResult($stmt,5);
                        $firstname = OCIResult($stmt,6);
                        $lastname = OCIResult($stmt,7);
                           if($status==shipped){
                        $output[]=sprintf('
						
                        <tr>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>
                                <a href="vieworders.php?orderid=%s">View</a>
								
								
                                <a>Shipped</a>
                                <a href="orders.php?action=cancel&orderid=%s">Cancel</a>
                            </td>
                        </tr>
						
						
                        ',$orderid,$orderdate,$username,$firstname.' '.$lastname,$status,$orderid,$orderid,$orderid);}
						else{
						$output[]=sprintf('
						
                        <tr>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>
                                <a href="vieworders.php?orderid=%s">View</a>
								
								
                                <a href="orders.php?action=dispatch&orderid=%s">Dispatch</a>
                                <a href="orders.php?action=cancel&orderid=%s">Cancel</a>
                            </td>
                        </tr>
						
						
                        ',$orderid,$orderdate,$username,$firstname.' '.$lastname,$status,$orderid,$orderid,$orderid);
						
						
						
						
						}
						
						
						
						
						
						
                    }
                    $output[]='</table>';
                    echo join('',$output);
                    break;
                case 'dispatch':
                    extract($_GET);
                    if(!isset($orderid))
                        break;
                    $sql = "select * from orders where ORDERID=".$orderid;
                    //echo $sql;
                   
                    $stmt = OCIParse($db, $sql); 
                  
                    if(!$stmt)  {
                        echo "An error occurred in parsing the sql string.\n"; 
                        exit; 
                      }
                    OCIExecute($stmt);
                    if(OCIFetch($stmt)){
                        $status = OCIResult($stmt,'STATUS');
                    }
                    if($status=='shipped'){
                        echo 'Error, this order has been dispatched already! <a href="orders.php">Back</a>';
                        break;
                    } 
                    else if ($status=='cancel'){
                        echo 'Error, can\'t dispatch a canceled order! <a href="orders.php">Back</a>';
                        break;
                    }
                    
                    //minus product qty
                    //ordersummary
                    $orderids= array();
                    $phoneids = array();
                    $qtys = array();
                    $sql = "SELECT * from orderSummary where ORDERID=".$orderid;
                    //echo $sql;
                   
                    $stmt = OCIParse($db, $sql); 
                  
                    if(!$stmt)  {
                        echo "An error occurred in parsing the sql string.\n"; 
                        exit; 
                      }
                    OCIExecute($stmt);
                    while(OCIFetch($stmt)) {
                        $orderids[]= OCIResult($stmt,1);
                        $phoneids[] = OCIResult($stmt,2);
                        $qtys[] = OCIResult($stmt,3);
                    }
                    //check stocks
                    $haveEnoughStock=true;
                    for($i=0;$i<count($orderids);$i++){
                        $orderid= $orderids[$i];
                        $phoneid = $phoneids[$i];
                        $qty = $qtys[$i];
                        $sql = "select QUANTITY from phones where phoneid=$phoneid";
                        $stmt = OCIParse($db, $sql); 
                        if(!$stmt)  {
                            echo "An error occurred in parsing the sql string.\n"; 
                            exit; 
                          }
                        OCIExecute($stmt);
                        if(OCIFetch($stmt)){
                            $stock = OCIResult($stmt,1);
                            if($stock<$qty){
                                echo "Don't have enough stock for phoneid: $phoneid.\n";
                                $haveEnoughStock=false;
                            }
                        }
                        else{
                            echo "Can't find product for phoneid: $phoneid.\n";
                            $haveEnoughStock=false;
                        }
                    }
                    //minus each product qty
                    if(!$haveEnoughStock)
                        break;
                    for($i=0;$i<count($orderids);$i++){
                        $orderid= $orderids[$i];
                        $phoneid = $phoneids[$i];
                        $qty = $qtys[$i];
                        $sql = "update phones set QUANTITY = ((select QUANTITY from phones where phoneid=".$phoneid.")-".$qty.") where phoneid=".$phoneid;
                        //echo $sql;
                       
                        $stmt = OCIParse($db, $sql); 
                      
                        if(!$stmt)  {
                            echo "An error occurred in parsing the sql string.\n"; 
                            exit; 
                          }
                        OCIExecute($stmt);
                    }
                    //update order status
                    $sql = "update orders set STATUS='shipped' where ORDERID=".$orderid;
                    //echo $sql;
                   
                    $stmt = OCIParse($db, $sql); 
                  
                    if(!$stmt)  {
                        echo "An error occurred in parsing the sql string.\n"; 
                        exit; 
                      }
                    OCIExecute($stmt);
                    
                    // 
                    echo 'Order has been dispatched. <a href="orders.php">Back</a>';
                    break;
                case 'cancel':
                    extract($_GET);
                    if(!isset($orderid))
                        break;
                    $sql = "select * from orders where ORDERID=".$orderid;
                    //echo $sql;
                   
                    $stmt = OCIParse($db, $sql); 
                  
                    if(!$stmt)  {
                        echo "An error occurred in parsing the sql string.\n"; 
                        exit; 
                      }
                    OCIExecute($stmt);
                    if(OCIFetch($stmt)){
                        $status = OCIResult($stmt,'STATUS');
                    }
                    if($status=='cancel'){
                        echo 'Error, this order has been canceled already! <a href="orders.php">Back</a>';
                        break;
                    }
                    else if($status=='pending'){
                        //update order status
                        $sql = "update orders set STATUS='cancel' where ORDERID=".$orderid;
                        //echo $sql;
                       
                        $stmt = OCIParse($db, $sql); 
                      
                        if(!$stmt)  {
                            echo "An error occurred in parsing the sql string.\n"; 
                            exit; 
                          }
                        OCIExecute($stmt);
                        
                        echo 'Order has been canceled. <a href="orders.php">Back</a>';
                        break;
                    }
                    
                    //return product qty
                    //ordersummary
                    $orderids= array();
                    $phoneids = array();
                    $qtys = array();
                    $sql = "SELECT * from orderSummary where ORDERID=".$orderid;
                    //echo $sql;
                   
                    $stmt = OCIParse($db, $sql); 
                  
                    if(!$stmt)  {
                        echo "An error occurred in parsing the sql string.\n"; 
                        exit; 
                      }
                    OCIExecute($stmt);
                    while(OCIFetch($stmt)) {
                        $orderids[]= OCIResult($stmt,1);
                        $phoneids[] = OCIResult($stmt,2);
                        $qtys[] = OCIResult($stmt,3);
                    }
                    //return each product qty
                    for($i=0;$i<count($orderids);$i++){
                        $orderid= $orderids[$i];
                        $phoneid = $phoneids[$i];
                        $qty = $qtys[$i];
                        $sql = "update products set QUANTITY = ((select QUANTITY from phones where phoneid=".$phoneid.")+".$qty.") where phoneid=".$phoneid;
                        //echo $sql;
                       
                        $stmt = OCIParse($db, $sql); 
                      
                        if(!$stmt)  {
                            echo "An error occurred in parsing the sql string.\n"; 
                            exit; 
                          }
                        OCIExecute($stmt);
                    }
                    //update order status
                    $sql = "update orders set STATUS='cancel' where ORDERID=".$orderid;
                    //echo $sql;
                   
                    $stmt = OCIParse($db, $sql); 
                  
                    if(!$stmt)  {
                        echo "An error occurred in parsing the sql string.\n"; 
                        exit; 
                      }
                    OCIExecute($stmt);
                    
                    echo 'Order has been canceled. <a href="orders.php">Back</a>';
                    break;
                //show all orders
                default:
                    $sql = "SELECT * from orders where STATUS<>'cancel' order by DATEORDER DESC";
                    //echo $sql;
                   
                    $stmt = OCIParse($db, $sql); 
                  
                    if(!$stmt)  {
                        echo "An error occurred in parsing the sql string.\n"; 
                        exit; 
                      }
                    OCIExecute($stmt);
                    $output[]="
                    <table border='1' width = '100%'>
					<tr class='cart_title'>
						<td width = '10%'>Order ID</td>
						<td width = '20%'>Date</td>
                        <td width = '15%'>User ID</td>
						<td width = '15%'>Ship To</td>
						<td width = '15%'>Status</td>
						<td width = '25%'>Action</td>
					</tr>
                    ";
                    while(OCIFetch($stmt)) {
                        $orderid = OCIResult($stmt,1);
                        $username = OCIResult($stmt,2);
                        $orderdate = OCIResult($stmt,3);
                        $ordertotal = OCIResult($stmt,4);
                        $status = OCIResult($stmt,5);
                        $firstname = OCIResult($stmt,6);
                        $lastname = OCIResult($stmt,7);
                    
                        if($status==shipped){
                        $output[]=sprintf('
						
                        <tr>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>
                                <a href="vieworders.php?orderid=%s">View</a>
								
								
                                <a>Shipped</a>
                                <a href="orders.php?action=cancel&orderid=%s">Cancel</a>
                            </td>
                        </tr>
						
						
                        ',$orderid,$orderdate,$username,$firstname.' '.$lastname,$status,$orderid,$orderid,$orderid);}
						else{
						$output[]=sprintf('
						
                        <tr>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>
                                <a href="vieworders.php?orderid=%s">View</a>
								
								
                                <a href="orders.php?action=dispatch&orderid=%s">Dispatch</a>
                                <a href="orders.php?action=cancel&orderid=%s">Cancel</a>
                            </td>
                        </tr>
						
						
                        ',$orderid,$orderdate,$username,$firstname.' '.$lastname,$status,$orderid,$orderid,$orderid);
						
						
						
						
						}
                    }
                    $output[]='</table>';
                    echo join('',$output);
                }
                OCILogoff($db);
				
				
				
				
				
				
                ?>
				
				
				
				
				
				 </div> 
            </div>
			
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>  
    <!-- end of footer -->

</div> <!-- end of container -->
</body>
</html>