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

<div data-role="page" id="create_page">
	<div data-role="header" class="home_header">
		<h1>Create</h1>
	</div><!-- /header -->

	<div data-role="content">	
		
		<form action="save_data.php" method="post" id="create_form">
			<div data-role="fieldcontain" id="create_title">
    			<label for="title">Title</label>
   				<input type="text" name="title" value=""  />
			</div>
			<div data-role="fieldcontain" id="task_or_event">
				<fieldset data-role="controlgroup">
				<legend>Is this a task or event?</legend>
     			<input type="radio" name="radio-choice" id="radio-choice-1" value="choice-1" checked="checked" />
     			<label for="radio-choice-1">Task</label>

     			<input type="radio" name="radio-choice" id="radio-choice-2" value="choice-2"  />
     			<label for="radio-choice-2">Event</label>

				</fieldset>
			</div>
			<div data-role="fieldcontain" id="progress_bar">
				<label for="slider-fill">Input slider:</label>
				<input type="range" name="slider-fill" id="slider-fill" value="60" min="0" max="100" data-highlight="true" />
			</div>
			<p><a href="tasks.php" data-role="button" id="login_show_btn">Cancel</a></p>
			<input type="submit" value="Save" id="save_btn">	
		</form>
		
		
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
	</div>
</div>

	<script type="text/javascript">
		
		$('#create_page').live( 'pageinit',function(event){
			);
		});
	</script>
	
</div>
</body>
</html>