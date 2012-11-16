<?php
session_start();
$Name = $_POST["name"];
$Notes = $_POST["description"];
//$Deadline = $_POST["deadline"];
   // echo $Deadline;
$Deadline = date(DATE_ISO8601, strtotime($_POST["deadline"]));
$Rank = $_POST["rank"];
$Progress = $_POST["progress"];
$Total_Time = ereg_replace("[^A-Za-z0-9]", "", $_POST["hours"]);

$Task_ID = $_POST["task_id"];

//Calculate other stuff and name it the same as in database

date_default_timezone_set('America/Los_Angeles');
$Current_Date = date('Y/m/d H:i:s', time()); 

$hours_left_total = (strtotime($Deadline) - strtotime($Current_Date)) / 3600; //In hours
include("pfConfig.php");
$query = sprintf("Select User_ID From Tasks Where Task_ID = '$Task_ID'");
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
$User_ID = $row['User_ID'];
if ($hours_left_total > 0 && Progress < 100) {
    $hours_left_work = $Total_Time - ($Total_Time * ($Progress * .01));
    $Auto_Priority = 200 * ($hours_left_work / $hours_left_total) + (($Rank * $Rank)/5);

    //Currently where 10 is we should grab User_ID from sessions cookie
    $query1 = sprintf("UPDATE Tasks SET Name = '$Name', Notes = '$Notes', Deadline = '$Deadline', Rank = '$Rank', Auto_Priority = '$Auto_Priority', Progress = '$Progress', Total_Time = '$Total_Time', Status = 2 WHERE Task_ID = '$Task_ID'");
    $result1 = mysql_query($query1);
} else {
    $query2 = sprintf("Select * From Tasks Where UserID = '$User_ID' and Status = 1");
    $result2 = mysql_query($query2);
    while ($task = mysql_fetch_assoc($result2)) {
        $taskID = $task['Task_ID'];
        $query3 = sprintf("Update Tasks Set User_Rank = User_Rank + 1 Where Task_ID = '$taskID'");
    }
    $query4 = sprintf("UPDATE Tasks Set Status = 1 Where Task_ID = '$Task_ID'");
    $result4 = mysql_query($query4);
}

header("Location: tasks.php");
exit();
?>
