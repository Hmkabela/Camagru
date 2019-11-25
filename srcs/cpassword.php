<?php
	$u = $_GET['u'];
	include_once('head.php');
?>
<html>
<form action="cpassword.php?u=<?php echo $data[7] ?>" method= "POST">
		<br>
		<br>
		Enter Your Email Address </br> <input type= "text" name= "email"></br>
		Enter Your New Password </br> <input type= "text" name= "pass"></br>
		<input type= "submit" value= "Submit">
	</form>
</html>
<?php
	$u = $_GET['u'];
	include_once('head.php');
	if (!empty($_POST['email']) && !empty($_POST['pass']))
	{
		if (isset($_POST['email']) && isset($_POST['pass']))
		{
			$e = $_POST['email'];
			$n = $_POST['pass'];
			$stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
			$stmt->execute(['email' => $e]);
			$data = $stmt->fetch();
			if ($data[2] == $e)
			{
				$subject = "Camagru Password Change Request!!!";
				$h  = "From : noreply@camagru.org" . "\r\n";
				$h .= 'MIME-Version: 1.0' . "\r\n";
				$h .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$body = "Greetings $data[3] $data[4]<br>
						We noticed you request to change your current password to<br>
						------------------------<br>
						New password: $n <br>
						------------------------<br>
						Please click this link to complete the change:
						<a href='http://localhost:8080/Camagru/srcs/pass_up.php?u=$data[7]&e=$n'>Click Here</a><br><br>
						Regards: The Camagru Team!!!";
				if(mail($e, $subject, $body, $h))
					echo    'Verify Your New Password On The Email You Have Received';
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
