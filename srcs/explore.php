<?php
	include_once('head.php');
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
	while($i < $a)
	{
		echo '<img src="'.$med[$i][2].'" />' . "<br>";
		if($z[$i] == '1')
		{
			echo '<a href= unlikes.php?u='.$u.'&mp='.$med[$i][2].'&o='.$med[$i][1].'&fn='.$f[3].'><img height = 50px width = 50px style = display:inline-block; margin-right:5px; src= media/likes/liked.png /></a>';
		}
		else
		{
			echo '<a href= likes.php?u='.$u.'&mp='.$med[$i][2].'&o='.$med[$i][1].'&fn='.$f[3].'><img  height = 50px width = 50px style = display:inline-block; margin-right:5px; src="media/likes/unliked.png" /></a>';
		}
		echo '<a href= preview.php?u='.$u.'&mp='.$med[$i][2].'&o='.$med[$i][1].'><img  height = 50px width = 50px style = display:inline-block; margin-right:5px; src="media/likes/com.png" /></a>'. " <br>";
		echo    $med[$i][3] . "<br>";
		echo    $med[$i][5] . "</center><br><br>";
		$i++;
	}
?>
