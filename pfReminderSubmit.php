<?php
session_start();
$Name = $_POST["name"];
$Notes = $_POST["description"];
$User_ID = $_SESSION['user_id'];


//Calculate other stuff and name it the same as in database

date_default_timezone_set('America/Los_Angeles');
$Creation_Date = date('Y/m/d H:i:s', time()); 

//$Time_Between = $Deadline->diff($Creation_Date);
//$Auto_Priority = 

//$User_Priority = 

$Status = 2;


include("pfConfig.php");
//Currently where 10 is we should grab User_ID from sessions cookie
$query = "insert into Reminders values (NULL,'$Creation_Date', '$User_ID', '$Name', '$Notes', '$Status')";
$result = mysql_query($query);
header("Location: http://stanford.edu/~scottk92/cgi-bin/priorifly_2/reminders.php");
exit();
?>