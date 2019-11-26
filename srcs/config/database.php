<?php
		$server = "localhost";
		$db = "camagrudb";
		$usr = "root";
		$pwd = "hmkabela";
		$conn = new PDO("mysql:host=$server;dbname=$db", $usr, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
