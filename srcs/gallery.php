<?php
	include_once("head2.php");
	include_once("config/database.php");
	$stmt = $conn->prepare('SELECT * FROM media ORDER BY postdate desc');
        $stmt->execute();
        $med = $stmt->fetchAll();
		$i = 0;
		$a = count($med);
		while($i < $a)
        {
                echo '<a href= index.php><img src="'.$med[$i][2].'" /></a>' . "<br>";
				$i++;
		}
?>
