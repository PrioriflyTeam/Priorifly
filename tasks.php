<?php
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header("Location: sorry.php");
	} else {
		include 'top_boilerplate.html';
	}
    ?>

<div data-role="page" id="tasks">
<script type="text/javascript">
$('#tasks').live('pagebeforeshow',function(event, ui){
                 $('.task_description').hide();
                 $("#tasks_link").css('background-color', '#00DFFC');
                 $("#reminders_link").css('background-color', '#008C9E');
                 $('body').css('background-color', 'white');
                 var tasks = $(".task");
                 for (var i = 0; i < $(".task").length; i++) {
                 var color = "black";
                 if (i % 5 == 0) color = "#C44D58";
                 else if (i % 5 == 1) color = "#FF6B6B";
                 else if (i % 5 == 2) color = "#C7F464";
                 else if (i % 5 == 3) color = "#4ECDC4";
                 else if (i % 5 == 4) color = "#556270";
                 $($(".task")[i]).css('border-color', color);
                 }
                 
                 $(".task").click(function(){
                                  $('.task_description').hide();
                                  $(".task").addClass('hide_task');
                                  $(this).removeClass('hide_task');
                                  $(this).children('.task_description').show();
                                  });
                 
                 $(".edit_button").click(function(){
                                         window.location.replace("edit_task.php?task_id=" + $(this).attr('id'));
                                         });
                 });
</script>
<?php
    include 'header.html';
	?>

<div data-role="content">
<div id="upper_container">
<div id="date_holder">
<a id="prev_btn" data-role="button" data-icon="arrow-l" data-iconpos="notext" data-theme="e"></a>
<div id="date">10/31/12</div>
<a id="fwd_btn" data-role="button" data-icon="arrow-r" data-iconpos="notext" data-theme="e"></a>
</div>
</div>
<div id="task_container">
<?php
    include("pfConfig.php");
    $User_ID = $_SESSION['user_id'];
    $query = sprintf("SELECT * FROM Tasks WHERE User_ID = '$User_ID' and Status = 3"); //add user id clause later
    $result = mysql_query($query);
    $count = 0;
    echo "<p>Session ID: ".$_SESSION['user_id']."</p>";
    while ($task = mysql_fetch_assoc($result)) {
        $count++;
        $progress = $task["Progress"];
        $task_id = $task["Task_ID"];
        echo "<div class='task hide_task'>".
        $count." ".
        $task["Name"].
        "<div class='task_description'>".
        $task["Notes"].
        "<form action='pfEditTask.php' method='post'>".
        "<input type='hidden' name='id' value='$task_id'>".
        "<input type='range' name='progress' id='progress' value='$progress'min='0' max='100' data-highlight='true' />".
        "<input class='submit' type='submit' value='Update My Progress'>".
        "</form>".
        "<div class='edit_button' id='$task_id'>Edit Task</div>".
        "</div>".
        "</div>";
    }
    ?>
</div>
</div><! -- /content -->
<?php
	include 'footer.html';
	?>
</div> <!-- /tasks home -->

<?php
	include 'bottom_boilerplate.html';
    ?>