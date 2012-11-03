<?php
		$progress = $_POST['progress'];
		$id = $_POST['id'];
        include("pfConfig.php");
        $query = sprintf("UPDATE Tasks SET Progress = $progress WHERE Task_ID = $id"); //Change X
        $result = mysql_query($query);
        header("Location: http://stanford.edu/~scottk92/cgi-bin/priorifly_2/tasks.php");
        exit();
?>

