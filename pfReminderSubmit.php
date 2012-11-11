<?php
session_start();
$Name = $_POST["name"];
$Notes = $_POST["description"];
$User_ID = $_SESSION['user_id'];
$Reminder_ID = $_POST['reminder_id'];


//Calculate other stuff and name it the same as in database

date_default_timezone_set('America/Los_Angeles');
$Creation_Date = date('Y/m/d H:i:s', time()); 

$Status = 2;


include("pfConfig.php");
$query2 = sprintf("SELECT * FROM Reminders WHERE User_ID = '$User_ID' ORDER by User_Priority"); //add user id clause later
$result2 = mysql_query($query2);
$count = 1;
while ($task2 = mysql_fetch_assoc($result2)) {
	$count++;
	$Task_ID = $task2["Task_ID"];
	$query3 = sprintf("UPDATE Reminders SET User_Priority = '$count' WHERE Reminder_ID = '$Reminder_ID'");
	$result3 = mysql_query($query3);
}

$query = "insert into Reminders values (NULL,'$Creation_Date', '$User_ID', '$Name', '$Notes', 1, '$Status')";
$result = mysql_query($query);
header("Location: reminders.php");
exit();


?>