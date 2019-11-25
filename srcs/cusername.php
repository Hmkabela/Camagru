<?php
	$u = $_GET['u'];
	include_once('head.php');
?>
<html>
<form action="cusername.php?u=<?php echo $data[7] ?>" method= "POST">
		<br>
		<br>
		Enter Your Email Address </br> <input type= "text" name= "email"></br>
		Enter Your Desired Username </br> <input type= "text" name= "username"></br>
		<input type= "submit" value= "Submit">
	</form>
</html>
<?php
	$u = $_GET['u'];
	include_once('head.php');
	if (!empty($_POST['email']) && !empty($_POST['username']))
	{
		if (isset($_POST['email']) && isset($_POST['username']))
		{
			$e = $_POST['email'];
			$n = $_POST['username'];
			$n = strtolower($n);
			$stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
			$stmt->execute(['email' => $e]);
			$data = $stmt->fetch();
			$st = $conn->prepare('SELECT * FROM users WHERE username = :username');
			$st->execute(['username' => $n]);
			$data2 = $st->fetch();
			if ($data2[0] != $n && $data[2] == $e)
			{
				$subject = "Camagru Username Change Request!!!";
				$h  = "From : noreply@camagru.org" . "\r\n";
				$h .= 'MIME-Version: 1.0' . "\r\n";
				$h .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$body = "Greetings $data[3] $data[4]<br>
						We noticed you request to change your current username to<br>
						------------------------<br>
						New Username: $n <br>
						------------------------<br>
						Please click this link to complete the change:
						<a href='http://localhost:8080/Camagru/srcs/uname_up.php?u=$data[7]&e=$n'>Click Here</a><br><br>
						Regards: The Camagru Team!!!";
				if(mail($e, $subject, $body, $h))
					echo    'Verify Your New Username On The Email You Have Received';
				else
					echo "Email could not be sent!!";
			}
			else
				echo "Username Or Email Address Belongs To Another User!!!";
		}
		else
			echo	"Enter Your Email Address!!!";
	}
	else
		echo    "Enter Your Email Address!!!";
?>
