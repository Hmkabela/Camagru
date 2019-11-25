<?php
include_once("head.php");
include_once("style.php");
$u = $_GET['u'];
$mp = $_GET['mp'];
echo "<br><br>";
$sql = $conn->prepare("select *  from media where mediapath = :mediapath AND verhash = :verhash");
$sql->execute(['mediapath' => $mp, 'verhash' => $u]);
$d = $sql->fetch();
$f = $d[4];
echo $f;
?>
<html>
	<img src="<?php echo $mp; ?>" value="<?php echo $f;?>" height= "500px" wvalueth = "500px">
	<form action="t.php?u=<?php echo $u;?>&mp=<?php echo $mp?>&fi=<?php echo $_POST['submit'];?>" method="post">
	<div>
	<input type="submit" name="fil:%s/search/replace/g t" value="blur"> Blur
	<input type="submit" name="filt" value="brightness"> Brightness
	<input type="submit" name="filt" value="contrast"> Contrast
	<input type="submit" name="filt" value="shadow"> Drop-Shadow
	<input type="submit" name="filt" value="grayscale"> Grayscale
	<input type="submit" name="filt" value="rotate"> Hue-Rotate
	<input type="submit" name="filt" value="invert"> Invert
	<input type="submit" name="filt" value="opacity"> Opacity
	<input type="submit" name="filt" value="saturate"> Saturate
	<input type="submit" name="filt" value="sepia"> Sepia
	<input type="submit" name="filt" value="none"> None
	</div>
	<input type="submit" value="Apply">
</script>
</html>
<?php
//$sql2 = $conn->prepare("select *  from media where mediapath = :mediapath AND verhash = :verhash");
//$sql2->execute(['mediapath' => $mp, 'verhash' => $u]);
//$r = $sql2->fetch();
	if(isset($_POST['submit']))
	{
		if(isset($_POST['submit']))
		{
			$filt = $_POST['submit'];
			$st = $conn->prepare('update media set filter = :filter where verhash = :verhash AND mediapath = :mediapath');
			$st = execute(['filter' => $filt, 'verhash' => $u, 'mediapath' => $mp]);
		}
	}
?>
