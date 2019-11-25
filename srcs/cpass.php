<html>
<form action="cpass.php?e=<?php echo $_GET['e']; ?>" method= "POST">
		<br>
		<br>
		Enter Your New Password </br> <input type= "password" name= "p1"></br>
		Re-Enter Your New Password </br> <input type= "password" name= "p2"></br>
		<input type= "submit" value= "Submit">
	</form>
</html>
<?php
	$e = $_GET['e'];
	if (!empty($_POST['p1']) && !empty($_POST['p2']))
	{
		if (isset($_POST['p1']) && isset($_POST['p2']))
		{
			if(strlen($p1) <= 8 || strlen($p2) <= 8)
			{
				$p1 = $_POST['p1'];
				$p2 = $_POST['p2'];
				if ($p1 == $p2)
					header("Location:fpass.php?e=$e&p=$p1");
				else
					echo "Passwords do not match!!!";
			}
			else
				echo "Password must be at least 8 chracters long!!!";
		}
		else
			echo	"Fill in all fields!!!";
	}
	else
		echo    "Fill in all fields!!!";
?>
