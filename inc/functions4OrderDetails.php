<?php
function showPreOrderDetails() {
	global $db;
	$OrderDetails = $_SESSION['OrderDetails'];
	
	if ($OrderDetails) {
		$items = explode(',',$OrderDetails);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] +1 :1;
		}
		
		foreach ($contents as $id=>$qty) {
		
			$sql = 'SELECT * FROM orders WHERE ORDERID = '.$id;
			
			// modified
			$stmt = OCIParse($db, $sql); 
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt); 

			while(OCIFetch($stmt)) {

				$orderID= OCIResult($stmt,"ORDERID");				
				$username = OCIResult($stmt,"USERNAME");
				$dateOrder = OCIResult($stmt,"DATEORDER");
				$orderTotal = OCIResult($stmt,"ORDERTOTAL");
				$status = OCIResult($stmt,"STATUS");
				$shipUnitNo = OCIResult($stmt,"SHIPPING_UNITNO");
				$shipStreet = OCIResult($stmt,"SHIPPING_STREET");
				$shipCity = OCIResult($stmt,"SHIPPING_CITY");
				$shipPcode = OCIResult($stmt,"SHIPPING_POSTCODE");
				$shipState = OCIResult($stmt,"SHIPPING_STATE");
				$shipFname = OCIResult($stmt,"SHIPPING_FIRSTNAME");
				$shipLname = OCIResult($stmt,"SHIPPING_LASTNAME");
				
			}	
				$userQuery = 'SELECT * FROM users u, orders o WHERE LOWER(o.USERNAME) = LOWER(u.USERNAME) AND ORDERID ='.$id;
				$userQueryParse = OCIParse($db, $userQuery); 
  
					if(!$userQueryParse)  {
						echo "An error occurred in parsing the sql string.\n"; 
						exit; 
					  }
					OCIExecute($userQueryParse);
				while (OCIFetch($userQueryParse))
				{
						$Fname= OCIResult($userQueryParse,"FIRSTNAME");
						$Lname = OCIResult($userQueryParse,"LASTNAME");	
						$email = OCIResult($userQueryParse,"EMAIL");	
						$phone = OCIResult($userQueryParse,"PHONE");	
						$company = OCIResult($userQueryParse,"COMPANY");
						$address = OCIResult($userQueryParse,"ADDRESS");
						$postcode = OCIResult($userQueryParse,"POSTCODE");
						$city = OCIResult($userQueryParse,"CITY");
						$state = OCIResult($userQueryParse,"STATE");
				}
				
				$output[] = '<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Order#'.$orderID.' Details</div>';
        		$output[] = '<div class="feat_prod_box_details">';
		
              	$output[] = '<div class="contact_form">';
				$output[] = '<div class="form_subtitle">Billing Address</div>';
				$output[] = "<br /><strong>Name: </strong>$Fname $Lname";
				$output[] = '<br /><strong>Address: </strong>'.$address;
				$output[] = '<br /><strong>Postcode: </strong>'.$postcode;
				$output[] = '<br /><strong>City: </strong>'.$city;
				$output[] = '<br /><strong>State: </strong>'.$state;
				$output[] = '<br /><strong>Date: </strong>'.$dateOrder;
				$output[] = '</div>';
				
				$output[] = '<div class="contact_form">';
				$output[] = '<div class="form_subtitle">Shipping Address</div>';
				$output[] = "<br /><strong>Name: </strong>$shipFname $shipLname";
				$output[] = "<br /><strong>Address: </strong>$shipUnitNo $shipStreet";
				$output[] = '<br /><strong>Postcode: </strong>'.$shipPcode;
				$output[] = '<br /><strong>City: </strong>'.$shipCity;
				$output[] = '<br /><strong>State: </strong>'.$shipState;
				$output[] = '</div>';
				
				$OrderSummaryQuery = 'SELECT * FROM orderSummary WHERE ORDERID = '.$orderID;
			
			// modified
				$parse = OCIParse($db, $OrderSummaryQuery); 
  
				if(!$parse)  {
					echo "An error occurred in parsing the sql string.\n"; 
					exit; 
				  }
				OCIExecute($parse);
				
				$output[] = '<div class="contact_form">';
				$output[] = '<div class="form_subtitle">Products</div>';
				$output[] = '<table border = "1" class="details">';
					$output[] = '<tr>';   
					$output[] = '<th>Product Name</th>';
					$output[] = '<th>Price</th>';
					$output[] = '<th>Quantity</th>';
					$output[] = '<th>Sub Total</th>';					
					$output[] = '</tr>';
					
				while(OCIFetch($parse)) {			
				$orderID = OCIResult($parse,"ORDERID");
				$phoneID = OCIResult($parse,"PHONEID");
				$qty = OCIResult ($parse, "QUANTITY");
					
					$productsQuery = 'SELECT * FROM phones WHERE PHONEID = '.$phoneID;
					$productsQueryParse = OCIParse($db, $productsQuery); 
  
					if(!$productsQueryParse)  {
						echo "An error occurred in parsing the sql string.\n"; 
						exit; 
					  }
					OCIExecute($productsQueryParse);
				
					while (OCIFetch($productsQueryParse)) {
						$phneID = OCIResult($productsQueryParse,"PHONEID");
						$company = OCIResult($productsQueryParse,"COMPANY");
						
						$title = OCIResult($productsQueryParse,"TITLE");
						
						$year = OCIResult($productsQueryParse,"YEAR");
						$price = OCIResult($productsQueryParse,"PRICE");
						$image = OCIResult($productsQueryParse,"IMAGE");
						
						$output[] = '<tr>';
						$output[] = '<td>'.$title.'</td>';
						$output[] = '<td>$'.$price.'</td>';
						$output[] = '<td>'.$qty.'</td>';
						$output[] = '<td><strong><span style="float:right;">$'.($price*$qty).'</span></strong></td>';
						$output[] = '</tr>';
						
						
					
					}
					$total += $price*$qty;
				}
				
			
				
			//}
			
							
			
					
		}
		$shipping = 20;
		$total = $total + $shipping;
				
					$output[] = '<tr>';
					$output[] = '<td colspan="3"><strong>Shipping Fee:</strong></td>';
					$output[] = '<td><strong><span style="float:right;">$'.$shipping.'</span></strong></td>';
					$output[] = '</tr>';
					$output[] = '<tr>';
					$output[] = '<td colspan="3"><strong>Total:</strong></td>';
					$output[] = '<td><strong><span style="float:right;">$'.$total.'</span></strong></td>';
					$output[] = '</tr>';
					$output[] = '</table>';
					$output[] = '</div>';
					$output[] = '</div>';
		
	}else{
				$output[]= '<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Order Details</div>';
				$output[]= '<br />You have no previous order';
	}	

	return join('',$output);
}
