<?php
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header("Location: index.php");
	} else {
		include 'top_boilerplate.html';
	}
?>

<div data-role="page" id="reminders">
	<script src="jquery-ui-1.9.1.custom.js"></script>
	<script src="jquery-ui-1.9.1.custom.min.js"></script>
	<script src="jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript">
		function initialize_reminders() {
			$("#header_text").text("Reminders");
			$('.reminder_description').hide();
			$("#reminders_link").removeClass('inactive_link');
 			$("#reminders_link").addClass('active_link');
 			$("#tasks_link").removeClass('active_link');
 			$("#tasks_link").addClass('inactive_link');
 			
 			$(".tasks_plus_btn").hide();
 			$(".reminders_plus_btn").show();
 			
 			$('body').css('background-color', 'white');
 			
 			var tasks = $(".reminder");
 			for (var i = 1; i < $(".reminder").length; i++) {
 				var color = "black";
 				if (i % 5 == 4) color = "#95CFB7"; 
 				else if (i % 5 == 1) color = "#F04155";
 				else if (i % 5 == 2) color = "#FF823A";
 				else if (i % 5 == 3) color = "#F2F26F";
 				else if (i % 5 == 0) color = "#FFF7BD";
 				$($(".reminder")[i]).css('border-color', color);
 			}
 			
 			var active_reminder = null;
 			$(".reminder").click(function(){
 			
 				if (active_reminder != null && $(this).attr('id') === active_reminder.attr('id')) {
 					$(".reminder").addClass('hide_reminder');
 					$(this).children('.reminder_description').slideUp('slow');
 					active_reminder = null;
 					
 				} else {
 				
 					$(".reminder").addClass('hide_reminder');
 					
 					if (active_reminder != null) {
 						$(active_reminder).children('.reminder_description').slideUp('slow');
 					}
 					
 					$(this).removeClass('hide_reminder');
 					$(this).children('.reminder_description').slideDown('slow');
 					active_reminder = $(this);
 				}
 			});
 			
 			$(".edit_button").click(function(){
 				var id = $(this).attr('id');
				window.location.replace("edit_reminder.php?reminder_id=" + id);//FIX
			});
		}
	
		$('#reminders').live('pageinit',function(event, ui){
			initialize_reminders();
			$('#reminder_container').sortable();
			$('#reminder_container').sortable().bind('sortupdate', function() {
    			for (var i=0; i < $("#reminder_container").children().length; i++) {
   		 			var id = parseInt($($("#reminder_container").children()[i]).attr('id'));
   		 			var order = i + 1;
   		 			$.ajax({
   						url: 'update_user_reminder_order',
   						type: 'POST',
   						data: {"id":id, "order":order},
   						success: function () {console.log("fun");}
					});
				}
			});
			$("#reminders_link").attr('href', '');
			$("#reminders_link").click(function(e) {
				e.preventDefault();
				window.location.replace("create_reminder.php");
			});
		});
	</script>
	<?php
		include 'header.html';
	?>

	<div data-role="content">
		<div id="reminder_container">
			<?php
				include("pfConfig.php");
				$User_ID = $_SESSION['user_id'];
				$query = sprintf("SELECT * FROM Reminders WHERE User_ID = '$User_ID' ORDER BY User_Priority");
				$result = mysql_query($query);
				$count = 0;
				
				while ($reminder = mysql_fetch_assoc($result)) {
					echo "<div class='reminder hide_reminder' id='".$reminder["Reminder_ID"]."'>".
						$reminder["Name"].
						"<div class='reminder_description'>".
							$reminder["Notes"].
							"<div class='edit_button' id='".$reminder["Reminder_ID"]."'>Edit Reminder</div>".
						"</div>".
					"</div>";
				}
			?>
		</div>
	</div><! -- /content -->
	
	<?php
	include 'footer.html';
	?>
</div> <!-- /tasks home -->

<?php
	include 'bottom_boilerplate.html';
?>