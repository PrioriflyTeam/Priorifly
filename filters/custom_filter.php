<?php
	session_start();
	include("pfConfig.php");
	$User_ID = $_SESSION['user_id'];
	$query = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 3 Order by User_Priority");
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
						"<input class='submit' type='submit' value='Update My Progress'>".
					//"</form>".
			"</div>".
		"</div>";
	}
?>