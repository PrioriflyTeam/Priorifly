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
		<h1>Create Task</h1>
	</div><!-- /header -->

	<div data-role="content">	
		
		<form action="pfTaskSubmit.php" method="post" id="create_form">
			<div data-role="fieldcontain" id="create_title">
    			<label for="title">Name</label>
   				<input type="text" name="name" value=""  />
			</div>
            <div data-role="fieldcontain">
                <label for="textarea">Description</label>
                <textarea name="description" id="textarea"></textarea>
            </div>
            <div data-role="fieldcontain">
                <label for="datetime">Deadline</label>
                <input type="datetime" name="deadline" id="datetime">
            </div>
			<div data-role="fieldcontain">
				<label for="rank">Rank</label>
				<input type="range" name="rank" id="rank" value="5" min="0" max="10" data-highlight="true" />
                <span class="slider_left">0</span>
                <span class="slider_right">10</span>
			</div>
            <div data-role="fieldcontain">
                <label for="progress">Progress</label>
                <input type="range" name="progress" id="progress" value="0" min="0" max="100" data-highlight="true" />
                <span class="slider_left">0</span>
                <span class="slider_right">100</span>
</div>
            <div data-role="fieldcontain">
                <label for="number">Time Estimate in Hours</label>
                <input type="number" name="hours" id="number">
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