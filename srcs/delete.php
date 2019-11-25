<?php
	include_once ("head.php");
	$mp = $_GET['mp'];
	$u = $_GET['u'];
try
{
	$s1 = $conn->prepare('delete FROM ulikes WHERE verhash_owner = :verhash_owner AND  mediapath = :mediapath');
	$s1->execute(['verhash_owner' => $u,'mediapath' => $mp]);
	$s2 = $conn->prepare('delete FROM likes WHERE verhash_owner = :verhash_owner AND mediapath = :mediapath');
	$s2->execute(['verhash_owner' => $u, 'mediapath' => $mp]);
	$s3 = $conn->prepare('delete FROM media WHERE verhash = :verhash AND  mediapath = :mediapath');
	$s3->execute(['verhash' => $u,'mediapath' => $mp]);
	$s4 = $conn->prepare('delete FROM comments WHERE verhash_owner = :verhash_owner AND  mediapath = :mediapath');
	$s4->execute(['verhash_owner' => $u,'mediapath' => $mp]);
	unlink($mp);
	header("Location:profile.php?u=$u");
	}
	catch(PDOException $e)
	{
		echo $e;
	}
?>
