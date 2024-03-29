<?php

function showdetail() {
	global $db;
	$detail = $_SESSION['detail'];
		
	if ($detail) {
		$items = explode(',',$detail);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] +1 :1;
		}
	
		foreach ($contents as $id=>$qty) {
		
			$sql = 'SELECT * FROM phones WHERE PHONEID = '.$id;
			
			// modified
			$stmt = OCIParse($db, $sql); 
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt); 

			while(OCIFetch($stmt)) {

				$title= OCIResult($stmt,"TITLE");				
				$company = OCIResult($stmt,"COMPANY");
				
				$year = OCIResult($stmt,"YEAR");
				$price = OCIResult($stmt,"PRICE");
				$id = OCIResult($stmt,"PHONEID");
				$image = OCIResult($stmt,"IMAGE");
				$desc = $id-1;

							
			}
			
           
				$output[]= '<h1><a href="details.php?action=show&amp;id='.$id.'">'.$title.'</a></h1>';
				$output[]= '<div class="image_panel"><a href="details.php?action=show&amp;id='.$id.'"><img src="images/'.$image.'" alt="" title="" border="0" height="140" width="100"/></a></div>';
                $output[]= '<div class="product_info">';
                
				
				$output[]='<div class="price"><strong>COMPANY:</strong> <span >'.$company.'</span></div>';	
									
				$output[]='<div class="price"><strong>YEAR:</strong> <span>'.$year.'</span></div>';				
                $output[]='<div class="price"><strong>PRICE:</strong> <span >$'.$price.'</span></div>';
				$output[] = '<p class="details"><script type="text/javascript">displayDesc('.$desc.');</script></p>';
                $output[]= '<div class="buy_now_button"><a href="cart.php?action=add&amp;id='.$id.'">Buy Now</a></div>';                
                $output[]= '</div>';
                $output[]= '<div class="cleaner">&nbsp;</div>';
					
		}
		
		
		
	}
	
	return join('',$output);
}
function showTitledetail() {
	global $db;
	$detail = $_SESSION['detail'];
	
	
		
	if ($detail) {
		$items = explode(',',$detail);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] +1 :1;
		}
		
		foreach ($contents as $id=>$qty) {
		
			$sql = 'SELECT * FROM phones WHERE PHONEID = '.$id;
			
			// modified
			$stmt = OCIParse($db, $sql); 
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt); 

			while(OCIFetch($stmt)) {

				$title= OCIResult($stmt,"TITLE");
				$id = OCIResult($stmt,"PHONEID");
			
			}
			
			$output[] = '<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>'.$title.'</div>';

		}
		
	}
	return join('',$output);
}