<?php include_once("head.php"); ?>
<form action="post.php?u=<?php echo $u;?>" method="POST" enctype="multipart/form-data">
	<br><br>
	<input type = "file" name = "file"><br><br>
	<textarea name="cap" rows="4" cols="50"></textarea><br>
	<input type = "submit" value = "Post">
</form>
<?php
	$name = $_FILES['file']['name'];
//	$size = $_FILES['file']['size'];
//	$type = $_FILES['file']['type'];
	$cap = $_POST['cap'];

	$tmp_name = $_FILES['file']['tmp_name'];
	if (isset($name))
	{
		if (!empty($name))
		{
			$location = 'media/uploads/';
			$l = $location.$name;
			if(move_uploaded_file($tmp_name, $location.$name))
			{
				$d = date('Y-m-d H:i:s');
				$n = "0";
				$f = "none";
				$sql = 'insert into media(verhash, mediapath, postdate,caption, filter) VALUES(?, ?, ?,?,?)';
				$stmt = $conn->prepare($sql);
				$stmt->execute([$u,$l, $d,$cap,$f]);
				$sql2 = 'insert into likes(verhash_owner, mediapath) VALUES(?,?)';
				$stmt2 = $conn->prepare($sql2);
				$stmt2->execute([$u, $l]);
				header("Location: profile.php?u=$u");
			}
		}
		else
		{
			echo "Please choose a file";
		}
	}
?>
