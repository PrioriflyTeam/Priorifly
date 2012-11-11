<?php
	$User_Priority = $_POST['order'];
	$Reminder_ID = $_POST['id'];
    include("pfConfig.php");
    $query = springf("Update Reminders Set User_Priority = '$User_Priority' Where Reminder_ID = '$Reminder_ID'");
	$result = mysql_query($query);
?>

