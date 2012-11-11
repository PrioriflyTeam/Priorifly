<?php
session_start();

$Task_ID = $_POST["task_id"];

include("pfConfig.php");
//Currently where 10 is we should grab User_ID from sessions cookie
$query = sprintf("UPDATE Tasks SET Status = 1 WHERE Task_ID = '$Task_ID'");
$result = mysql_query($query);

header("Location: tasks.php");
exit();
?>
