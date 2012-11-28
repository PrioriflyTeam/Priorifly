<?php
$Email = $_POST["email"];
$Password1 = $_POST["password"];
$Password2 = $_POST["retype_password"];
date_default_timezone_set('America/Los_Angeles');
$Creation_Date = date('Y/m/d H:i:s', time()); 
$Active = 1;
$Salt = rand(1000000000, 9999999999);
$Digest = crypt($Password1, $Salt);
include("pfConfig.php");
$query = "insert into Users values (NULL,'$Creation_Date', '$Email', '$Digest', '$Salt', '$Active')";
$result = mysql_query($query);
$query2 = sprintf("SELECT * FROM Users WHERE Email LIKE '$Email'");
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
session_start();
$_SESSION['user_id'] = $row2['User_ID'];
header("Location: tasks.php");
?>