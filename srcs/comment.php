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
			header("Location: profile.php?u=$u");
		}
		else
		{
			echo	"Mind sharing  your thoughts? :)";
		}
	}
?>
