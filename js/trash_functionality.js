		var open_task = null;
		
		function decorate_borders() {
			for (var i = 0; i < $('.trash_page').find('.task').length; i++) {
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
					$(task).children('.heart').show();
					$(task).css('color', 'black');
				}
			});
		}
		
		function adjust_arrow(task, hide) {
			var task_name_height = $($(task).children('.task_name')).height();
			//$($(task).children('.arrow')).css('margin-top', (task_name_height * -1) + 'px');
			//$($(task).children('.trash_heart')).css('margin-top', (-20 +'px'));
			if (hide) {
				//$($(task).children('.arrow')).attr('src', 'images/down_arrow.png');
				//$($(task).children('.trash_heart')).fadeOut('slow');
			}
			else {
				//$($(task).children('.arrow')).attr('src', 'images/up_arrow.png');
				//$($(task).children('.trash_heart')).fadeIn('slow');
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
			$task_description = $('.trash_page').find('.task_description');
		
			$task_description.hide();
			decorate_borders();
			$task_description.click(function(e){
				e.stopPropagation();
			});
 			$('.trash_page').find('.task').click(function(){
 				if (open_task != null && $(this).attr('id') === open_task.attr('id')) hide_task(this);
 				else show_task(this);
 			});
 			$('.trash_page').find('.trash_heart').click(function(){
				window.location.replace("edit_task.php?task_id=" + $(this).attr('id'));
			});
			$(".trash_page").trigger('create');
		}
		
		function filter(filter_name) {
			$task_container = $('.trash_page').find('.task_container');
			$task_container.empty();
			$.ajax({
   				url: 'filters/' + filter_name,
   				success: function (response) {
    				$task_container.append(response);
    				initialize_tasks();
  				}
			});
		}
		
		function change_header() {
			$(".notifications_link").click(function() {
				window.location.replace("tasks.php");
			});
			$trash_icon = $(".trash_page").find('.notifications_link_img');
			$trash_icon.attr('src', 'images/priorifly_icons/179-notepad.png');
			$trash_icon.css('margin-top', '-5px');
			$trash_icon.css('height', '26px');
		}
