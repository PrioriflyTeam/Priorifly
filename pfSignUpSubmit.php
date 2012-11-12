<body>
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
//Currently where 10 is we should grab User_ID from sessions cookie
$query = "insert into Users values (NULL,'$Creation_Date', '$Email', '$Digest', '$Salt', '$Active')";
$result = mysql_query($query);

?>
