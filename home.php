<?php
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header("Location: index.php");
	} else {
		include 'top_boilerplate.html';
	}
?>

<div data-role="page" id="home">
	<script type="text/javascript">
		$('#home').live('pagebeforeshow',function(event, ui){
 			$('body').css('background-image', 'url(images/home_backround.jpg)');
 			$("#go_to_tasks_button").click(function() {
 				window.location.href = "tasks.php";
 			});
 			$("#logout_button").click(function() {
 				window.location.href = "logout.php";
 			});
		});
	</script>
	<div data-role="header"></div><!-- /header -->

	<div data-role="content">
		<h1 class="home_priorifly_logo">Priorifly</h1>
		
		<div id="go_to_tasks_button">My Tasks</div>
		<div id="logout_button">Logout</div>
		<p style="text-align:center; padding-top:40px">
			<a href="about.php" id="about_us_link">About Us</a>
			<span class="hyphen">-</span>
			<a href="contact.php" id="contact_link">Contact Us</a>
		</p>
		
	</div><! -- /content -->
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false"></div>

</div> <!-- /home -->

<?php
	include 'bottom_boilerplate.html';
?>
