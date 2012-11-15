<?php
	include 'top_boilerplate.html';
?>

<div data-role="page" id="signup">
	<script type="text/javascript">
		$('#signup').live('pagebeforeshow',function(event, ui){
 			//alert("signup");
 			$('body').css('background-color', '#556270');
		});

$('#signup').live('pageinit',function(event) {
		$('body').css('background-color', '#556270');
                       $("#signup_form").submit(function() {
                          
                          
                          // get a collection of all empty fields
                          var emptyFields = $(":input.required").filter(function() {
                                                                        
                            // $.trim to prevent whitespace-only values being counted as 'filled'
                            return !$.trim(this.value).length;
                            });
                          
                          // if there are one or more empty fields
                          if(emptyFields.length) {
                          
                          // do stuff; return false prevents submission
                          emptyFields.css("border", "1px solid red");   
                          alert("You must fill all fields!");
                          return false;
                          }
                          var email_address = email.value;
                          var mailformat = /^([\w!.%+\-])+@([\w\-])+(?:\.[\w\-]+)+$/;
                          if (mailformat.test(email_address) == false) {
                          	 alert("Email is not of valid format.");
                          	return false;
                          } 
                          console.log(password.value);
                          console.log(retype_password.value);
                          if(password.value != retype_password.value) {
                           alert("Passwords must match!");
                          return false;
                          }
                          if(password.value.length < 6) {
                          	 alert("Password must be at least 6 characters!");
                          	return false;
                          }
                          var valid = true;
                           $.ajax({
                           		
   								url: 'validate_email',
   								type: 'POST',
   								async: false,
   								data: {"email":email_address},
   							
   								success: function(data) {
   									if (data == 'false') {
   										alert("The email already exists!");
   										valid = false;
   									}
   								}
   								
                       		});
                       		
                       		return valid;

							
                          
                          });
                          });
                       

	</script>
	<div data-role="header" data-theme="b">
		<a href="index.php" data-icon="back" data-theme="b">Back</a>
		<h1>Sign Up</h1>
	</div>

	<div data-role="content">
		<div id="signup_form_container">
			<div id="signup_logo_container">
				<img id="signup_logo_img" src="images/signup_logo_1.png" alt="logo" />
			</div>
			<form id="signup_form" action="pfSignUpSubmit.php" method="post" data-theme="e" class="validate">
				<div data-role="fieldcontain" class="ui-hide-label" id="email_field">

					<input type="text" name="email" id="email" value="" placeholder="Email" class='required'/>
				</div>
				<div data-role="fieldcontain" class="ui-hide-label" id="password_field">

					<input type="password" name="password" id="password" value="" placeholder="Password" class='required'/>
				</div>
				<div data-role="fieldcontain" class="ui-hide-label" id="retype_password_field">

					<input type="password" name="retype_password" id="retype_password" value="" placeholder="Retype Password" class='required'/>
				</div>		
				<input id="signup_submit_btn" type="submit" value="Sign Up" data-role="button" data-theme="e" />			
			</form>
		</div>
	</div><! -- /content -->
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false"></div>
</div> <!-- /signup -->


<?php
	include 'bottom_boilerplate.html';
?>