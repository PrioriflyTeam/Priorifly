<?php
	session_start();
	include 'top_boilerplate.html';
    
?>
<div data-role="page" id="create_page">
	<?php
        include 'header.html';
    ?>
    
<script type="text/javascript">

$('#cancelpage').live('pageinit', function(event) {
                      $("#cancelpage").css({ opacity: 1 });
                      });

$('#create_page').live('pageinit',function(event) {
                       $(function() {
                         $('div[data-role="dialog"]').live('pagebeforeshow', function(e, ui) {
                                                           ui.prevPage.addClass("ui-dialog-background ");
                                                           });
                         
                         $('div[data-role="dialog"]').live('pagehide', function(e, ui) {
                                                           $(".ui-dialog-background ").removeClass("ui-dialog-background ");
                                                           });
                         });
                       
      $("#header_text").text("Create Task");
    	$(".notifications_link").click(function() {
			window.location.replace("tasks.php");
		});
		$trash_icon = $("#create_page").find('.notifications_link_img');
		$trash_icon.attr('src', 'images/priorifly_icons/179-notepad.png');
		$trash_icon.css('margin-top', '-5px');
		$trash_icon.css('height', '26px');
    
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

	<div data-role="content">	
		<form action="pfTaskSubmit.php" method="post" id="create_form" class="validate">
			<div data-role="fieldcontain" id="create_title">
    			<label for="title" id="titlelabel">Name</label>
   				<input type="text" name="name" id="title" class="required" value=""  />
			</div>
            <div data-role="fieldcontain">
                <label for="textarea" id="textarealabel">Description</label>
                <textarea name="description" id="textarea"></textarea>
            </div>
            <div data-role="fieldcontain">
                <label for="datetime" id="datetimelabel">Deadline</label>
                <input type="datetime" name="deadline" class="required" id="deadline">
            </div>
			<div data-role="fieldcontain">
				<label for="rank" id="ranklabel">Rank</label>
				<input type="range" name="rank" id="rank" class="required" value="5" min="1" max="10" data-highlight="true" />
                <span class="slider_left">1</span>
                <span class="slider_right">10</span>
			</div>
            <div data-role="fieldcontain">
                <label for="progress" id="progresslabel">Progress</label>
                <input type="range" name="progress" id="progress" class="required"value="0" min="0" max="100" data-highlight="true" />
                <span class="slider_left">0%</span>
                <span class="slider_right">100%</span>
            </div>
            <div data-role="fieldcontain">
                <label for="number" id="timelabel">Time Estimate</label>
                <table>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>
                <input type="number" name="hours" class="required" id="number"></td>
                <td>
                <label for="number" id="hourslabel">hours</label></td></table>
            </div>
            <input type="submit" value="Save" id="save_btn">	
			<a href="#cancelpage" data-role="button" data-rel="dialog" id="login_show_btn">Cancel</a><div data-role="popup" id="cancelpopup"></div>
            
		</form>
		
		
	</div><!-- /content -->
    <div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
    </div>

</div>

<div data-role="page" id="cancelpage" data-overlay-theme="c" data-title="cancel?">
    <div id="#cancel_msg" class="cancelmsg">Are you sure you want to leave this page? Any changes you have made to this page will not be saved.</div>
    <div data-role="content">
        <a href="tasks.php" data-role="button">Leave</a>
        <a href="#create_page" data-role="button">Stay on this page</a>
    </div>
</div>
<?php
	include 'bottom_boilerplate.html';
?>