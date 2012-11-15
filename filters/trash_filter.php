<?php
	session_start();
	include("pfConfig.php");
	$User_ID = $_SESSION['user_id'];
	$query = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 1");
	$result = mysql_query($query);
	while ($task = mysql_fetch_assoc($result)) {
		$task_id = $task["Task_ID"];
		echo "<div class='task hide_task' id='$task_id'><div class='task_name hidden_task_name'>".
				"<img class='arrow' src='images/down_arrow.png' alt='arrow'/>".
				"<img class='trash_heart' id='$task_id' src='images/heart.png' alt='heart'/>".
				"<div class='task_description'>".
					$task["Notes"].
				"</div>".
			"</div>";
	}
?>