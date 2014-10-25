<?php
	/* Set oracle user login and password info */
	$dbuser = "linshan"; /* your deakin login */
	$dbpass = "linshan1206"; /* your oracle access password */
	$db = "SSID";
	$connect = OCILogon($dbuser, $dbpass, $db);
	if (!$connect) {
		echo "An error occurred connecting to the database";					
		exit;
	}
?>