<?php
	include("pfConfig.php");
	
	$Email = $_POST['email'];
	$Password = $_POST['password'];
	
	$query1 = sprintf("Select Salt, Digest From Users Where Email = '$Email'");
	$result1 = mysql_query($query1);
	$rowCheck1 = mysql_num_rows($result1);
	if ($rowCheck1 == 1) {
			$row = mysql_fetch_array($result1);
			if ($row['Digest'] != crypt($Password, $row['Salt']) {
				echo 'false'
			}
	} else {
		echo 'false';
	}
?>