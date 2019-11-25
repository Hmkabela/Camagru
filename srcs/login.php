<?php
	include_once("head2.php");
?>
<html>
<center>	<form action="login.php" method= "POST">
		Username </br> <input type= "text" name= "username"></br>
		Password </br> <input type= "password" name= "pwd"></br>
		<input type= "submit" value= "login"><br>
		<a href="gallery.php">Gallery</a><br>
		<a href="registration.php">Register</a><br>
		<a href="forgot.php">Forgot Password</a>
	</form>
</html>

<?php
	$user_name = $_POST['username'];
	$passwd = $_POST['pwd'];
	try
	{
		include_once("config/database.php");
		if (!empty($_POST['username']) && !empty($_POST['pwd']))
		{
			if (isset($_POST['username']) && isset($_POST['pwd']))
			{
				$stmt = $conn->prepare('SELECT * FROM users WHERE username = :username');
				$stmt->execute(['username' => $user_name]);
				$data = $stmt->fetch();
				if ($data[0] != $user_name)
						echo "user not found";
				else
				{
					if ($data[1] != $passwd)
						echo "Username and Password do not match!!!";
					else
					{
						if ($data[6] == 0)
							echo "Account is not verified. Please click on the link you received in your email";
						else if ($data[6] == 1)
							header("Location:profile.php?u=$data[7]");
					}
				}
			}
		}
		else
			echo "Please fill in all fields";
	}

	catch(PDOException $e)
	{
		echo	"Something went wrong!!! It will be attended to shortly";
	}
?></center>
