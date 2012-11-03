<?php
	session_start();
	include 'top_boilerplate.html';
?>

<div data-role="page" id="reminders">
	<script type="text/javascript">
		$('#reminders').live('pagebeforeshow',function(event, ui){
 			$("#reminders_link").css('background-color', '#00DFFC');
 			$("#tasks_link").css('background-color', '#008C9E');
 			$('body').css('background-color', 'white');
 			var tasks = $(".reminder");
 			for (var i = 1; i < $(".reminder").length; i++) {
 				var color = "black";
 				if (i % 5 == 0) color = "#C44D58"; 
 				else if (i % 5 == 1) color = "#FF6B6B";
 				else if (i % 5 == 2) color = "#C7F464";
 				else if (i % 5 == 3) color = "#4ECDC4";
 				else if (i % 5 == 4) color = "#556270";
 				$($(".reminder")[i]).css('border-color', color);
 			}
 			$($(".reminder")[0]).css('border-color', 'white');
 			
 			$('.reminder_description').hide();
 			
 			$(".reminder").click(function(){
 				$('.reminder_description').hide();
 				$(".reminder").addClass('hide_reminder');
 				$(this).removeClass('hide_reminder');
 				$(this).children('.reminder_description').show();
 			});
 			
 			$(".edit_button").click(function(){
			
			window.location.replace("create_reminder.php");
			});
		});
	</script>
	<?php
		include 'reminder_header.html';
	?>

	<div data-role="content">
		<div id="reminder_container">
			<?php
				include("pfConfig.php"); //put Alejandro's config file here
				$User_ID = $_SESSION['user_id'];
				$query = sprintf("SELECT * FROM Reminders WHERE User_ID = '$User_ID'"); //put query here
				$result = mysql_query($query);
				$count = 0;
				
				while ($reminder = mysql_fetch_assoc($result)) {
					echo "<div class='reminder hide_reminder'>".
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