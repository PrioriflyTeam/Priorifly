<body>
<?php
$Email = $_POST["email"];
$Password1 = $_POST["password"];
$Password2 = $_POST["retype_password"];


//Calculate other stuff and name it the same as in database

date_default_timezone_set('America/Los_Angeles');
$Creation_Date = date('Y/m/d H:i:s', time()); 

//$Time_Between = $Deadline->diff($Creation_Date);
//$Auto_Priority = 

//$User_Priority = 

$Active = 1;


include("pfConfig.php");
//Currently where 10 is we should grab User_ID from sessions cookie
$query = "insert into Users values (NULL,'$Creation_Date', '$Email', 'First_Name', 'Last_Name', '$Password1', '$Password2',  '$Active')";
$result = mysql_query($query);

?>
<p>Thanks for signing up!</p>
</body>