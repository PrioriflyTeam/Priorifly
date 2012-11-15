<?php
	session_start();
	include("pfConfig.php");
	$User_ID = $_SESSION['user_id'];
	$query = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 3 Order by Deadline"); 
	$result = mysql_query($query);
	while ($task = mysql_fetch_assoc($result)) {
		$progress = $task["Progress"];
		$task_id = $task["Task_ID"];
		$deadline = $task["Deadline"];
		echo "<div class='task hide_task' id='$task_id'><div class='task_name hidden_task_name'>".
				"<span class='deadline'>".$deadline."</span>.  ".$task["Name"].
				"</div>".
				"<img class='arrow' src='images/down_arrow.png' alt='arrow'/>".
				"<img class='heart' src='images/heart.png' alt='heart'/>".
				"<img class='wrench edit_button' id='$task_id' src='images/wrench.png' alt='wrench' />".
				"<div class='task_description'>".
				$task["Notes"].
					//"<form action='pfEditTask.php' method='post'>".
						"<input type='hidden' name='id' value='$task_id'>".
						"<input type='range' name='progress' id='progress' value='$progress'min='0' max='100' data-highlight='true' />".
						"<input class='submit' type='submit' value='Update My Progress'>".
					//"</form>".
			"</div>".
		"</div>";
	}
?>