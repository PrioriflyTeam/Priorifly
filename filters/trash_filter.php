<?php
	session_start();
	include("pfConfig.php");
	$User_ID = $_SESSION['user_id'];
	$query = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 1");
	$result = mysql_query($query);
	$count = 0;
	while ($task = mysql_fetch_assoc($result)) {
		$count++;
		$task_id = $task["Task_ID"];
		echo "<div class='task hide_task' id='$task_id'>
					<div class='task_name hidden_task_name'>".$task["Name"]."</div>".
				"<img class='arrow' src='images/down_arrow.png' alt='arrow'/>".
				
				"<div class='task_description'>".
				"<img class='trash_heart' id='$task_id' src='images/heart.png' alt='trash_heart'/>".
				$task["Notes"].
			"</div>".
		"</div>";
	}
	if ($count == 0) {
		echo "<div class='no_tasks'>There are no tasks in your trash bin.</div>";
		$random_message = rand(0,2);
		if ($random_message == 0) {
			echo "<div class='no_tasks_sidenote'>You should get working on that.</div>";
		} elseif ($random_message == 1) {
			echo "<div class='no_tasks_sidenote'>I see you just took out the trash.</div>";
		} elseif ($random_message == 2) {
			echo "<div class='no_tasks_sidenote'>Nope, no Oscar here!</div>";
		}
	}	
?>