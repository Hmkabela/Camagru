<?php
	include_once ("head.php");
	$o = $_GET['o'];
	$mp = $_GET['mp'];
	$f = $_GET['fn'];
	$c = $_GET['c'];
try
{
	$sq = 'delete from ulikes where verhash_owner = :verhash_owner AND verhash_liker = :verhash_liker AND mediapath = :mediapath';
	$s = $conn->prepare($sq);
	$s->execute(['verhash_owner'=>$o,'verhash_liker'=>$u,'mediapath'=>$mp]);
	$stmt = $conn->prepare('SELECT * FROM likes WHERE verhash_owner = :verhash_owner AND mediapath = :mediapath');
	$stmt->execute(['verhash_owner' => $o, 'mediapath'=>$mp]);
	$med = $stmt->fetch();
	$med[1]--;
	$su = 'update likes set medialikes = :medialikes where verhash_owner = :verhash_owner AND mediapath= :mediapath';
	$st = $conn->prepare($su);
	$st->execute(['medialikes' => $med[1], 'verhash_owner' => $o,'mediapath'=>$mp]);
	header("Location:$f?u=$u&c=$c");
	}
	catch(PDOException $e)
	{
		echo $e;
	}
?>
