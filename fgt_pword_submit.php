<?php
	include("pfConfig.php");
	function sendmail($email) {
		$query = sprintf("SELECT Digest FROM Users WHERE Email = '$email'");
		$result = mysql_query($query);
		$rowCheck = mysql_num_rows($result);
		if ($rowCheck > 0) {
			$row = mysql_fetch_assoc($result);
			$password = $row["Digest"];
			$to      = $email;
			$subject = 'Priorifly Password';
			$message = "Yo homie. Try to remember your password next time. Your password is $password.";
			$headers = '';
			mail($to, $subject, $message, $headers);
			echo "true";
		} else {
			echo "false";
		}
	}	
	$email = $_POST["email"];
	sendmail($email);
?>