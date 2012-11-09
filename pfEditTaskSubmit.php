<?php
session_start();
$Name = $_POST["name"];
$Notes = $_POST["description"];
$Deadline = $_POST["deadline"];
$Rank = $_POST["rank"];
$Progress = $_POST["progress"];
$Total_Time = ereg_replace("[^A-Za-z0-9]", "", $_POST["hours"]);

$Task_ID = $_POST["task_id"];

//Calculate other stuff and name it the same as in database

date_default_timezone_set('America/Los_Angeles');
$Current_Date = date('Y/m/d H:i:s', time()); 

$hours_left_total = abs(strtotime($Deadline) - strtotime($Current_Date)) / 3600; //In hours 
$hours_left_work = $Total_Time - ($Total_Time * ($Progress * .01));
$Auto_Priority = 200 * ($hours_left_work / $hours_left_total) + (($Rank * $Rank)/5);



include("pfConfig.php");
//Currently where 10 is we should grab User_ID from sessions cookie
$query = sprintf("UPDATE Tasks SET Name = '$Name', Notes = '$Notes', Deadline = '$Deadline', Rank = '$Rank', Auto_Priority = '$Auto_Priority', Progress = '$Progress', Total_Time = '$Total_Time' WHERE Task_ID = '$Task_ID'");
$result = mysql_query($query);

$query2 = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' ORDER by Auto_Priority DESC"); //add user id clause later
$result2 = mysql_query($query2);
$count = 0;
while ($task2 = mysql_fetch_assoc($result2)) {
	$count++;
	$Task_ID = $task2["Task_ID"];
	$query3 = sprintf("UPDATE Tasks SET User_Priority = '$count' WHERE Task_ID = '$Task_ID'");
	$result3 = mysql_query($query3);
}

header("Location: http://stanford.edu/~stguo/cgi-bin/priorifly/tasks.php");
exit();
?>
