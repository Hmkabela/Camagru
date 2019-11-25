<?php
	include_once("head2.php");
?>
<html>
	<form action="registration.php" method= "POST">
		Username </br> <input type= "text" name= "username"></br>
		Password </br> <input type= "password" name= "pwd1"></br>
		Re-enter Password </br> <input type= "password" name= "pwd2"></br>
		Email </br> <input type= "text" name= "email"></br>
		First Name </br> <input type= "text" name= "fname"></br>
		Last Name </br> <input type= "text" name= "lname"></br>
		<input type= "submit" value= "Register">
	</form>
</html>

<?php
	$server = "localhost";
$db = "camagrudb";
	$usr = "root";
	$pwd = "hmkabela";
	$user_name = $_POST['username'];
	$passwd = $_POST['pwd1'];
	$emailAdd = $_POST['email'];
	$f_name = $_POST['fname'];
	$l_name = $_POST['lname'];
	$ddp = "media/dps/default.jpg";
	try
	{
		$conn = new PDO("mysql:host=$server;dbname=$db", $usr, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if (!empty($_POST['username']) && !empty($_POST['pwd1']) && !empty($_POST['pwd2']) && !empty($_POST['email']) && !empty($_POST['fname']) && !empty($_POST['lname']))
		{
			if (isset($_POST['username']) && isset($_POST['pwd1']) && isset($_POST['pwd2']) && isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname']))
			{
				$stmt = $conn->prepare('SELECT username, email FROM users WHERE username = :username OR email = :email');
				$stmt->execute(['username' => $user_name, 'email' => $emailAdd]);
				$data = $stmt->fetch();
				if ($data[0] != $user_name && $data[1] != $emailAdd)
				{
					$emailAdd = filter_var($emailAdd, FILTER_SANITIZE_EMAIL);
					if (filter_var($emailAdd, FILTER_VALIDATE_EMAIL))
					{
						if ($passwd == $_POST['pwd2'])
						{
							if (strlen($passwd) < 8)
								echo "Password should be at least 8 characters long!!<br>";
							else
							{
									$p = $user_name . $emailAdd;
									$hash = md5($p);
									$subject = "Camagru Registration!!!";
									$h  = "From : noreply@camagru.org" . "\r\n";
									$h .= 'MIME-Version: 1.0' . "\r\n";
									$h .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
									$body = "Thanks for signing up  $f_name  $l_name!<br>
											Your Camagru account has been created, you can login with the following credentials 
											after you have activated your account by pressing the url at the bottom.<br>
											------------------------<br>
											Username: $user_name <br>
											Password: $passwd    <br>
											------------------------<br>
											Please click this link to activate your account: 
											<a href='http://localhost:8080/Camagru/srcs/registered.php?q=$hash'>Click Here</a><br><br>
											Regards: The Camagru Team!!!";
									$d = date("Y-m-d");
									$sql = 'insert into users(username, passwd, email, fname, lname, joindate,verhash,dp) VALUES(?, ?, ?, ?, ?, ?, ?,?)';
									$stmt = $conn->prepare($sql);
									$stmt->execute([$user_name,$passwd,$emailAdd,$f_name,$l_name, $d, $hash, $ddp]);
									if(mail($emailAdd, $subject, $body, $h))
										echo    'Verify Your Account On The Email You Have Received';
									else
										echo "Email could not be sent!!";
							}
						}
						else
						{
							echo	"Passwords do not match!!! \n";
						}
					}
					else
						echo "Email Address is invalid";
				}
				else
					echo "Username or Email belong to another user";
			}
		}
		else
		{
			echo	"Please fill in all fields \n";
		}
	}
	catch (PDOException $e)
	{
		echo "An Error Occured!!!";
	}
	$conn = null;
?>
