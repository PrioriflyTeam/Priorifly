<?php
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header("Location: index.php");
	} else {
		$User_ID = $_SESSION['user_id'];

		include("pfConfig.php");

		$query1 = sprintf("Select * From Tasks Where User_ID = '$User_ID' and Status = 2");
		$result1 = mysql_query($query1);

		date_default_timezone_set('America/Los_Angeles');
		$Current_Date = date('Y/m/d H:i:s', time());

		while($task1 = mysql_fetch_assoc($result1)) {
			$hours_left = $task1['Deadline'] - $Current_Date;
			$taskID = $task1['Task_ID'];
			if($task1['Progress'] == 100 || $hours_left < 0) {
				$query2 = sprintf("Select * From Tasks Where UserID = '$User_ID' and Status = 1");
    			$result2 = mysql_query($query2);
    			while ($task2 = mysql_fetch_assoc($result2)) {
        			$taskID2 = $task2['Task_ID'];
       				$query3 = sprintf("Update Tasks Set User_Priority = User_Priority + 1 Where Task_ID = '$taskID2'");
    			}
    			$query4 = sprintf("UPDATE Tasks Set Status = 1, User_Priority = 1 Where Task_ID = '$Task_ID'");
    			$result4 = mysql_query($query4);
			}
		}
		include 'top_boilerplate.html';
	}
?>

<div data-role="page" class="trash_page">
	<script src="js/jquery-ui-1.9.1.custom.js"></script>
	<script src="js/jquery-ui-1.9.1.custom.min.js"></script>
	<script src="js/jquery.ui.touch-punch.min.js"></script>
	<script src="js/trash_functionality.js"></script>
	
	<?php
		include 'header.html';
	?>

	<div data-role="content">
		<div class="task_container"></div>
	</div><! -- /content -->
	
	<script type="text/javascript">
		$('.trash_page').live('pageinit',function(event, ui){
			change_header();
			$(".trash_heart").show();
			$(".trash_page").find('#header_text').text('Trash Bin');
			$('body').css('background-image', 'none');
			$('body').css('background-color', 'white');
			filter('trash_filter.php');
			$('.trash_heart').css('margin-top', (-20 +'px'));
		});
	</script>
	
</div> <!-- /tasks home -->

<?php
	include 'bottom_boilerplate.html';
?>