<?php
	$u = $_GET['u'];
	$n = $_GET['n'];
	include_once('head.php');
	echo  "<a href=cusername.php?u=$u>Change Username</a>	";
	echo  "<a href=cpassword.php?u=$u>Change Password</a>	";
	echo  "<a href=cemail.php?u=$u>Change Email Address</a>	";
	echo  "Notifications";
	if ($n == 0)
	{
		$noti1 = "";
		$noti2 = "disabled";
	}
	else
	{
		$noti1 = "disabled";
		$noti2 = "";
	}
?>
<html>
	<button id="on" <?php echo $noti1;?> onclick="on()">ON</button>
	<button id="off" <?php echo $noti2;?> onclick="off()">OFF</button>
	<script>
		function on()
		{
			document.getElementById("on").disabled = true;
			document.getElementById("off").disabled = false;
			window.location.href = "noton.php?u=<?php echo $u;?>";
		}
		function off()
		{
			document.getElementById("on").disabled = false;
			document.getElementById("off").disabled = true;
			window.location.href = "notoff.php?u=<?php echo $u;?>";
		}
	</script>
</html>
