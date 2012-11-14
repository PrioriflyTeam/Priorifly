<?php
	session_start();
	include 'top_boilerplate.html';
    
?>
<div data-role="page" id="create_page">
	<?php
        include 'header.html';
    ?>

	<div data-role="content">	
		<?php
			$var = $_SESSION['user_id'];
			$test = $_SESSION['test'];
			//echo "<p>TEST: ".$test."</p>";
			//echo "<p>Session ID: ".$var."</p>";
		?>
		<form action="pfTaskSubmit.php" method="post" id="create_form" class="validate">
			<div data-role="fieldcontain" id="create_title">
    			<label for="title">Name</label>
   				<input type="text" name="name" class="required" value=""  />
			</div>
            <div data-role="fieldcontain">
                <label for="textarea">Description</label>
                <textarea name="description" id="textarea"></textarea>
            </div>
            <div data-role="fieldcontain">
                <label for="datetime">Deadline</label>
                <input type="datetime" name="deadline" class="required" id="datetime">
            </div>
			<div data-role="fieldcontain">
				<label for="rank">Rank</label>
				<input type="range" name="rank" id="rank" class="required" value="5" min="0" max="10" data-highlight="true" />
                <span class="slider_left">0</span>
                <span class="slider_right">10</span>
			</div>
            <div data-role="fieldcontain">
                <label for="progress">Progress</label>
                <input type="range" name="progress" id="progress" class="required"value="0" min="0" max="100" data-highlight="true" />
                <span class="slider_left">0</span>
                <span class="slider_right">100</span>
            </div>
            <div data-role="fieldcontain">
                <label for="number">Time Estimate in Hours</label>
                <input type="number" name="hours" class="required" id="number">
            </div>
            <input type="submit" value="Save" id="save_btn">	
			<a href="#cancelpage" data-role="button" data-rel="dialog" id="login_show_btn">Cancel</a><div data-role="popup" id="cancelpopup"></div>
            
		</form>
		
		
	</div><!-- /content -->
    <div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
    </div>
    <script type="text/javascript">

$('#create_page').live('pageinit',function(event) {
                       $("#header_text").text("Create Task");
                       
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
                                                if(number.value  <= 0) {
                                             	alert("Not a valid time estimate!");
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
        <a href="tasks.php" data-role="button">Leave</a>
        <a href="#create_page" data-role="button">Stay on this page</a>

	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
	</div>
</div>
<?php
	include 'bottom_boilerplate.html';
?>