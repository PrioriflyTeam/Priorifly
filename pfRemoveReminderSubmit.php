<?php
session_start();

$Reminder_ID = $_POST["reminder_id"];





include("pfConfig.php");
//Currently where 10 is we should grab User_ID from sessions cookie
$query = sprintf("UPDATE Reminders SET Status = 1 WHERE Reminder_ID = '$Reminder_ID'");
$result = mysql_query($query);

header("Location: http://stanford.edu/~stguo/cgi-bin/priorifly/reminders.php");
exit();
?>
