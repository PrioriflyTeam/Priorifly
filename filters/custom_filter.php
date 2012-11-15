<?php
	session_start();
	include("pfConfig.php");
	$User_ID = $_SESSION['user_id'];
	$query = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 3 Order by User_Priority");
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