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
	<script src="js/jquery-ui-1.9.1.custom.js"></script>
	<script src="js/jquery-ui-1.9.1.custom.min.js"></script>
	<script src="js/jquery.ui.touch-punch.min.js"></script>
	<script src="js/task_functionality.js"></script>
	
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
		<div class="task_container"></div>
	</div><! -- /content -->
	
	<?php
	include 'footer.html';
	?>
	
	<script type="text/javascript">		
		$('.tasks_page').live('pageinit',function(event, ui){
			$('body').css('background-image', 'none');
			$('body').css('background-color', 'white');
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
	
	
</div> <!-- /tasks home -->

<?php
	include 'bottom_boilerplate.html';
?>