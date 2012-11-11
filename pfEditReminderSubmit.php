<?php
session_start();
$Name = $_POST["name"];
$Notes = $_POST["description"];
$Reminder_ID = $_POST['reminder_id'];


//Calculate other stuff and name it the same as in database



include("pfConfig.php");
//Currently where 10 is we should grab User_ID from sessions cookie
$query = sprintf("UPDATE Reminders SET Name = '$Name', Notes = '$Notes' WHERE Reminder_ID = '$Reminder_ID'");
$result = mysql_query($query);
header("Location: reminders.php");
exit();
?>