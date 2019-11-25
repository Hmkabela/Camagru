<?php
include_once("head.php");
if(!isset($_GET['u']))
{
    header("Location: login.php");
}
else{
	$u = $_GET['u'];
	$cap = "";
    $d = date("Y-m-d H:i:s");
    $upload_dir = "media/uploads/";
    $img = $_POST['img'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . $u . $d . ".png";
	$f = str_replace(' ', '', $file);
    if($success = file_put_contents($file, $data))
	{
        $sql = 'insert into media(verhash, mediapath, postdate,caption, filter) VALUES(?, ?, ?,?,?)';
		$stmt = $conn->prepare($sql);
        $stmt->execute([$u,$f, $d,$cap,$cap]);
		$sql2 = 'insert into likes(verhash_owner, mediapath) VALUES(?,?)';
		$stmt2 = $conn->prepare($sql2);
		$stmt2->execute([$u, $f]);
    }
    else
	{
        echo "Error";
    }
    
}
?>
