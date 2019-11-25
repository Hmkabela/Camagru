<?php
	include_once ("head.php");
	$o = $_GET['o'];
	$mp = $_GET['mp'];
	$u = $_GET['u'];
	$f = $_GET['fn'];
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
                                $body = "Greetings $formail[3] $formail;[4]<br>
                                $formail2[0] just liked something you posted<br>
                                ------------------------<br>
                                <img src=$mp/></body></html><br>
                                ------------------------<br>
                                Regards: The Camagru Team!!!";
	}
	mail($formail[2], $subject, $body, $h);
	header("Location:$f?u=$u");
	}
	catch(PDOException $e)
	{
		echo $e;
	}
?>
