<?php
try 
{
	$server = "localhost";
	$usr = "root";
	$pwd = "hmkabela";
	$conn = new PDO("mysql:host=$server", $usr, $pwd);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE DATABASE camagrudb";
	$conn->exec($sql);
	echo "Database created successfully<br>";
	$t1 = "CREATE TABLE camagrudb.users (
	username	varchar(15),
	passwd		text,
	email		varchar(100),
	fname		varchar(20),
	lname		varchar(20),
	joindate	date,
	verified	varchar(1) DEFAULT 0,
	verhash		text,
	dp			text,
	notify		int DEFAULT 1
    )";
    $conn->exec($t1);
	echo "Table users created successfully<br>";
	$t2 = "CREATE TABLE camagrudb.ulikes (
	verhash_owner	text,
	verhash_liker	text,
	mediapath		text
    )";
    $conn->exec($t2);
	echo "Table ulikes created successfully<br>";
	$t3 = "CREATE TABLE camagrudb.media (
	media_id	int AUTO_INCREMENT PRIMARY KEY,
	verhash		text,
	mediapath	text,
	caption		text,
	filter		varchar(30),
	postdate	datetime
    )";
    $conn->exec($t3);
	echo "Table camagrudb.media created successfully<br>";
	$t4 = "CREATE TABLE camagrudb.likes (
	mediapath		text,
	medialikes		int DEFAULT 0,
	verhash_owner	text
    )";
    $conn->exec($t4);
	echo "Table likes created successfully<br>";
	$t5 = "CREATE TABLE camagrudb.comments(
	mediapath		text,
	verhash_owner	text,
	comments		text,
	comment_date	datetime,
	verhash_com		text
    )";
    $conn->exec($t5);
    echo "Table comments created successfully<br>";
}
catch(PDOException $e)
    {
    echo "DATABASE ALREADY EXISTS!!!";
    }

$conn = null;
?>
