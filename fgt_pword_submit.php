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

		<div class="orderarea">
		<?php
		
			include("pfConfig.php");
			function sendmail($email)
			{
			    

			    $query = sprintf("SELECT Digest FROM Users WHERE Email = '$email'");
			    $result = mysql_query($query);
			   	$rowCheck = mysql_num_rows($result);
			   	if ($rowCheck > 0) {
					$row = mysql_fetch_assoc($result);
					$password = $row["Digest"];
					$to      = $email;
			   	 	$subject = 'Priorifly Password';
			    	$message = "Yo homie. Try to remember your password next time. Your password is $password.";
			    	$headers = '';
			    	mail($to, $subject, $message, $headers);
			    	echo "<p>You should be receiving an email shortly.</p>";
				} else {
			    	echo "<p>That was not a valid email.</p>";
				}
			    

			}
			
			// Take in parameters

			$email = $_POST["email"];
			$t = time();
			
			// Insert into orders

			sendmail($email);

			
			
			?>
		</div>
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false"></div>
</div> <!-- /signup -->

<?php
	include 'bottom_boilerplate.html';
?>