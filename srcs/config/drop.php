<?php
	include_once("database.php");
	$sql = "DROP DATABASE camagrudb";
	$conn->exec($sql);
	echo "Database Deleted Successfully";
?>
