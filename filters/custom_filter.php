<?php
	session_start();
	include("pfConfig.php");
	$User_ID = $_SESSION['user_id'];
	
	
		$query1 = sprintf("Select * From Tasks Where User_ID = '$User_ID' and Status = 2");
		$result1 = mysql_query($query1);

		date_default_timezone_set('America/Los_Angeles');
		$Current_Date = date('Y/m/d H:i:s', time());
		//echo $Current_Date;
		while($task1 = mysql_fetch_assoc($result1)) {
			$hours_left = (strtotime($task1['Deadline']) - strtotime($Current_Date)) / 3600.0;
			//echo $hours_left;
			$taskID = $task1['Task_ID'];
			if($task1['Progress'] == 100 || $hours_left < 0) {
				$query2 = sprintf("Select * From Tasks Where User_ID = '$User_ID' and Status = 1");
    			$result2 = mysql_query($query2);
    			while ($task2 = mysql_fetch_assoc($result2)) {
        			$taskID2 = $task2['Task_ID'];
       				$query3 = sprintf("Update Tasks Set User_Priority = User_Priority + 1 Where Task_ID = '$taskID2'");
    			}
    			$query4 = sprintf("UPDATE Tasks Set Status = 1, User_Priority = 1 Where Task_ID = '$taskID'");
    			$result4 = mysql_query($query4);
			}
		}
		
	
	
	
	$query = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 2 Order by User_Priority");
	$result = mysql_query($query);
	$count = 0;
	while ($task = mysql_fetch_assoc($result)) {
		$count++;
		$progress = $task["Progress"];
		$task_id = $task["Task_ID"];
		echo "<div class='task hide_task' id='$task_id'><div class='task_name hidden_task_name'>".
				"<span class='count'>".$count."</span>. ".$task["Name"]."</div>".
				"<img class='arrow' src='images/down_arrow.png' alt='arrow'/>".
				"<img class='heart' src='images/heart.png' alt='heart'/>".
				"<img class='wrench edit_button' id='$task_id' src='images/wrench.png' alt='wrench' />".
				"<div class='task_description'>".
				$task["Notes"].
					//"<form action='pfEditTask.php' method='post'>".
						"<input type='hidden' name='id' value='$task_id'>".
						"<input type='range' name='progress' id='progress' value='$progress'min='0' max='100' data-highlight='true' />".
						"<div class='progress_update_message'>Your progress has been updated!</div>'".
						"<input class='submit' type='submit' value='Update My Progress'>".
					//"</form>".
			"</div>".
		"</div>";
	}
	if ($count == 0) {
		echo "<div class='no_tasks'>You have no tasks.</div>";
		$random_message = rand(0,2);
		if ($random_message == 0) {
			echo "<div class='no_tasks_sidenote'>Whoot!</div>";
		} elseif ($random_message == 1) {
			echo "<div class='no_tasks_sidenote'>I'll get the wine.</div>";
		} elseif ($random_message == 2) {
			echo "<div class='no_tasks_sidenote'>Get busy!</div>";
		}
	}
?>