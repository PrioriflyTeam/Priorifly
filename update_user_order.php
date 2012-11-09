<?php
	$User_Priority = $_POST['order'];
	$Task_ID = $_POST['id'];
    include("pfConfig.php");
    $query = sprintf("Update Tasks Set User_Priority = '$User_Priority' Where Task_ID = '$Task_ID'");
	$result = mysql_query($query);
?>

