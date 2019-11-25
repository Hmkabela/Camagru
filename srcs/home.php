<?php
	include_once('head.php');
	$s = $conn->prepare('SELECT * FROM ulikes WHERE verhash_liker = :verhash_liker');
	$s->execute(['verhash_liker' => $u]);
	$med = $s->fetchAll();
	$st2 = $conn->prepare('SELECT * FROM users');
	$st2->execute();
	$dat = $st2->fetchAll();
	$i = 0;
	$i2 = 0;
	$a = count($med);
	$names = array_fill(0, $a, '0');
	$f = explode('/',$_SERVER['PHP_SELF']);
	if ($a == 0)
	{
		echo "You have not liked any images :(";
	}
	while ($i < $a)
	{
		while($i2 < $a)
		{
			if ($med[$i][0] == $dat[$i2][7])
			{
				$names[$i] = $dat[$i2][0];
				break;
			}
			$i2++;
		}
		$i++;
		$i2 = 0;
	}
	$i = 0;
	while($i < $a)
	{
		echo '<center><b>' . strtoupper($names[$i]). '</b>' . '<br>';
		echo '<a href= preview.php?u='.$u.'&mp='.$med[$i][2].'><img src="'.$med[$i][2].'" /></a>' . "<br>";
		echo '<div>';
		echo '<a href= unlikes.php?u='.$u.'&mp='.$med[$i][2].'&o='.$med[$i][0].'&fn='.$f[3].'><img height = 50px width = 50px style = display:inline-block; margin-right:5px; src= media/likes/liked.png /></a>';
		echo '<a href= preview.php?u='.$u.'&mp='.$med[$i][2].'&o='.$med[$i][0].'><img  height = 50px width = 50px style = display:inline-block; margin-right:5px; src="media/likes/com.png" /></a>'. " <br><br>";
		echo '</div></center>';
		$i++;
	}
?>
