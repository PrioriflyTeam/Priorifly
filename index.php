<?php
	include 'top_boilerplate.html';
?>

<div data-role="page" id="login">
	<script type="text/javascript">
		$('#login').live('pagebeforeshow',function(event, ui){
 			$('body').css('background-color', '#556270');
		});
		$('#login').live('pageinit',function(event) {
                       $("#login_form").submit(function() {
                          
                          
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
                          
                          var email_address = username.value;
                           //console.log(email_address);
						  var password_value = password.value;
                         
                          //console.log(password_value);
                          var valid = true;
                           $.ajax({
                           		
   								url: 'validate_login',
   								type: 'POST',
   								async: false,
   								data: {"email":email_address, "password":password_value},
   							
   								success: function(data) {
   									if (data == 'false') {
   										alert("Incorrect login!");
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
		<div id="home_logo_container">
			<img id="home_logo" src="images/priorifly_logo.png" alt="logo" />
		</div>
		
		<div id="login_container">
			<form id="login_form" action="submit.php" method="post" data-theme="e">
				<div data-role="fieldcontain" class="ui-hide-label" id="username_field">
					<input type="text" name="email" id="username" value="" placeholder="Email" class = 'required'/>
				</div>
				<div data-role="fieldcontain" class="ui-hide-label" id="password_field">
					<input type="password" name="password" id="password" value="" placeholder="Password" class = 'required'/>
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
