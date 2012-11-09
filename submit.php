<?php
session_start();
include("pfConfig.php");
$email =  $_POST['email'];
$password =  $_POST['password'];
if (!isset($email) || !isset($password)) {
    header("Location: sorry.php");
}
elseif (empty($email) || empty($password)) {
    header("Location: sorry.php");
} else {
	$query = sprintf("SELECT * FROM Users WHERE Email = '$email' AND Digest = '$password'");
	$result = mysql_query($query);
	$rowCheck = mysql_num_rows($result);
	if ($rowCheck > 0) {
		while ($row = mysql_fetch_array($result)) {
			 $_SESSION['user_id'] = $row['User_ID'];
		}
	}
}
if (isset($_SESSION['user_id'])) {
	header("Location: tasks.php");
} else {
	header("Location: sorry.php");
}
?> 