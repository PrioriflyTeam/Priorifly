<?php
	session_start();
	include("pfConfig.php");
	$User_ID = $_SESSION['user_id'];
	$query = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 2");
	$result = mysql_query($query);
	while ($task = mysql_fetch_assoc($result)) {
		$progress = $task["Progress"];
		$task_id = $task["Task_ID"];
		echo "<div class='task completed_task hide_task' id='$task_id'>".
				$task["Name"].
				"<div class='task_description'>".
					$task["Notes"].
					"<div class='edit_button' id='$task_id'>Edit Task</div>".
				"</div>".
			"</div>";
	}
?>