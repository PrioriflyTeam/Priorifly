<?php
	include("pfConfig.php");
	
	$Email = $_POST['email'];
    console.log($email);
    $query = sprintf("SELECT * FROM Users WHERE Email LIKE '$Email'");
	$result = mysql_query($query);
	$rowCheck = mysql_num_rows($result);
	if ($rowCheck != 0) {
		echo 'false';
	}
?>