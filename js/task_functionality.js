
		var open_task = null;
		
		// Keep track of which buttons are on/off
		var custom_reorder_mode = true;
		var prioritize_mode = false;
		var filter_mode = false;
		
		function decorate_borders() {
			for (var i = 0; i < $('.tasks_page').find('.task').length; i++) {
 				var color = "black";
 				if (i % 5 == 0) color = "#D1026C";
 				else if (i % 5 == 1) color = "#F2D43F";
 				else if (i % 5 == 2) color = "#61C155";
 				else if (i % 5 == 3) color = "#048091";
 				else if (i % 5 == 4) color = "#492D61"; 
 				$($('.tasks_page').find('.task')[i]).css('border-color', color);
 			}
		}
		
		/*
		 *  ------------------------------------------------------------------------------
		 * This section of code initializes the custom re-ordering functionality.
		 *  ------------------------------------------------------------------------------
		 */
		
		function reorder_button(on) {
			$reorder_btn = $('.tasks_page').find('#reorder_btn');
			if (on) {
				$reorder_btn.css('background-color', '#ff264a');
				$reorder_btn.css('border-color', '#d90024');
				$($reorder_btn.children('.btn_name')).css('color', 'white');
			} else {
				$reorder_btn.css('background-color', '#FFEAEE');
				$reorder_btn.css('border-color', '#ff4d6b');
				$($reorder_btn.children('.btn_name')).css('color', '#626262');
				$('.tasks_page').find('.task_container').sortable('disable');
			} 
			custom_reorder_mode = on;
		}
		
		function recount() {
			$task_container = $('.tasks_page').find('.task_container');
			for (var i=0; i <$task_container.children().length; i++) {
				var $task = $task_container.children()[i];
				var order = i + 1;
   		 		$($($task).children('.task_name')).children('.count').text(order);
			}
			if ($task_container.children().length == 0) {
				var done_message = $('<div class="no_tasks">You have no tasks.</div><div class="no_tasks_sidenote">Niicceee.</div>');
				$task_container.append(done_message);
			}
		}
		
		function initialize_drag_and_drop() {
			$task_container = $('.tasks_page').find('.task_container');
			$task_container.sortable();
			$task_container.sortable('disable');
			$task_container.disableSelection();
			
			$task_container.sortable().bind('sortupdate', function() {
   		 		for (var i=0; i < $task_container.children().length; i++) {
   		 			var task = $task_container.children()[i];
   		 			var id = parseInt($($task_container.children()[i]).attr('id'));
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
			
			$task_container.sortable({
            	cancel: ".task_description"
        	});
        	
        	
        	$(".task_description").sortable('cancel');
			
			$("#reorder_btn").click(function() {
				$(".sort_option").removeClass('selected_option');
				$($("#sort_btn").children()).text('Filter');
				$task_container.sortable('enable');
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
			$prioritize_btn = $('.tasks_page').find("#prioritize_btn");
			if (on) {
				$prioritize_btn.css('background-color', '#ffdb26');
				$prioritize_btn.css('border-color', '#f2ca00');
				$($prioritize_btn.children('.btn_name')).css('color', 'white');
			} else {
				$prioritize_btn.css('background-color', '#fff7cf');
				$prioritize_btn.css('border-color', '#ffdb26');
				$($prioritize_btn.children('.btn_name')).css('color', '#626262');
			}
			prioritize_mode = on;
		}
		
		function initialize_prioritize() {
			$('.tasks_page').find("#prioritize_btn").click(function() {
				$(".sort_option").removeClass('selected_option');
				$($("#sort_btn").children()).text('Filter');
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
			$sort_options_container = $('.tasks_page').find("#sorting_options_container");
			$sort_btn = $('.tasks_page').find("#sort_btn");
			if (on) {
				$sort_btn.css('background-color', '#61C155');
				$sort_btn.css('border-color', '#48a63d');
				$($sort_btn.children('.btn_name')).css('color', 'white');
			} else {
				$sort_btn.css('background-color', '#eff9ed');
				$sort_btn.css('border-color', '#61c155');
				$($sort_btn.children('.btn_name')).css('color', '#626262');
				if ($sort_options_container.css('display') != 'none') {
					$sort_options_container.slideUp('slow');
				}
			}
			filter_mode = on;
		}

		function initialize_filter_button() {
			$sort_options_container = $('.tasks_page').find("#sorting_options_container");
			$sort_options_container.hide();
			$('.tasks_page').find("#sort_btn").click(function() {
				if ($sort_options_container.css('display') != 'none') {
					$sort_options_container.slideUp('slow');
				} else {
					$sort_options_container.slideDown('slow');
				}
				filter_button(true);
				reorder_button(false);
				prioritize_button(false);
			});
			
			$(".sort_option").click(function() {
				if (!$(this).hasClass('selected_option')) {
					$(".sort_option").removeClass('selected_option');
					$(this).addClass('selected_option');
					if ($(this).hasClass('deadline_option')) {
						filter('deadline_filter.php');
						$($("#sort_btn").children()).text('Deadline');
					} else if ($(this).hasClass('rank_option')) {
						filter('rank_filter.php');
						$($("#sort_btn").children()).text('Rank');
					}
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
			$('.tasks_page').find('.submit').click(function() {
				var submit = $(this);
    			var id = parseInt($($($($(this)).parent()).parent()).children()[0].value);
				var progress = parseInt($($($($(this)).parent()).parent()).children()[1].value);
				$.ajax({
					url: 'pfEditTask.php',
					type: 'POST',
					data: {"progress": progress, "id":id},
					success: function() {
						if (progress >= 100) {
							$($($(submit).parent()).parent()).children('.progress_update_message').text("Good job on finishing that!  It's in the recycle bin now.");
							$($($(submit).parent()).parent()).children('.progress_update_message').slideDown('slow').delay(1000).slideUp('slow');
							window.setTimeout(function(){
								$($($(submit).parent()).parent()).parent().fadeOut('slow', function() {
									$($($(submit).parent()).parent()).parent().remove();
									recount();
								});}
								, 3000);
						} else {
							$($($(submit).parent()).parent()).children('.progress_update_message').text('Your progress has been updated');
							$($($(submit).parent()).parent()).children('.progress_update_message').slideDown('slow').delay(1000).slideUp('slow');
						}
					}
				});
			});
		}
		
		function initialize_swipe_right() {
			$('.tasks_page').find('.task_name').swiperight(function(e) {
				e.stopPropagation();
				var id = $($(this).parent()).attr('id');
				var task = $($(this).parent());
   				$.ajax({
					url: 'pfDeleteTask.php',
					type: 'POST',
					data: {"id":id},
					success: function() {
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
			$task_description = $('.tasks_page').find(".task_description");
			$task_description.hide();
			decorate_borders();
			$task_description.click(function(e){
				e.stopPropagation();
			});
 			$('.tasks_page').find('.task').click(function(){
 				if (open_task != null && $(this).attr('id') === open_task.attr('id')) hide_task(this);
 				else show_task(this);
 			});
 			$(".edit_button").click(function(){
				window.location.replace("edit_task.php?task_id=" + $(this).attr('id'));
			});
			$(".notifications_link").click(function() {
				window.location.replace("trash.php");
			});
			$(".tasks_page").trigger('create');
		}
		
		function filter(filter_name) {
			$task_container = $('.tasks_page').find('.task_container');
			$task_container.empty();
			$.ajax({
   				url: 'filters/' + filter_name,
   				success: function (response) {
    				$task_container.append(response);
    				initialize_tasks();
    				initialize_update_button();
					initialize_swipe_right();
					if (filter_name == "custom_filter.php") {
						if ($task_container.children('.task').length === 0) {
							$task_container.sortable('disable');
						}
					}
  				}
			});
		}
