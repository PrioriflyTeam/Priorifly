<?php
session_start();
$Name = $_POST["name"];
$Notes = $_POST["description"];
$Deadline = $$_POST["deadline"];
$Rank = $_POST["rank"];
$Progress = $_POST["progress"];
$Total_Time = $_POST["Hours"];
$User_ID = $_SESSION['user_id'];


//Calculate other stuff and name it the same as in database

date_default_timezone_set('America/Los_Angeles');
$Creation_Date = date('Y/m/d H:i:s', time()); 

//$Time_Between = $Deadline->diff($Creation_Date);
//$Auto_Priority = 

//$User_Priority = 

$Status = 3;


include("pfConfig.php");
//Currently where 10 is we should grab User_ID from sessions cookie
$query = "insert into Tasks values (NULL,'$Creation_Date', '$User_ID', '$Name', '$Rank', NULL, NULL, '$Deadline', '$Total_Time', '$Progress', '$Notes', '$Status')";
$result = mysql_query($query);
header("Location: http://stanford.edu/~scottk92/cgi-bin/priorifly_2/tasks.php");
exit();
?>

