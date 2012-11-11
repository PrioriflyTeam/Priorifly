<?php
session_start();
$Name = $_POST["name"];
$Notes = $_POST["description"];
$Deadline = $_POST["deadline"];
$Rank = $_POST["rank"];
$Progress = $_POST["progress"];
$Total_Time = $_POST["hours"];
$User_ID = $_SESSION['user_id'];


//Calculate other stuff and name it the same as in database

date_default_timezone_set('America/Los_Angeles');
$Creation_Date = date('Y/m/d H:i:s', time()); 

$hours_left_total = abs(strtotime($Deadline) - strtotime($Creation_Date)) / 3600; //In hours 
$hours_left_work = $Total_Time - ($Total_Time * ($Progress * .01));
$Auto_Priority = 200 * ($hours_left_work / $hours_left_total) + (($Rank * $Rank)/5);

$Status = 3;


include("pfConfig.php");
$query2 = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID'"); //add user id clause later
$result2 = mysql_query($query2);
$count = 1;
while ($task2 = mysql_fetch_assoc($result2)) {
	
	$count++;
	$Task_ID = $task2["Task_ID"];
	$query3 = sprintf("UPDATE Tasks SET User_Priority = User_Priority + 1 WHERE Task_ID = '$Task_ID'");
	$result3 = mysql_query($query3);
}


//Currently where 10 is we should grab User_ID from sessions cookie
$query = "insert into Tasks values (NULL,'$Creation_Date', '$User_ID', '$Name', '$Rank', '$Auto_Priority', 1, '$Deadline', '$Total_Time', '$Progress', '$Notes', '$Status')";
$result = mysql_query($query);


header("Location: tasks.php");
exit();
?>

//To grab tasks: SELECT * FROM TASKS WHERE User_ID = X and Status = 3 ORDER BY Auto_Priority or User_Priority or Deadline or Rank
//Auto_Priority and User_Priority are equal by default until dragging and rearranging


