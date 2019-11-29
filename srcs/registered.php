<?php
	include_once("head2.php");
?>
<?php
	$h = $_GET['q'];
	$ver = "1";
	try
	{
		include_once("config/database.php");
		$su = 'update users set verified = :verified where verhash = :verhash';
		$st = $conn->prepare($su);
		$st->execute(['verified' => $ver, 'verhash' => $h]);
		$stmt = $conn->prepare('SELECT username, fname, lname FROM users WHERE verhash = :verhash');
		$stmt->execute(['verhash' => $h]); 
		$data = $stmt->fetch();
		echo "Congratulations $data[1] $data[2]!!!<br>Your Camagru account has been verified and you are free to log in and join in on the community!!!!";
	}
	catch (PDOException $e)
	{
		echo "Connection Failure!!!";
	}
	$conn = null;
?>
