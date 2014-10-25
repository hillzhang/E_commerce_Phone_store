

<div id="templatemo_content_left">
        	<div class="templatemo_content_left_section">
            
            	<img src="images/bullet1.gif" alt="" title="" />
                <h1>Categories</h1>
                <ul>
                    <li><a href="category.php?action=show&amp;id=1">Phones</a></li>
					<li><a href="category.php?action=show&amp;id=2">Cases, Covers & Skins</a></li>
					<li><a href="category.php?action=show&amp;id=3">Screen Protectors</a></li>
					<li><a href="category.php?action=show&amp;id=4">Chargers & Cradles</a></li>					
					<li><a href="category.php?action=show&amp;id=5">Cables & Adapters</a></li>					
            	</ul>
            </div>
			<div class="templatemo_content_left_section">
                <img src="images/bullet4.gif" alt="" title="" />
            	<h1>Bestsellers</h1>
				<?php

  /* Set oracle user login and password info */

$dbuser ="linshan";
$dbpass ="linshan1206";
$dbname= "SSID";

$connectdb=OCILogon($dbuser, $dbpass, $dbname);

if (!$connectdb){
    echo "An error occurred connecting to the database"; 
    exit; 
  }
?>
				<?php    
				
			
				
             $sql = 'SELECT PHONEID, SUM(Quantity) FROM orderSummary GROUP BY PHONEID ORDER BY SUM(Quantity) DESC';
              $stmt = OCIParse($connectdb, $sql);
               if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt);
			$num=0;
			while(OCIFetch($stmt)){
			
			$id = OCIResult($stmt,"PHONEID");
			$newid=$id-1;
			$num++;
			echo"<ul>";
			
			
			if($num==7){
			
			break;
			
			}
			else
			{
			echo "<li><a href='details.php?action=show&amp;id=".$id."'><script type='text/javascript'>displayTitle(".$newid.");</script></a></li>";
			}
		    echo"</ul>";
			}
           
				?>
				
				<!--
                <ul>
                    <li><a href="details.php?action=show&amp;id=1"><script type="text/javascript">displayTitle(0);</script></a></li>
                    <li><a href="details.php?action=show&amp;id=2"><script type="text/javascript">displayTitle(1);</script></a></li>
                    <li><a href="details.php?action=show&amp;id=3"><script type="text/javascript">displayTitle(2);</script></a></li>
                    <li><a href="details.php?action=show&amp;id=4"><script type="text/javascript">displayTitle(3);</script></a></li>
                    <li><a href="details.php?action=show&amp;id=5"><script type="text/javascript">displayTitle(4);</script></a></li>
                    <li><a href="details.php?action=show&amp;id=6"><script type="text/javascript">displayTitle(5);</script></a></li>
            	</ul>
				-->
            </div>
            
            <div class="templatemo_content_left_section">
                <img src="images/bullet6.gif" alt="" title="" />
            	<a href="admin/admin.php"><h1>Website administration</h1></a>
                <h1>(Staff Only)<h1>
                
            </div>
            
            <?php OCILogOff ($connectdb); ?>
           
        </div>