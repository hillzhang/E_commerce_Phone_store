 <?php
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
				
				?>