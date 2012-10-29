<!DOCTYPE html> 
<html>

<head>
	<title>Priorifly</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="jquery.mobile-1.2.0.css" />

	<link rel="stylesheet" href="home_styles.css" />
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>
</head> 

	
<body> 

	<script type="text/javascript">
		function hideForms() {
			$("#login_form").hide();
			$("#fgt_pword_form").hide();
			$("#signup_form").hide();
		}
		
		function showButtons() {
			$("#login_show_btn").show();
			$("#fgt_password_show_btn").show();
			$("#signup_show_btn").show();
		}
		
		function refreshButtons(btn) {
			showButtons();
			$(btn).hide();
			hideForms();
		}
		
		$(document).bind('pageinit', function() {
			//alert("hi");
			showButtons();
			hideForms();
			$("#login_show_btn").click(
				function(e) {
					refreshButtons(this);
					$("#login_form").show('slow');
				}
			);
			$("#fgt_password_show_btn").click(
				function(e) {
					refreshButtons(this);
					$("#fgt_pword_form").show('slow');
				}
			);
			
			$("#signup_show_btn").click(
				function(e) {
					refreshButtons(this);
					$("#signup_form").show('slow');
				}
			);
		});
	</script>


<div data-role="page" id="home_page">
	<div data-role="header" class="home_header">
		<a href="about.php" data-role="button" id="about_btn">About Us</a>	
		<h1>Priorifly</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<div class="home_img_container">
			<img src="priorifly.jpg" alt="home_img" id="home_img"/>
		</div>
		
		<!-- LOG IN -->
		<form action="login.php" method="post" id="login_form" style="display:none">
			<div data-role="fieldcontain" id="login_username">
    			<label for="username">Username:</label>
   				<input type="text" name="username" value=""  />
			</div>	
			<div data-role="fieldcontain" id="login_password">
    			<label for="password">Password:</label>
    			<input type="password" name="password" value="" />
			</div>	
       		<input type="submit" value="Log In" data-theme="e" id="login_submit">
		</form>
		<p><a href="#" data-role="button" id="login_show_btn">Log In</a></p>
		
		<!-- FORGOT PASSWORD -->
		<form action="fgt_pword.php" method="post" id="fgt_pword_form" style="display:none">
			<div data-role="fieldcontain" id="login_username">
    			<label for="name">Email:</label>
   				<input type="text" name="email" value=""  />
			</div>	
       		<input type="submit" value="Forgot Password?" data-theme="e" id="fgt_pword_submit">
		</form>
		<p><a href="#" data-role="button" id="fgt_password_show_btn">Forgot Password?</a></p>
		
		<!-- SIGN UP-->
		<form action="signup.php" method="post" id="signup_form" style="display:none">
			<div data-role="fieldcontain" id="signup_username">
    			<label for="name">Username:</label>
   				<input type="text" name="email" value=""  />
			</div>
			<div data-role="fieldcontain" id="signup_password">
    			<label for="password">Password:</label>
    			<input type="password" name="password" value="" />
			</div>	
       		<input type="submit" value="Sign Up" data-theme="e" id="signup_submit">
		</form>
		<p><a href="#" data-role="button" id="signup_show_btn">Sign Up</a></p>	
		
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
	</div>
</div>
</div>
</body>
</html>