<?php
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header("Location: index.php");
	} else {
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
			for (var i = 1; i < $(".task").length; i++) {
 				var color = "black";
 				if (i % 5 == 4) color = "#95CFB7"; 
 				else if (i % 5 == 1) color = "#F04155";
 				else if (i % 5 == 2) color = "#FF823A";
 				else if (i % 5 == 3) color = "#F2F26F";
 				else if (i % 5 == 0) color = "#FFF7BD";
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
			} else {
				$("#reorder_btn").css('background-color', '#fd4ba6');
			}
			custom_reorder_mode = on;
		}
		
		function initialize_drag_and_drop() {
			$("#task_container" ).sortable();
			$("#task_container").sortable('disable');
			$("#task_container").disableSelection();
			
			$("#task_container").sortable().bind('sortupdate', function() {
   		 		for (var i=0; i < $("#task_container").children().length; i++) {
   		 			var id = parseInt($($("#task_container").children()[i]).attr('id'));
   		 			var order = i + 1;
   		 			$.ajax({
   						url: 'update_user_order',
   						type: 'POST',
   						data: {"id":id, "order":order},
   						success: function (response) {
   							console.log("id: " + id + " order: " + order + " successfully reordered!");
   						}
					});
				}
			});
			
			$("#reorder_btn").click(function() {
				if (!custom_reorder_mode) $("#task_container").sortable('enable');
				reorder_button(true);
				prioritize_button(false);
				filter_button(false);
				//turn off all the other buttons
				
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
			} else {
				$("#prioritize_btn").css('background-color', '#f7e488');
			}
			prioritize_mode = on;
		}
		
		function initialize_prioritize() {
			$("#prioritize_btn").click(function() {
				if (!prioritize_mode) filter('default_filter.php');
				prioritize_mode(true);
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
				$('#sort_btn').css('background-color', '#492D61');
			} else {
				$('#sort_btn').css('background-color', '#8554b0');
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
    			var id = parseInt($($($($(this)).parent()).parent()).children()[0].value);
				var progress = parseInt($($($($(this)).parent()).parent()).children()[1].value);
				$.ajax({
					url: 'pfEditTask.php',
					type: 'POST',
					data: {"progress": progress, "id":id},
					success: function() {
						alert("Alright, your progress was updated!");
					}
				});
			});
		}
		
		function initialize_swipe_right() {
			$(".task").swiperight(function() {
   				alert($(this).attr('id'));
			});
		}
		
		function hide_task(task) {
			$(task).addClass('hide_task');
 			$(task).children('.task_description').slideUp('slow');
 			open_task = null;
		}
		
		function show_task(task) {
 			if (open_task != null) {
 				$(open_task).addClass('hide_task');
 				$(open_task).children('.task_description').slideUp('slow');
 			}
 			$(task).removeClass('hide_task');
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
			$('body').css('background-color', 'white');
			$("#tasks_link").attr('href', '');
			$("#tasks_link").click(function(e) {
				e.preventDefault();
				window.location.replace("create_task.php");
			});
			filter('default_filter.php'); //change this
			initialize_filter_button();
			initialize_prioritize();
			initialize_drag_and_drop();
			//filter_button(false);
			//reorder_button(true);
			//prioritize_button(false);
			//$("#sorting_options_container").show();
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