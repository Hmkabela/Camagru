<?php
	include_once("head.php");
	$u = $_GET['u'];
	$mp = $_GET['mp'];
?>
<form action="profile.php?u=<?php echo $u;?>" method="POST">
	Comment<br>
	<textarea name="com" rows="4" cols="50"></textarea><br>
	<input type = "submit" value = "Submit">
</form>
<?php
	$com = $_POST['com'];
	if (isset($com))
	{
		if (!empty($com))
		{
			$d = date('Y-m-d H:i:s');
			$sql = 'insert into comments(mediapath,verhash_owner, comments, comment_date,verhash_com) VALUES(?, ?, ?, ?, ?)';
			$stmt = $conn->prepare($sql);
			$stmt->execute([$mp,$u, $com,$d,$u]);
			$stmt2 = $conn->prepare('SELECT * FROM users WHERE verhash = :verhash');
			$stmt2->execute(['verhash' => $o]);
			$formail = $stmt2->fetch();
			$stmt3 = $conn->prepare('SELECT * FROM users WHERE verhash = :verhash');
			$stmt3->execute(['verhash' => $u]);
			$formail2 = $stmt3->fetch();
			if($formail[9] == 1)
			{
								$subject = "Your Media Was Commented On!!!";
                                $h  = "From : noreply@camagru.org" . "\r\n";
								$h .= "Content-type: text/html";
                                $body = "Greetings $formail[3] $formail;[4]<br>
                                $formail2[0] just commented on something you posted<br>
                                ------------------------<br>
                                <img src=$mp/></body></html><br>
                                ------------------------<br>
                                Regards: The Camagru Team!!!";
			}
			mail($formail[2], $subject, $body, $h);
			header("Location: profile.php?u=$u");
		}
		else
		{
			echo	"Mind sharing  your thoughts? :)";
		}
	}
?>
