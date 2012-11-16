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
	<script src="jquery-ui-1.9.1.custom.js"></script>
	<script src="jquery-ui-1.9.1.custom.min.js"></script>
	<script src="jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript">
		
		var open_task = null;
		
		function decorate_borders() {
			for (var i = 0; i < $(".task").length; i++) {
 				var color = "black";
 				if (i % 5 == 0) color = "#D1026C";
 				else if (i % 5 == 1) color = "#F2D43F";
 				else if (i % 5 == 2) color = "#61C155";
 				else if (i % 5 == 3) color = "#048091";
 				else if (i % 5 == 4) color = "#492D61"; 
 				$($(".task")[i]).css('border-color', color);
 			}
		}
		
		/* 
		 *  ------------------------------------------------------------------------------
		 * This section of code handles task showing, hiding, and clicking.
		 *  ------------------------------------------------------------------------------
		 */
		
		function revive(task) {
			var id = $(task).attr('id');
			$.ajax({
				url: 'pfReviveTask.php',
				type: 'POST',
				data: {"id":id},
				success: function() {
					show_task(task);
					$(task).removeClass('dead_task');
					$(task).children('.arrow').show();
					$(task).children('.heart').hide();
					$(task).css('color', 'black');
				}
			});
		}
		
		function adjust_arrow(task, hide) {
			var task_name_height = $($(task).children('.task_name')).height();
			$($(task).children('.arrow')).css('margin-top', (task_name_height * -1) + 'px');
			$($(task).children('.trash_heart')).css('margin-top', ((task_name_height - 30) * -1) + 'px');
			if (hide) {
				$($(task).children('.arrow')).attr('src', 'images/down_arrow.png');
				$($(task).children('.trash_heart')).fadeOut('slow');
			}
			else {
				$($(task).children('.arrow')).attr('src', 'images/up_arrow.png');
				$($(task).children('.trash_heart')).fadeIn('slow');
			}
		}
		
		function hide_task(task) {
			$(task).addClass('hide_task');
			$($(task).children('.task_name')).addClass('hidden_task_name');
			adjust_arrow(task, true)
 			$(task).children('.task_description').slideUp('slow');
 			open_task = null;
		}
		
		function show_task(task) {
			if ($(task).hasClass('dead_task')) return;
 			if (open_task != null) {
 				$(open_task).addClass('hide_task');
 				$($(open_task).children('.task_name')).addClass('hidden_task_name');
 				adjust_arrow(open_task, true);
 				$(open_task).children('.task_description').slideUp('slow');
 			}
 			$(task).removeClass('hide_task');
 			$($(task).children('.task_name')).removeClass('hidden_task_name');
 			adjust_arrow(task, false);
 			$(task).children('.task_description').slideDown('slow');
 			open_task = $(task);
		}
		
		function initialize_tasks() {
			$('.task_description').hide();
			decorate_borders();
			$(".task_description").click(function(e){
				e.stopPropagation();
			});
 			$(".task").click(function(){
 				if (open_task != null && $(this).attr('id') === open_task.attr('id')) hide_task(this);
 				else show_task(this);
 			});
 			$(".trash_heart").click(function(){
				window.location.replace("edit_task.php?task_id=" + $(this).attr('id'));
			});
			$(".tasks_page").trigger('create');
		}
		
		function filter(filter_name) {
			$("#task_container").empty();
			$.ajax({
   				url: 'filters/' + filter_name,
   				success: function (response) {
    				$("#task_container").append(response);
    				initialize_tasks();
  				}
			});
		}

		
		/*
		 *  ------------------------------------------------------------------------------
		 * This is pre-initialization stuff that happens.
		 *  ------------------------------------------------------------------------------
		 */
	
		$('.trash_page').live('pageinit',function(event, ui){
			$(".trash_heart").show();
			$("#header_text").text("Trash Bin");
			$('body').css('background-image', 'none');
			$('body').css('background-color', 'white');
			filter('trash_filter.php'); //change this
		});
	</script>
	
	<?php
		include 'header.html';
	?>

	<div data-role="content">
		<div id="task_container"></div>
	</div><! -- /content -->
	
</div> <!-- /tasks home -->

<?php
	include 'bottom_boilerplate.html';
?>