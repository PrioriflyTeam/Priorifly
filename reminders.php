<?php
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header("Location: sorry.php");
	} else {
		include 'top_boilerplate.html';
	}
?>

<div data-role="page" id="reminders">
	<script type="text/javascript">
		$('#reminders').live('pageinit',function(event, ui){
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
				$query = sprintf("SELECT * FROM Reminders WHERE User_ID = '$User_ID'");
				$result = mysql_query($query);
				$count = 0;
				
				while ($reminder = mysql_fetch_assoc($result)) {
					echo "<div class='reminder hide_reminder' id='".$reminder["Reminder_ID"]."'>".
						$reminder["Name"].
						"<div class='reminder_description'>".
							$reminder["Notes"].
							"<div class='edit_button'>Edit Reminder</div>".
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