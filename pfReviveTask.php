<?php
		$progress = $_POST['progress'];
		$id = $_POST['id'];
        include("pfConfig.php");
        $query = sprintf("UPDATE Tasks SET Status = 2 WHERE Task_ID = $id");
        $result = mysql_query($query);
        header("Location: tasks.php");
        exit();
?>