<?php
	session_start();
    include 'top_boilerplate.html';
?>

<div data-role="page" id="create_page">
	<div data-role="header" class="home_header">
		<h1>Edit Reminder</h1>
	</div><!-- /header -->

	<div data-role="content">	


<?php
    $var = $_SESSION['user_id'];
    $test = $_SESSION['test'];
    $Task_ID = $_GET['task_id'];
    
    include("pfConfig.php");
    $query = sprintf("SELECT * FROM Reminders WHERE Reminder_ID = '$Task_ID' AND Status = 2");
    $result = mysql_query($query);
    $reminder = mysql_fetch_assoc($result);
    
    $name = $reminder["Name"];
    $description = $reminder["Notes"];
?>

<form action="pfRemoveReminderSubmit.php" method="post" id="delete_form">
<a href="#deletepage" data-role="button" data-rel="dialog" data-icon="delete" id="deletepopup">Delete</a><div data-role="popup" id="deletepopup"></div>
</form>

		<form action="pfEditReminderSubmit.php" method="post" id="create_form" validate="validate">
			<div data-role="fieldcontain" id="create_title">
    			<label for="title">Name</label>
   				<?php echo "<input type='text' class='required' name='name' value='".$name."'/>";?>
			</div>
            <div data-role="fieldcontain">
                <label for="textarea">Description</label>
                <?php echo "<textarea name='description' id='textarea'>".$description."</textarea>";?>
            </div>
            <div data-role="fieldcontain">
            <?php echo "<input type='hidden' name='reminder_id' value='".$Task_ID."'";?>
            </div>
			<a href="#cancelpage" data-role="button" data-rel="dialog" id="login_show_btn">Cancel</a><div data-role="popup" id="cancelpopup"></div>
			<input type="submit" value="Save" id="save_btn">	
		</form>
		
		
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
	</div>
</div>

<script type="text/javascript">

$('#create_page').live('pageinit',function(event) {
                       
                       $("#create_form").submit(function() {
                                                
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
                                                });
                       
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
<a href="#create_page" data-role="button">Stay on this page</a></div>
<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
</div></div>

<div data-role="page" id="deletepage" data-title="delete">
<div data-role="header" class="home_header">
<h1>Delete</h1>
</div><!-- /header -->
<h3>Are you sure you want to delete this reminder?</h3>
<div data-role="content">
<form action="pfRemoveReminderSubmit.php" method="post" id="delete_form">
<div data-role="fieldcontain">
<?php echo "<input type='hidden' name='reminder_id' value='".$Task_ID."'";?>
</div>
<input type="submit" value="Delete" id="delete_btn">
</form>
<a href="#create_page" data-role="button">Do Not Delete</a></div>

<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
</div></div>

<?php
	include 'bottom_boilerplate.html';
?>