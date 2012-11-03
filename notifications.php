<?php
	include 'top_boilerplate.html';
?>

<div data-role="page" id="notifications">
	<script type="text/javascript">
		$('#notifications').live('pagebeforeshow',function(event, ui){
 			$("#tasks_link").css('background-color', '#008C9E');
 			$("#reminders_link").css('border-left', '1px solid white');
			$("#reminders_link").css('background-color', '#008C9E');
 			$('body').css('background-color', 'white');
		});
	</script>
	<?php
		include 'header.html';
	?>

	<div data-role="content">
		<div id="notifications_list">
			<!--dynamically created tasks by fetching data from database
			<?php
				include("config.php"); //put Alejandro's config file here
				$query = sprintf("SELECT * FROM data"); //put query here
				$result = mysql_query($query);
				$count = 0;
				while ($row = mysql_fetch_assoc($result)) {
					$count++;
					echo "<div class='task'>".$count." ".$row["COLUMN"]."</div>";
				}
			?>
			-->
			<p class="notification">Here are some notifications about something</p>
			<p class="notification">Here are some notifications about something</p>
			<p class="notification">Here are some notifications about something</p>
			<p class="notification">Here are some notifications about something</p>
			<p class="notification">Here are some notifications about something</p>
			<p class="notification">Here are some notifications about something</p>
			<p class="notification">Here are some notifications about something</p>
			<p class="notification">Here are some notifications about something</p>
			<p class="notification">Here are some notifications about something</p>
			<p class="notification">Here are some notifications about something</p>
		</div>
	</div><! -- /content -->
	
	<?php
	include 'footer.html';
	?>
</div> <!-- /tasks home -->

<?php
	include 'bottom_boilerplate.html';
?>