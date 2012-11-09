<?php
	include 'top_boilerplate.html';
?>

<div data-role="page" id="create_page">
	<div data-role="header" class="home_header">
		<h1>Create Reminder</h1>
	</div><!-- /header -->

	<div data-role="content">	
		
		<form action="pfReminderSubmit.php" method="post" id="create_form">
			<div data-role="fieldcontain" id="create_title">
    			<label for="title">Name</label>
   				<input type="text" name="name" value=""  />
			</div>
            <div data-role="fieldcontain">
                <label for="textarea">Description</label>
                <textarea name="description" id="textarea"></textarea>
            </div>
			<a href="#cancelpage" data-role="button" data-rel="dialog" id="login_show_btn">Cancel</a><div data-role="popup" id="cancelpopup"></div>
			<input type="submit" value="Save" id="save_btn">	
		</form>
		
		
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
	</div>

	<script type="text/javascript">
		
		$('#create_page').live( 'pageinit',function(event){
			);
		});
	</script>

</div>

<div data-role="page" id="cancelpage" data-title="Are you sure you want to cancel?">
<div data-role="header" class="home_header">
<h1>Cancel</h1>
</div><!-- /header -->
<h3>Are you sure you want to leave this page? Any changes you have made to this page will not be saved.</h3>
<div data-role="content">
<a href="reminders.php" data-role="button">Leave</a>
<a href="#create_page" data-role="button">Stay on this page</a>

<?php
	include 'bottom_boilerplate.html';
?>