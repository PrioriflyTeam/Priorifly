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

<div data-role="page">

	<div data-role="header" class="home_header">
		<h1>Welcome <?php echo $_POST["username"] ?>!</h1>
	</div><!-- /header -->

	<div data-role="content" id="content">	
		<p>You are successfully logged in!</p>
		<p><a href="tasks.php" data-role="button" id="go_to_tasks_btn">Go to My Tasks</a></p>
	</div><!-- /content -->

	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
	</div>
	
	<script type="text/javascript">
	</script>
</div><!-- /page -->

</body>
</html>