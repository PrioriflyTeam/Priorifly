<?php
	session_start();
	session_destroy();
	include 'top_boilerplate.html';
?>

<div data-role="page" id="logout">
	<script type="text/javascript">
		$('#logout').live('pagebeforeshow',function(event, ui){
 			//alert("login");
 			$('body').css('background-color', 'white');
		});
	</script>
	<div data-role="header"></div><!-- /header -->

	<div data-role="content">
		<p>Okay, you have been logged out!  Click below to log in.</p>
		<a href="index.php" data-role="button" data-theme="e">Home</a>
	</div><! -- /content -->
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false"></div>

</div> <!-- /logout -->

<?php
	include 'bottom_boilerplate.html';
?>
