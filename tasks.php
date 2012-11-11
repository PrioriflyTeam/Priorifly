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
		
		var active_task = null;
		var custom_mode = false;
		var filter_mode_on = false;
		var default_filter_mode = true;
		
		function initialize_bottom_buttons() {
			$("#tasks_link").removeClass('inactive_link');
 			$("#tasks_link").addClass('active_link');
 			$("#reminders_link").removeClass('active_link');
 			$("#reminders_link").addClass('inactive_link');
 			$(".tasks_plus_btn").show();
 			$(".reminders_plus_btn").hide();
		}
		
		function initialize_tasks() {
			$('.task_description').hide();
			decorate_borders();
			
			$(".task_description").click(function(e){
				e.stopPropagation();
			});
 			
 			$(".task").click(function(){
 				if (!custom_mode) {
 					if (active_task != null && $(this).attr('id') === active_task.attr('id')) {
 						$(".task").addClass('hide_task');
 						$(this).children('.task_description').slideUp('slow');
 						active_task = null;
 					} else {
 						$(".task").addClass('hide_task');
 					
 						if (active_task != null) {
 							$(active_task).children('.task_description').slideUp('slow');
 						}
 					
 						$(this).removeClass('hide_task');
 						$(this).children('.task_description').slideDown('slow');
 						active_task = $(this);
 					}
 				}
 			});
 			
 			$(".edit_button").click(function(){
				window.location.replace("edit_task.php?task_id=" + $(this).attr('id'));
			});
		}
		
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
		
		function filter(filter_name) {
			$("#task_container").empty();
			$.ajax({
   				url: 'filters/' + filter_name,
   				success: function (response) {
    				$("#task_container").append(response);
    				initialize_tasks();
    				$(".tasks_page").trigger('create');
    				$(".submit").click(function() {
    					var id = parseInt($($($($(this)).parent()).parent()).children()[0].value);
						var progress = parseInt($($($($(this)).parent()).parent()).children()[1].value);
						$.ajax({
							url: 'pfEditTask.php',
							type: 'POST',
							data: {progress: progress, id:id},
							success: function() {
								alert("Alright, your progress was updated!");
							}
						});
					});
					$(".task").swiperight(function() {
   						alert($(this).attr('id'));
					});
  				}
			});
		}
		
		function get_completed_tasks() {
			$.ajax({
   				url: 'filters/completed_tasks.php',
   				success: function (response) {
    				$("#completed_task_container").append(response);
    				$(".tasks_page").trigger('create');
    				$(".task_description").hide();
  				}
			});
		}
		
		function initialize_sort_button() {
			$("#sorting_options_container").hide();
			
			$("#sort_btn").click(function() {
				if (!filter_mode_on) {
					$("#sorting_options_container").slideDown('slow');
					$("#sort_btn").css('background-color', '#169fa3');
				} else {
					$("#sorting_options_container").slideUp('slow');
					$("#sort_btn").css('background-color', '#1bc0c6');
					if (!default_filter_mode) {
						filter('default_filter.php');
						$(".sort_option").removeClass('selected_option');
						$('#task_container').sortable('disable');
						default_filter_mode = true;
						custom_mode = false;
					}
				}
				filter_mode_on = !filter_mode_on;
			});
			$(".sort_option").click(function() {
				if (!$(this).hasClass('selected_option')) {
					$(".sort_option").removeClass('selected_option');
					$(this).addClass('selected_option');
					filter_mode_on = false;
					if ($(this).hasClass('deadline_option')) {
						filter('deadline_filter.php');
						$('#task_container').sortable('disable');
						custom_mode = false;
					} else if ($(this).hasClass('rank_option')) {
						filter('rank_filter.php');
						$('#task_container').sortable('disable');
						custom_mode = false;
					} else if ($(this).hasClass('custom_option')) {
						filter('custom_filter.php');
						$('#task_container').sortable('enable');
						if (active_task != null) {
							$(".task").addClass('hide_task');
 							$(this).children('.task_description').slideUp('slow');
 							active_task = null;
						}
						custom_mode = true;
					}
				}
				default_filter_mode = false;
				$("#sorting_options_container").slideUp('slow');
				$("#sort_btn").css('background-color', '#1bc0c6');
			});
		}
		
		function initialize_prioritize() {
			$("#prioritize_btn").click(function() {
				if (!default_filter_mode) {
						filter('default_filter.php');
						$(".sort_option").removeClass('selected_option');
						$('#task_container').sortable('disable');
						default_filter_mode = true;
						custom_mode = false;
				}
				filter('default_filter.php');
				
			});	
		}
		
		function initialize_drag_and_drop() {
			$( "#task_container" ).sortable();
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
   						success: function (response) {console.log("id: " + id + " order: " + order + " successfully reordered!");}
					});
				}
			});
		}
		
	
		$('.tasks_page').live('pageinit',function(event, ui){
			
			$('body').css('background-color', 'white');
			get_completed_tasks();
			initialize_bottom_buttons();
			filter('default_filter.php');
			initialize_sort_button();
			initialize_prioritize();
			initialize_drag_and_drop();
			$("#tasks_link").attr('href', '');
			$("#tasks_link").click(function(e) {
				e.preventDefault();
				window.location.replace("create_task.php");
			});
			
		});
	</script>
	
	<?php
		include 'header.html';
	?>

	<div data-role="content">
		<div class="filter_container">
			<!--div><img src="images/priorifly_icons/64-zap.png" alt="zap" /></div-->
			<div id="prioritize_btn">
				<div class="btn_name">Prioritize</div>
			</div>
			<div id="sort_btn">
				<!--div><img src="images/priorifly_icons/104-index-cards.png" alt="sort" /></div-->
				<div class="btn_name">Filter</div>
			</div>
			<div id="sorting_options_container">
				<div class="sort_option deadline_option">&bull; Deadline</div>
				<div class="sort_option rank_option">&bull; Rank</div>
				<div class="sort_option last_option custom_option">&bull; Custom</div>
			</div>
		</div>
		<div id="task_container"></div>
		<div id="completed_task_container"></div>
		<div id="deleted_task_container"></div>
	</div><! -- /content -->
	
	<?php
	include 'footer.html';
	?>
	
</div> <!-- /tasks home -->

<?php
	include 'bottom_boilerplate.html';
?>