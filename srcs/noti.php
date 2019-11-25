<?php
	include_once("config/database.php");
	$u = $_GET['u'];
	$stmt = $conn->prepare('SELECT * FROM users WHERE verhash = :verhash');
	$stmt->execute(['verhash' => $u]);
	$data = $stmt->fetch();
	$n = $data[9];
	header("Location: settings.php?u=$u&n=$n");
?>
