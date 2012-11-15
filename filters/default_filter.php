<?php
	session_start();
	include("pfConfig.php");
	$User_ID = $_SESSION['user_id'];
	
	
	$query1 = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 3");
	$result1 = mysql_query($query1);
	while ($task1 = mysql_fetch_assoc($result1)) {
		date_default_timezone_set('America/Los_Angeles');
		$Current_date = date('Y/m/d H:i:s', time()); 
		$Task_ID = $task1["Task_ID"];
		$Deadline = $task1["Deadline"];
		$Rank = $task1["Rank"];
		$Total_Time = $task1["Total_Time"];
		$Progress = $task1["Progress"];
		$hours_left_total = abs(strtotime($Deadline) - strtotime($Current_Date)) / 3600.0; //Need to ensure not 0
		//echo $Task_ID . $hours_left_total;
		$hours_left_work = $Total_Time - ($Total_Time * ($Progress * .01));
		$Auto_Priority = 200 * ($hours_left_work / $hours_left_total) + (($Rank * $Rank)/5);
		$query2 = sprintf("UPDATE Tasks SET Auto_Priority = '$Auto_Priority' WHERE Task_ID = 'Task_ID'");
		$result2 = mysql_query($query2);
	}
	
	
	$query = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 3 ORDER BY Auto_Priority DESC");
	$result = mysql_query($query);
	while ($task = mysql_fetch_assoc($result)) {
		$progress = $task["Progress"];
		$task_id = $task["Task_ID"];
		echo "<div class='task hide_task' id='$task_id'>".
				$task["Name"].
				"<div class='task_description'>".
				$task["Notes"].
					//"<form action='pfEditTask.php' method='post'>".
						"<input type='hidden' name='id' value='$task_id'>".
						"<input type='range' name='progress' id='progress' value='$progress'min='0' max='100' data-highlight='true' />".
						"<input class='submit' type='submit' value='Update My Progress'>".
					//"</form>".
				"<div class='edit_button' id='$task_id'>Edit Task</div>".
			"</div>".
		"</div>";
	}
?>