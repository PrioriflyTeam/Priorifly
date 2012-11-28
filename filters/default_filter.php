<?php
	session_start();
	include("pfConfig.php");
	$User_ID = $_SESSION['user_id'];
	if (!isset($_SESSION['user_id'])) {
		header("Location: index.php");
	} else {
		$query1 = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 2");
		$result1 = mysql_query($query1);
		while ($task1 = mysql_fetch_assoc($result1)) {
			date_default_timezone_set('America/Los_Angeles');
			$Current_Date = date('Y/m/d H:i:s', time()); 
			$Task_ID = $task1["Task_ID"];
			$Deadline = $task1["Deadline"];
			$Rank = $task1["Rank"];
			$Total_Time = $task1["Total_Time"];
			$Progress = $task1["Progress"];
			$hours_left_total = (strtotime($Deadline) - strtotime($Current_Date)) / 3600.0;
			$hours_left_work = $Total_Time - ($Total_Time * ($Progress * .01));
			$Auto_Priority = 200 * ($hours_left_work / $hours_left_total) + (($Rank * $Rank)/5);
			$query2 = sprintf("UPDATE Tasks SET Auto_Priority = '$Auto_Priority' WHERE Task_ID = '$Task_ID'");
			$result2 = mysql_query($query2);
		}
	
	
		$query = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 2 ORDER BY Auto_Priority DESC");
		$result = mysql_query($query);
		$count = 0;
		while ($task = mysql_fetch_assoc($result)) {
			$count++;
			$progress = $task["Progress"];
			$task_id = $task["Task_ID"];
			echo "<div class='task hide_task' id='$task_id'><div class='task_name hidden_task_name'>".
				"<span class='count'>".$count."</span>. ".$task["Name"].
				"</div>".
				"<img class='arrow' src='images/down_arrow.png' alt='arrow'/>".
				"<img class='heart' src='images/heart.png' alt='heart'/>".
				"<img class='wrench edit_button' id='$task_id' src='images/wrench.png' alt='wrench' />".
				"<div class='task_description'>".
				$task["Notes"].
					//"<form action='pfEditTask.php' method='post'>".
						"<input type='hidden' name='id' value='$task_id'>".
						"<input type='range' name='progress' id='progress' value='$progress'min='0' max='100' data-highlight='true' />".
						"<div class='progress_update_message'>Your progress has been updated!</div>".
						"<input class='submit' type='submit' value='Update My Progress'>".
					//"</form>".
			"</div>".
		"</div>";
		}
		if ($count == 0) {
			echo "<div class='no_tasks'>You have no tasks.</div>";
			$random_message = rand(0,2);
			if ($random_message == 0) {
				echo "<div class='no_tasks_sidenote'>!@#$ yes.</div>";
			} elseif ($random_message == 1) {
				echo "<div class='no_tasks_sidenote'>I'll get the wine.</div>";
			} elseif ($random_message == 2) {
				echo "<div class='no_tasks_sidenote'>Mmmhmm better believe it.</div>";
			}
		}	
	}
?>