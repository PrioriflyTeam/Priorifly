session_start();
include("pfConfig.php");

if (isset($_SESSION['user_id'])) {
	$User_ID = $_SESSION['user_id'];
	$query1 = sprintf("Select * From Tasks Where User_ID = '$User_ID' and Status = 2");
	$result1 = mysql_query($query1);
	date_default_timezone_set('America/Los_Angeles');
	$Current_Date = date('Y/m/d H:i:s', time());
	while($task1 = mysql_fetch_assoc($result1)) {
		$hours_left = (strtotime($task1['Deadline']) - strtotime($Current_Date)) / 3600.0;
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
}