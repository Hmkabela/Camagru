<?php
	include_once ("head.php");
	$o = $_GET['o'];
	$mp = $_GET['mp'];
	$u = $_GET['u'];
	$f = $_GET['fn'];
	$c = $_GET['c'];
try
{
	$sq = 'insert into ulikes(verhash_owner,verhash_liker,mediapath) VALUES(?, ?, ?)';
	$s = $conn->prepare($sq);
	$s->execute([$o,$u,$mp]);
	$stmt = $conn->prepare('SELECT * FROM likes WHERE verhash_owner = :verhash_owner AND mediapath = :mediapath');
	$stmt->execute(['verhash_owner' => $o, 'mediapath'=>$mp]);
	$med = $stmt->fetch();
	$med[1]++;
	$su = 'update likes set medialikes = :medialikes where verhash_owner = :verhash_owner AND mediapath= :mediapath';
	$st = $conn->prepare($su);
	$st->execute(['medialikes' => $med[1], 'verhash_owner' => $o, 'mediapath' => $mp]);
	$stmt2 = $conn->prepare('SELECT * FROM users WHERE verhash = :verhash');
	$stmt2->execute(['verhash' => $o]);
	$formail = $stmt2->fetch();
	$stmt3 = $conn->prepare('SELECT * FROM users WHERE verhash = :verhash');
	$stmt3->execute(['verhash' => $u]);
	$formail2 = $stmt3->fetch();
	if($formail[9] == 1)
	{
		$subject = "Image Was Liked!!!";
                                $h  = "From : noreply@camagru.org" . "\r\n";
								$h .= "Content-type: text/html";
                                $body = "Greetings $formail2[3] $formail2[4];<br>
                                $formail[0] just liked something you posted<br>
                                Regards: The Camagru Team!!!";
	}
	mail($formail2[2], $subject, $body, $h);
	header("Location:$f?u=$u&c=$c");
	}
	catch(PDOException $e)
	{
		echo $e;
	}
?>
