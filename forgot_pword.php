<?php
	include 'top_boilerplate.html';
?>

<div data-role="page" class="fgt_pword">

	<script type="text/javascript">
		function fgt_pword_init() {
			$("#header_text").text("Password");
			$(".forgot_password_success").hide();
			$(".fgt_pword_notification").hide();
			$("#fgt_pword_form_container").show();
			$("input").val("")
			$('a').removeClass('ui-link');
			$(".notifications_link").hide();
 			$('body').css('background-image', 'url(images/background_scaled.jpg)');
		}
	
		$('.fgt_pword').live('pagebeforeshow',function(event, ui){
			
			fgt_pword_init();
 			
 			$(".forgot_password_submit_btn").click(function() {
 				
 				if (fgt_email.value == "") {
 					$(".fgt_pword_notification").text("The e-mail field can't be blank!");
					$(".fgt_pword_notification").slideDown('slow');
				} else {
 			
 					$.ajax({
          				url: 'fgt_pword_submit',
						type: 'POST',
						data: {"email":fgt_email.value},
						success: function(data) {
							if (data == 'false') {
								$(".fgt_pword_notification").text("That e-mail does not exist");
								$(".fgt_pword_notification").slideDown('slow').delay(3000).slideUp('slow');
							} else {
								$("#fgt_pword_form_container").slideUp('slow');
								$(".forgot_password_success").slideDown('slow');
							}
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
		<h1 class="home_priorifly_logo">Password</h1>
		<div id="fgt_pword_form_container">
			<form id="fgt_pword_form" action="" method="post" data-theme="e">
				<div data-role="fieldcontain" class="ui-hide-label" id="email_field">
					<label for="fgt_email">Email:</label>
					<input type="text" name="fgt_email" id="fgt_email" value="" placeholder="Email"/>
				</div>
				<div class="fgt_pword_notification"></div>	
				<div class="forgot_password_submit_btn">E-mail Password</div>	
			</form>
		</div>
		<div class="forgot_password_success"><a id="forgot_password_success_link" href="index.php">
			Your password has been e-mailed to you!  Click here to go back.
		</a></div>	
		
	</div><! -- /content -->
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false"></div>
</div> <!-- /signup -->

<?php
	include 'bottom_boilerplate.html';
?>