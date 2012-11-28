<?php
	include 'top_boilerplate.html';
?>

<div data-role="page" class="signup">
	<script type="text/javascript">
		function signup_init() {
			$("#header_text").text("Sign Up");
			$(".signup_success").hide()
			$(".signup_notification").hide();
			$("#signup_form_container").show();
			$("input").val("")
			$('a').removeClass('ui-link');
			$(".notifications_link").hide();
 			$('body').css('background-image', 'url(images/background_scaled.jpg)');
		}
		
		function signup_error(text) {
			$(".signup_notification").text(text);
			$(".signup_notification").slideDown('slow').delay(3000).slideUp('slow');
		}
		
		function email_used(email) {
			var email_used = true;
			$.ajax({
            	url: 'validate_email',
   				type: 'POST',
   				async: false,
   				data: {"email":email},		
   				success: function(data) {
   					if (data == 'false') email_used = false;
   					else email_used = true;
   				}			
            });
            return email_used;
		}
	
	
		$('.signup').live('pagebeforeshow',function(event) {
			signup_init();
			
			var mailformat = /^([\w!.%+\-])+@([\w\-])+(?:\.[\w\-]+)+$/;
			
			$(".signup_submit_btn").click(function() {
				if (email.value == "") {
					signup_error("Email can't be blank.");
				} else if (signup_password.value == "") {
					signup_error("Password can't be blank.");
				} else if (retype_password.value == "") {
					signup_error("Retype your password!");
				} else if(signup_password.value != retype_password.value) {
                	signup_error("Passwords must match.");
                } else if(signup_password.value.length < 6) {
                	signup_error("Password must be > 5 characters!");
                } else if (!mailformat.test(email.value)) {
                	signup_error("Email is not of valid format.");
                } else if (!email_used(email.value)) {
                	signup_error("That email already exists!");
                } else {
                	$.ajax({
            			url: 'pfSignUpSubmit',
   						type: 'POST',
   						data: {"email":email.value, "password":signup_password.value, "retype_password":retype_password.value},		
   						success: function(data) {
   							$("#signup_form_container").slideUp('slow');
   							$(".signup_success").slideDown('slow');
   						}			
            		});
                }
			});
			
        });               
	</script>
	<?php
		include 'header.html';
	?>

	<div data-role="content">
		<h1 class="home_priorifly_logo">Sign Up!</h1>
		<div id="signup_form_container">
			<form id="signup_form" action="" method="post" data-theme="e" class="validate">
				<div data-role="fieldcontain" class="ui-hide-label" id="email_field">
					<input type="text" name="email" id="email" value="" placeholder="Email" class='required'/>
				</div>
				<div data-role="fieldcontain" class="ui-hide-label" id="signup_password_field">
					<input type="password" name="signup_password" id="signup_password" value="" placeholder="Password" class='required'/>
				</div>
				<div data-role="fieldcontain" class="ui-hide-label" id="retype_password_field">
					<input type="password" name="retype_password" id="retype_password" value="" placeholder="Retype Password" class='required'/>
				</div>
				<div class="signup_notification">Error</div>		
				<div class="signup_submit_btn">Sign Up</div>		
			</form>
		</div>
		<div class="signup_success"><a id="signup_success_link" href="tasks.php">
			You're all signed up and logged in!  Click here to get started!
		</a></div>	
	</div><! -- /content -->
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false"></div>
</div> <!-- /signup -->


<?php
	include 'bottom_boilerplate.html';
?>