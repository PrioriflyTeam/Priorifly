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

<div data-role="page" class="tasks_page">
	<!--script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script-->
	<script src="jquery-ui-1.9.1.custom.js"></script>
	<script src="jquery-ui-1.9.1.custom.min.js"></script>
	<script src="jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript">
		
		var open_task = null;
		
		// Keep track of which buttons are on/off
		var custom_reorder_mode = true;
		var prioritize_mode = false;
		var filter_mode = false;
		
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
		 * This section of code initializes the custom re-ordering functionality.
		 *  ------------------------------------------------------------------------------
		 */
		
		function reorder_button(on) {
			if (on) {
				$("#reorder_btn").css('background-color', '#d1026c');
				$("#reorder_btn").css('border-color', '#9e0252');
				$($('#reorder_btn').children('.btn_name')).css('color', 'black');
			} else {
				$("#reorder_btn").css('background-color', '#fec0e0');
				$("#reorder_btn").css('border-color', '#fd4ba6');
				$($('#reorder_btn').children('.btn_name')).css('color', '#626262');
				$("#task_container").sortable('disable');
			}
			custom_reorder_mode = on;
		}
		
		function recount() {
			for (var i=0; i < $("#task_container").children().length; i++) {
				var task = $("#task_container").children()[i];
				var order = i + 1;
   		 		$($(task).children('.task_name')).children('.count').text(order);
			}
		}
		
		function initialize_drag_and_drop() {
			$("#task_container" ).sortable();
			$("#task_container").sortable('disable');
			$("#task_container").disableSelection();
			
			$("#task_container").sortable().bind('sortupdate', function() {
   		 		for (var i=0; i < $("#task_container").children().length; i++) {
   		 			var task = $("#task_container").children()[i];
   		 			var id = parseInt($($("#task_container").children()[i]).attr('id'));
   		 			var order = i + 1;
   		 			$($(task).children('.task_name')).children('.count').text(order);
   		 			$.ajax({
   						url: 'update_user_order',
   						type: 'POST',
   						data: {"id":id, "order":order},
   						success: function (response) {
   						}
					});
				}
				decorate_borders();
			});
			
			$("#reorder_btn").click(function() {
				$("#task_container").sortable('enable');
				filter('custom_filter.php');
				reorder_button(true);
				prioritize_button(false);
				filter_button(false);				
			});
		}
		
		
		/*
		 *  ------------------------------------------------------------------------------
		 * This section of code initializes the prioritize button functionality.
		 *  ------------------------------------------------------------------------------
		 */
		
		function prioritize_button(on) {
			if (on) {
				$("#prioritize_btn").css('background-color', '#f2d43f');
				$("#prioritize_btn").css('border-color', '#eec910');
				$($('#prioritize_btn').children('.btn_name')).css('color', 'black');
			} else {
				$("#prioritize_btn").css('background-color', '#fcf5d2');
				$("#prioritize_btn").css('border-color', '#f2d43f');
				$($('#prioritize_btn').children('.btn_name')).css('color', '#626262');
			}
			prioritize_mode = on;
		}
		
		function initialize_prioritize() {
			$("#prioritize_btn").click(function() {
				if (!prioritize_mode) filter('default_filter.php');
				prioritize_button(true);
				reorder_button(false);
				filter_button(false);
				//turn off all the other buttons
			});	
		}
		
		
		/*
		 *  ------------------------------------------------------------------------------
		 *  This section of code initializes the filter functionality.
		 *  ------------------------------------------------------------------------------
		 */
		 
		function filter_button(on) {
			if (on) {
				$('#sort_btn').css('background-color', '#61C155');
				$('#sort_btn').css('border-color', '#48a63d');
				$($('#sort_btn').children('.btn_name')).css('color', 'black');
			} else {
				$('#sort_btn').css('background-color', '#ccebc8');
				$('#sort_btn').css('border-color', '#61c155');
				$($('#sort_btn').children('.btn_name')).css('color', '#626262');
				if ($("#sorting_options_container").css('display') != 'none') {
					$("#sorting_options_container").slideUp('slow');
				}
			}
			filter_mode = on;
		}

		function initialize_filter_button() {
			$("#sorting_options_container").hide();
			$("#sort_btn").click(function() {
				if ($("#sorting_options_container").css('display') != 'none') {
					$("#sorting_options_container").slideUp('slow');
				} else {
					$("#sorting_options_container").slideDown('slow');
				}
				filter_button(true);
				reorder_button(false);
				prioritize_button(false);
			});
			
			$(".sort_option").click(function() {
				if (!$(this).hasClass('selected_option')) {
					$(".sort_option").removeClass('selected_option');
					$(this).addClass('selected_option');
					if ($(this).hasClass('deadline_option')) filter('deadline_filter.php');
					else if ($(this).hasClass('rank_option')) filter('rank_filter.php');
					//change color and text
				}
				$("#sorting_options_container").slideUp('slow');
				filter_mode = true;
			});
		}
		
		
		
		/* 
		 *  ------------------------------------------------------------------------------
		 * This section of code handles task showing, hiding, and clicking.
		 *  ------------------------------------------------------------------------------
		 */
		 
		function initialize_update_button() {
			$(".submit").click(function() {
				var submit = $(this);
    			var id = parseInt($($($($(this)).parent()).parent()).children()[0].value);
				var progress = parseInt($($($($(this)).parent()).parent()).children()[1].value);
				$.ajax({
					url: 'pfEditTask.php',
					type: 'POST',
					data: {"progress": progress, "id":id},
					success: function() {
						if (progress >= 100) {
							$($($(submit).parent()).parent()).parent().fadeOut('slow');
							alert("Good job finishing that mofo!");
						} else alert("Alright, your progress was updated!");
					}
				});
			});
		}
		
		function initialize_swipe_right() {
			$(".task_name").swiperight(function(e) {
				e.stopPropagation();
				var id = $($(this).parent()).attr('id');
				var task = $($(this).parent());
				//var task_name_length = $($(this).parent()).text().length - $($(this).parent()).children().text().length;
				//var task_name = $($(this).parent()).text().substring(0, task_name_length);
   				$.ajax({
					url: 'pfDeleteTask.php',
					type: 'POST',
					data: {"id":id},
					success: function() {
						//alert("Cool, task '" + task_name + "' is now deleted.");
						hide_task(task);
						$(task).addClass('dead_task');
						$(task).children('.arrow').hide();
						$(task).children('.heart').show();
						$(task).css('color', '#cecece');
						var kill_task = setTimeout(function(){
							$(task).fadeOut('slow');
							$(task).remove();
							recount();
						}, 5000);
						$(task).children('.heart').click(function() {
							clearTimeout(kill_task);
							revive(task);
						});
					}
				});
			});
		}
		
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
			$($(task).children('.wrench')).css('margin-top', ((task_name_height - 30) * -1) + 'px');
			if (hide) {
				$($(task).children('.arrow')).attr('src', 'images/down_arrow.png');
				$($(task).children('.wrench')).hide();
			}
			else {
				$($(task).children('.arrow')).attr('src', 'images/up_arrow.png');
				$($(task).children('.wrench')).show();
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
 			$(".edit_button").click(function(){
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
    				initialize_update_button();
					initialize_swipe_right();
  				}
			});
		}
		
		
		
		
		/*
		 *  ------------------------------------------------------------------------------
		 * This is pre-initialization stuff that happens.
		 *  ------------------------------------------------------------------------------
		 */
	
		$('.tasks_page').live('pageinit',function(event, ui){
			$('body').css('background-image', 'none');
			$('body').css('background-color', 'white');
			$("#tasks_link").attr('href', '');
			$(".create_task_text").click(function(e) {
				e.preventDefault();
				window.location.replace("create_task.php");
			});
			filter('default_filter.php'); //change this
			initialize_filter_button();
			initialize_prioritize();
			initialize_drag_and_drop();
			prioritize_button(true);
			reorder_button(false);
			filter_button(false);
		});
	</script>
	
	<?php
		include 'header.html';
	?>

	<div data-role="content">
		<div class="filter_container">
			<div id="reorder_btn"><div class="btn_name">Reorder</div></div>
			<div id="prioritize_btn"><div class="btn_name">Prioritize</div></div>
			<div id="sort_btn"><div class="btn_name">Filter</div></div>
			<div id="sorting_options_container">
				<div class="sort_option deadline_option">&bull; Deadline</div>
				<div class="sort_option rank_option last_option">&bull; Rank</div>
			</div>
		</div>
		<div id="task_container"></div>
		<!--div id="completed_task_container"></div>
		<div id="deleted_task_container"></div-->
	</div><! -- /content -->
	
	<?php
	include 'footer.html';
	?>
	
</div> <!-- /tasks home -->

<?php
	include 'bottom_boilerplate.html';
?>