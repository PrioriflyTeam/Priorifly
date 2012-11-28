<?php
	session_start();
	if (isset($_SESSION['user_id'])) {
		header("Location: tasks.php");
	}
	include 'top_boilerplate.html';	 
?>

<div data-role="page" class="login">
	<script type="text/javascript">
	$('.login').live('pageinit',function(event) {
		$('#login_form').hide();
		$('.login_submit_btn').show();
		$('body').css('background-image', 'url(images/background_scaled.jpg)');
		$('a').removeClass('ui-link');
		
		$(".login_submit_btn").click(function(){
			if ($(".login_notification_box").css('display') === 'block') {
				$(".login_notification_box").slideUp('slow');
			}
			if ($('#login_form').css('display') === 'none') {
				$('#login_form').slideDown('slow');
			} else $("#login_form").submit();
		});
		
		$("#login_form").submit(function() {
          var email_address = username.value;
	  	  var password_value = password.value;
	  	  
	  	  if (email_address == "" || password_value == "") {
	  	  	$(".login_notification_box").text("Fields can't be left blank!");
	  	  	$(".login_notification_box").slideDown('slow').delay(3000).slideUp('slow');
	  	  	return false;
	  	  }

      	  var valid = true;
          $.ajax({
          	url: 'validate_login',
			type: 'POST',
			async: false,
			data: {"email":email_address, "password":password_value},
			success: function(data) {
				if (data == 'false') {
					$(".login_notification_box").text("Incorrect login information!");
	  	  			$(".login_notification_box").slideDown('slow').delay(3000).slideUp('slow');
					valid = false;
				}
			}
		  });	
       	  return valid;
    	});
         
	});
	</script>
	<div data-role="header"></div><!-- /header -->

	<div data-role="content">
		<h1 class="home_priorifly_logo">Priorifly</h1>
		<form id="login_form" action="submit.php" method="post" data-theme="e">
			<div data-role="fieldcontain" class="ui-hide-label" id="username_field">
				<input type="text" name="email" id="username" value="" placeholder="Email"/>
			</div>
			<div data-role="fieldcontain" class="ui-hide-label" id="password_field">
				<input type="password" name="password" id="password" value="" placeholder="Password"/>
			</div>
			<div class="login_notification_box"></div>		
		</form>
		<div class="login_submit_btn">Log In</div>	
		<div class="signup_btn"><a id="signup_link" href="signup.php">Sign Up</a></div>	
		
		<div class="forgot_password_btn"><a id="forgot_password_link" href="forgot_pword.php">Forgot Your Password?</a></div>	

	</div><! -- /content -->
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false"></div>

</div> <!-- /login -->

<?php
	include 'bottom_boilerplate.html';
?>
