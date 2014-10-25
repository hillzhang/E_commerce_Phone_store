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
        	
		<h1><a href="admin.php">Administration</a> --> <a href="orders.php">Orders</a> --> View Order</h1>
		<?php
        extract($_GET);
        $sql = "select * from orders where ORDERID=".$orderid;
        //echo $sql;
       
        $stmt = OCIParse($db, $sql); 
      
        if(!$stmt)  {
            echo "An error occurred in parsing the sql string.\n"; 
            exit; 
          }
        OCIExecute($stmt);
        if(OCIFetch($stmt)){
            $username= OCIResult($stmt,2);
            $orderdate = OCIResult($stmt,3);
            $ordertotal = OCIResult($stmt,4);
            $status = OCIResult($stmt,5);
            $firstname = OCIResult($stmt,6);
            $lastname = OCIResult($stmt,7);
            $unitno = OCIResult($stmt,8);
            $street = OCIResult($stmt,9);
            $city = OCIResult($stmt,10);
            $postcode = OCIResult($stmt,11);
            $state = OCIResult($stmt,12);
            $cardtype = OCIResult($stmt,13);
            $cardno = OCIResult($stmt,14);
            $csc = OCIResult($stmt,15);
            $cardmonth = OCIResult($stmt,16);
            $cardyear = OCIResult($stmt,17);
        }
        
        
        printf("
		<div class='contact_form'>
                <div class='form_subtitle'>Order Details</div>
				
				<div class='form_row'>
					<label class='contact'><strong>Date:</strong></label>
					<input value='%s' class='contact_input' type='text' name='firstname' id='firstname' readonly='readonly'/>
                </div>
				
                <div class='form_row'>
					<label class='contact'><strong>Order ID:</strong></label>
					<input value='%s' class='contact_input' type='text' name='firstname' id='firstname' readonly='readonly'/>
                </div>
								
				
				<div class='form_row'>
					<label class='contact'><strong>Username:</strong></label>
					<input value='%s' class='contact_input' type='text' name='lastname' id='lastname' readonly='readonly'/>
                </div>
				
				
        </div>
		
		<div class='contact_form'>
                <div class='form_subtitle'>Shipping information</div>
				
                <div class='form_row'>
					<label class='contact'><strong>First name:</strong></label>
					<input value='%s' class='contact_input' type='text' name='firstname' id='firstname' readonly='readonly'/>
                </div>
								
				
				<div class='form_row'>
					<label class='contact'><strong>Last name:</strong></label>
					<input value='%s' class='contact_input' type='text' name='lastname' id='lastname' readonly='readonly'/>
                </div>
				
				
				<div class='form_row'>
					<label class='contact'><strong>House no:</strong></label>
					<input value='%s' class='contact_input' type='text' name='houseno' id='houseno' readonly='readonly'/>
                </div>
				
				
				<div class='form_row'>
					<label class='contact'><strong>Street:</strong></label>
					<input value='%s' class='contact_input' type='text' name='street' id='street' readonly='readonly'/>
				</div>
				
				
				<div class='form_row'>
					<label class='contact'><strong>City:</strong></label>
					<input value='%s' class='contact_input' type='text' name = 'city' id='city' readonly='readonly'/>
				</div>
				
				<div class='form_row'>
					<label class='contact'><strong>State:</strong></label>
					<input value='%s' class='contact_input' type='text' name ='zipcode' id='author' readonly='readonly'/>
                </div>
				
				<div class='form_row'>
					<label class='contact'><strong>Post Code:</strong></label>
					<input value='%s' class='contact_input' type='text' name ='zipcode' id='author' readonly='readonly'/>
                </div>

        </div>
        
        <div class='contact_form'>
                <div class='form_subtitle'>Payment Details</div>
				
                <div class='form_row'>
					<label class='contact'><strong>Method:</strong></label>
					<input value='%s' class='contact_input' type='text' name='firstname' id='firstname' readonly='readonly'/>
                </div>
								
				
				<div class='form_row'>
					<label class='contact'><strong>Card Number:</strong></label>
					<input value='%s' class='contact_input' type='text' name='lastname' id='lastname' readonly='readonly'/>
                </div>
				
				
				<div class='form_row'>
					<label class='contact'><strong>Expiry Date:</strong></label>
					<input value='%s' class='contact_input' type='text' name='houseno' id='houseno' readonly='readonly'/>
                </div>
				
				
				<div class='form_row'>
					<label class='contact'><strong>CCV:</strong></label>
					<input value='%s' class='contact_input' type='text' name='street' id='street' readonly='readonly'/>
				</div>

        </div>
        ",$orderdate,$orderid,$username,$firstname,$lastname,$unitno,$street,$city,$state,$postcode,$cardtype,$cardno,$cardmonth.'-'.$cardyear,$ccv);
           
        //show products for specific orderid
        $output=array();
        $output[]="<div class='contact_form'><div class='form_subtitle'>Product Details</div>";
        //ordersummary
        $sql = "SELECT * from orderSummary where ORDERID=".$orderid;
        //echo $sql;
       
        $stmt = OCIParse($db, $sql); 
      
        if(!$stmt)  {
            echo "An error occurred in parsing the sql string.\n"; 
            exit; 
          }
        OCIExecute($stmt);
        $orderids= array();
        $ids = array();
        $qtys = array();
        while(OCIFetch($stmt)) {
            $orderids[]= OCIResult($stmt,1);
            $ids[] = OCIResult($stmt,2);
            $qtys[] = OCIResult($stmt,3);
        }
        //table title
        $output[]="
        <table border='1'>
        <tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Sub Total</th></tr>
        ";
        //product info
        $totalwithoutshipping=0;
        for($i=0;$i<count($orderids);$i++){
            $orderid= $orderids[$i];
            $id = $ids[$i];
            $qty = $qtys[$i];
            $sql = "SELECT * from phones where PHONEID=".$id;
            //echo $sql;
           
            $stmt = OCIParse($db, $sql); 
          
            if(!$stmt)  {
                echo "An error occurred in parsing the sql string.\n"; 
                exit; 
              }
            OCIExecute($stmt);
            if(OCIFetch($stmt)) {
                $title= OCIResult($stmt,'TITLE');
                //$author = OCIResult($stmt,'AUTHOR');
                $price = OCIResult($stmt,'PRICE');
                //$stock = OCIResult($stmt,'QUANTITY');
            }
            $output[]=sprintf('
            <tr>
                <td>%s</td>
                <td><strong><span style="float:right;">$%s</span></strong></td>
                <td>%s</td>
                <td><strong><span style="float:right;">$%s</span></strong></td>
            </tr>
            ',$title,$price,$qty,$qty*$price);
            $totalwithoutshipping+=$qty*$price;
        }
        $output[]='
        <tr><td colspan="3"><strong>Shipping Fee:</strong></td><td><strong><span style="float:right;">$'.($ordertotal-$totalwithoutshipping).'</span></strong></td></tr>
        <tr><td colspan="3"><strong>Total:</strong></td><td><strong><span style="float:right;">$'.$ordertotal.'</span></strong></td></tr>
        </table></div>
        ';
        $output[]= sprintf('
                    <div  class="contact_form">
                        <a href="orders.php?action=dispatch&orderid=%s">Dispatch Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="orders.php?action=cancel&orderid=%s">Cancel Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="orders.php">Back</a>
                    </div>
                    ', $orderid,$orderid);
        echo join('',$output);
        OCILogoff($db);
        ?>   
			
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>   
    <!-- end of footer -->





</div> <!-- end of container -->
</body>
</html>