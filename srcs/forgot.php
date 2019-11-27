<html>
<form action="forgot.php" method= "POST">
		<br>
		<br>
		Enter Your Email Address </br> <input type= "text" name= "email"></br>
		<input type= "submit" value= "Submit">
	</form>
</html>
<?php
	try
	{
		if (!empty($_POST['email']))
		{
			if (isset($_POST['email']))
			{
				include_once("config/database.php");
				$e = $_POST['email'];
				$stm = $conn->prepare('SELECT * FROM users WHERE email = :email');
				$stm->execute(['email' => $e]);
				$dat = $stm->fetch();
				if ($dat[2] == $e)
				{
					$subject = "Camagru Forgot Password!!!";
					$h  = "From : noreply@camagru.org" . "\r\n";
					$h .= 'MIME-Version: 1.0' . "\r\n";
					$h .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$body = "Greetings $dat[3] $dat[4]<br>
							We noticed you request to change your current password<br>
							Please click this link to complete the change:<a href='http://localhost:8080/Camagru/srcs/cpass.php?e=$e'>Click Here</a><br><br>
							Regards: The Camagru Team!!!";
					if(mail($e, $subject, $body, $h))
					{
						echo    'Click The Link On The Email You Have Received';
					}
					else
						echo "Email could not be sent!!";
				}
			}
			else
				echo	"Fill in all fields!!!";
		}
		else
			echo    "Fill in all fields!!!";
	}
	catch(PDOException $e)
	{
		echo $e;
	}
?>
