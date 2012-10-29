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

<div data-role="page" id="save_data_page">
	<div data-role="header" class="tasks_header">
		<a href="settings.php" data-role="button" id="settings_btn">Settings</a>
		<a href="index.php" data-role="button" id="logout_btn">Logout</a>
	</div><!-- /header -->

	<div data-role="content">	
		<div id="tasks_container">
			<p id="tasks_list_name">My To Do List </p>
			<p class="task_entry">1.  Walk dog
			<a href="edit.php" class="toolbox_img" ><img src="36-toolbox.png" alt="toolbox" /></a>
			</p>
			<p class="task_entry">2.  Walk cat
			<a href="edit.php" class="toolbox_img" ><img src="36-toolbox.png" alt="toolbox" /></a>
			</p>
			<p class="task_entry">3.  Rinse
			<a href="edit.php" class="toolbox_img" ><img src="36-toolbox.png" alt="toolbox" /></a>
			</p>
			<p class="task_entry">4.  Dry
			<a href="edit.php" class="toolbox_img" ><img src="36-toolbox.png" alt="toolbox" /></a>
			</p>
			<p class="task_entry">5.  Repeat
			<a href="edit.php" class="toolbox_img" ><img src="36-toolbox.png" alt="toolbox" /></a>
			</p>
			<p class="task_entry">???
			<a href="edit.php" class="toolbox_img" ><img src="36-toolbox.png" alt="toolbox" /></a>
			</p>
			<p class="task_entry">7.  Profit!?
			<a href="edit.php" class="toolbox_img" ><img src="36-toolbox.png" alt="toolbox" /></a>
			</p>
			<p class="task_entry">8.  WHERE YOU NEWLY CREATED EVENT WOULD GO
			<a href="edit.php" class="toolbox_img" ><img src="36-toolbox.png" alt="toolbox" /></a>
			</p>
		</div>
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
		<a href="#" data-role="button" id="some_btn">Placeholder</a>
		<a href="create.php" data-role="button" id="create_btn">Create New</a>
		<a href="edit.php" data-role="button" id="edit_btn">Edit</a>
	</div>
</div>

	<script type="text/javascript">
		$('#save_data_page').live( 'pageinit',function(event){
			$(".toolbox_img").hide();
			var toolbox_hidden = true;
			$("#edit_btn").click(
				function() {
					if (!toolbox_hidden) {
						$(".toolbox_img").hide();
						toolbox_hidden = true;
					} else {
						$(".toolbox_img").show();
						toolbox_hidden = false;
					}
				}
			);
		
		});
	</script>
	
</div>
</body>
</html>