<?php
$Name = $_POST["name"];
$Notes = $_POST["description"];
$Deadline = $_POST["deadline"];
$Rank = $_POST["rank"];
$Progress = $_POST["progress"];
$Total_Time = $_POST["hours"];

//Calculate other stuff and name it the same as in database
date_default_timezone_set('America/Los_Angeles');
$Creation_Date = date('Y/m/d H:i:s', time()); 

//$Time_Between = $Deadline->diff($Creation_Date);
//$Auto_Priority = 

//$User_Priority = 

$Status = 3;


include("pfConfig.php");
//Currently where 10 is we should grab User_ID from sessions cookie
$query = "insert into Tasks values (NULL,'$Creation_Date', '10', '$Name', '$Rank', NULL, NULL, '$Deadline', '$Total_Time', '$Progress', '$Notes', '$Status')";
$result = mysql_query($query);
    
//Redirect browser
header("Location: http://stanford.edu/~scottk02/cgi-bin/priorifly_2/tasks.php");
exit();
?>


