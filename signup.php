<?php
	include 'top_boilerplate.html';
?>

<div data-role="page" id="signup">
	<script type="text/javascript">
		$('#signup').live('pagebeforeshow',function(event, ui){
 			//alert("signup");
 			$('body').css('background-color', '#556270');
		});
	</script>
	<div data-role="header" data-theme="b">
		<a href="home.php" data-icon="back" data-theme="b">Back</a>
		<h1>Sign Up</h1>
	</div>

	<div data-role="content">
		<div id="signup_form_container">
			<div id="signup_logo_container">
				<img id="signup_logo_img" src="images/signup_logo_1.png" alt="logo" />
			</div>
			<form id="signup_form" action="pfSignUpSubmit.php" method="post" data-theme="e">
				<div data-role="fieldcontain" class="ui-hide-label" id="email_field">
					<label for="email">Email:</label>
					<input type="text" name="email" id="email" value="" placeholder="Email"/>
				</div>
				<div data-role="fieldcontain" class="ui-hide-label" id="password_field">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" value="" placeholder="Password"/>
				</div>
				<div data-role="fieldcontain" class="ui-hide-label" id="retype_password_field">
					<label for="password">Retype Password:</label>
					<input type="password" name="retype_password" id="retype_password" value="" placeholder="Retype Password"/>
				</div>		
				<input id="signup_submit_btn" type="submit" value="Sign Up" data-role="button" data-theme="e"/>			
			</form>
		</div>
	</div><! -- /content -->
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false"></div>
</div> <!-- /signup -->

<?php
	include 'bottom_boilerplate.html';
?>