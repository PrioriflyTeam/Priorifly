<?php
	include 'top_boilerplate.html';
	session_unset(); 
?>



<div data-role="page" id="login">
	<script type="text/javascript">
		$('#login').live('pagebeforeshow',function(event, ui){
 			//alert("login");
 			$('body').css('background-color', '#556270');
		});
	</script>
	<div data-role="header"></div><!-- /header -->

	<div data-role="content">
		<div id="home_logo_container">
			<img id="home_logo" src="images/priorifly_logo.png" alt="logo" />
		</div>
		
		<div id="login_container">
			<form id="login_form" action="submit" method="post" data-theme="e">
				<div data-role="fieldcontain" class="ui-hide-label" id="username_field">
					<input type="text" name="email" id="username" value="" placeholder="Email"/>
				</div>
				<div data-role="fieldcontain" class="ui-hide-label" id="password_field">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" value="" placeholder="Password"/>
				</div>	
				<input id="login_submit_btn" type="submit" value="Log In" data-role="button" data-theme="e"/>			
			</form>
		</div>
		
		<div id="forgot_pword_link_container">
			<a href="forgot_pword.php" id="forgot_pword_link">Forgot your password?</a>
		</div>
		
		<div id="signup_link_container">
			<a id="signup_link" href="signup.php" data-role="button" data-theme="b" data-inline="true">Sign Up</a>
		</div>
		
	</div><! -- /content -->
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false"></div>

</div> <!-- /login -->

<?php
	include 'bottom_boilerplate.html';
?>
