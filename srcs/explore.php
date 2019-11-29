<?php
	include_once('head.php');
	$limit = 5;
	$stmt = $conn->prepare('SELECT * FROM media ORDER BY postdate desc');
	$stmt->execute();
	$med = $stmt->fetchAll();
	$stmt2 = $conn->prepare('SELECT * FROM ulikes');
	$stmt2->execute();
	$med2 = $stmt2->fetchAll();
	$z = array_fill(0, count($med), '0');
	$i = 0;
	$i2 = 0;
	$a = count($med);
	$f = explode('/',$_SERVER['PHP_SELF']);
	$c = $_GET['c'];
	if ($a == 0)
	{
		echo "No pictures yet. Be the first in the community to post something!! :)";
		die();
	}
	while ($i < $a)
	{
		while($i2 < count($med2))
		{
			if(($med2[$i2][2] == $med[$i][2]) && ($med2[$i2][0] == $med[$i][1]) && ($med2[$i2][1] == $u) )
			{
				$z[$i] = '1';
			}
			$i2++;
		}
		$i++;
		$i2 = 0;
	}
	$i = 0;
	while($i < $limit && $c < $a)
	{
		echo '<img src="'.$med[$c][2].'" />' . "<br>";
		if($z[$c] == '1')
		{
			echo '<center><a href= unlikesexp.php?u='.$u.'&mp='.$med[$c][2].'&o='.$med[$c][1].'&fn='.$f[3].'&c='. $c .'><img height = 50px width = 50px style = display:inline-block; margin-right:5px; src= media/likes/liked.png /></a>';
		}
		else
		{
			echo '<center><a href= likesexp.php?u='.$u.'&mp='.$med[$c][2].'&o='.$med[$c][1].'&fn='.$f[3].'&c='. $c .'><img  height = 50px width = 50px style = display:inline-block; margin-right:5px; src= media/likes/unliked.png /></a>';
		}
		echo '<a href= preview.php?u='.$u.'&mp='.$med[$c][2].'&o='.$med[$c][1].'><img  height = 50px width = 50px style = display:inline-block; margin-right:5px; src="media/likes/com.png" /></a>'. " <br>";
		echo    $med[$c][3] . "<br>";
		echo    $med[$c][5] . "</center><br><br>";
		$i++;
		$c++;
	}
	$cb = ($c - 10 <= 0) ? 0 : $c - 10;
	$cf = ($c + 5 > $a) ? $a - 5 : $c;
	echo "<a href= explore.php?u=$u&c=$cb>PREV</a><br>";
	echo "<a href= explore.php?u=$u&c=$cf>NEXT</a><br>";
?>
