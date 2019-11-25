<?php
$p1 = $_GET['p'];
$e = $_GET['e'];
try
{
	include_once("config/database.php");
	$su = 'update users set passwd = :passwd where email = :email';
	$st = $conn->prepare($su);
	$st->execute(['passwd' => $p1, 'email' => $e]);
	echo	"update successful!!!";
	$i = 0;
	header("Location: login.php");
}
catch (PDOException $e)
{
	echo $e;
}
?>
