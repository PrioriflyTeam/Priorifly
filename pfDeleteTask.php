<?php

    include("pfConfig.php");

        
    $Task_ID = $_POST['id'];
	$query1 = sprintf("Select * From Tasks Where UserID = '$User_ID' and Status = 1");
	$result1 = mysql_query($query1);
	while ($task1 = mysql_fetch_assoc($result1)) {
        $taskID = $task2['Task_ID'];
        $query2 = sprintf("Update Tasks Set User_Priority = User_Priority + 1 Where Task_ID = '$taskID'");
        $result2 = mysql_query($query2);
	}
	$query3 = sprintf("UPDATE Tasks Set Status = 1, User_Priority = 1 Where Task_ID = '$Task_ID'");
	$result3 = mysql_query($query3);


	//This is for checking if Progress is 100
	$Task_ID = $_POST['id'];
	$query = sprintf("Select * From Tasks Where Task_ID = '$Task_ID'");
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	if ($row['Progress'] == 100) {
        $query1 = sprintf("Select * From Tasks Where UserID = '$User_ID' and Status = 1");
        $result1 = mysql_query($query1);
        while ($task1 = mysql_fetch_assoc($result1)) {
                $taskID = $task2['Task_ID'];
                $query2 = sprintf("Update Tasks Set User_Priority = User_Priority + 1 Where Task_ID = '$taskID'");
                $result2 = mysql_query($query2);
        }
        $query3 = sprintf("UPDATE Tasks Set Status = 1, User_Priority = 1 Where Task_ID = '$Task_ID'");
        $result3 = mysql_query($query3);
	}    
?>

