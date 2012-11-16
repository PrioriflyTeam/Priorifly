<?php
session_set_cookie_params(10000000000,"/");
session_start();
include("pfConfig.php");
$email =  $_POST['email'];
$query = sprintf("SELECT * FROM Users WHERE Email LIKE '$email'");
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$_SESSION['user_id'] = $row['User_ID'];
header("Location: tasks.php");
?> 