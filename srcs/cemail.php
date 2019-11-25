<?php
	$u = $_GET['u'];
	include_once('head.php');
?>
<html>
<form action="cemail.php?u=<?php echo $data[7] ?>" method= "POST">
		<br>
		<br>
		Enter Your Current Email Address </br> <input type= "text" name= "email"></br>
		Enter Your Desired Email Address </br> <input type= "text" name= "email2"></br>
		<input type= "submit" value= "Submit">
	</form>
</html>
<?php
	$u = $_GET['u'];
	include_once('head.php');
	if (!empty($_POST['email']) && !empty($_POST['email2']))
	{
		if (isset($_POST['email']) && isset($_POST['email2']))
		{
			$e = $_POST['email'];
			$n = $_POST['email2'];
			$n = strtolower($n);
			$stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
			$stmt->execute(['email' => $e]);
			$data = $stmt->fetch();
			$st = $conn->prepare('SELECT * FROM users WHERE email = :email');
			$st->execute(['email' => $n]);
			$data2 = $st->fetch();
			if ($data2[2] != $n && $data[2] == $e)
			{
				$subject = "Camagru Email Change Request!!!";
				$h  = "From : noreply@camagru.org" . "\r\n";
				$h .= 'MIME-Version: 1.0' . "\r\n";
				$h .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$body = "Greetings $data[3] $data[4]<br>
						We noticed you request to change your current email address to<br>
						------------------------<br>
						New Email Address: $n <br>
						------------------------<br>
						Please click this link to complete the change:
						<a href='http://localhost:8080/Camagru/srcs/email_up.php?u=$data[7]&e=$n'>Click Here</a><br><br>
						Regards: The Camagru Team!!!";
				if(mail($e, $subject, $body, $h))
					echo    'Verify Your New Email Address On The Email You Have Received';
				else
					echo "Email could not be sent!!";
			}
			else
				echo "Email Address Belongs To Another User!!!";
		}
		else
			echo	"Fill in all fields!!!";
	}
	else
		echo    "Fill in all fields!!!";
?>
