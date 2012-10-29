<?php
	include 'top_boilerplate.html';
?>

<div data-role="page" id="fgt_pword">
	<script type="text/javascript">
		$('#fgt_pword').live('pagebeforeshow',function(event, ui){
 			//alert("signup");
 			$('body').css('background-color', '#556270');
		});
	</script>
	<div data-role="header" data-theme="b">
		<a href="home.php" data-icon="back" data-theme="b">Back</a>
		<h1 id="forgot_password_h1">Password</h1>
	</div>

	<div data-role="content">
		<div id="fgt_pword_form_container">
			<div id="fgt_pword_logo_container">
				<img id="fgt_pword_logo_img" src="images/fgt_pword_logo_1.png" alt="logo" />
			</div>
			<form id="fgt_pword_form" action="#" method="post" data-theme="e">
				<div data-role="fieldcontain" class="ui-hide-label" id="email_field">
					<label for="email">Email:</label>
					<input type="text" name="email" id="email" value="" placeholder="Email"/>
				</div>	
				<input id="fgt_pword_submit_btn" type="submit" value="Email Password" data-role="button" data-theme="e"/>			
			</form>
		</div>
	</div><! -- /content -->
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false"></div>
</div> <!-- /signup -->

<?php
	include 'bottom_boilerplate.html';
?>