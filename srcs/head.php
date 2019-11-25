<?php
	$u = $_GET['u'];
	include_once('head.php');
	if ($u)
	{
		include_once("config/database.php");
		$stmt = $conn->prepare('SELECT * FROM users WHERE verhash = :verhash');
		$stmt->execute(['verhash' => $u]);
		$data = $stmt->fetch();
	}
	else
	{
		header('Location:login.php');
	}
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
body {font-family: Arial, Helvetica, sans-serif;}

.column 
{
	width: 50%;
	padding: 5px;
	position: absolute;
	margin-top: 200px;
	z-index: 100;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

img {
	display: block;
  margin-left: auto;
  margin-right: auto;
}
.navbar 
{
	width: 100%;
	background-color: #555;
	overflow: auto;
	display: block;
}

.navbar a {
  float: left;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
  width: 25%;
  text-align: center;
}

.navbar a:hover {
  background-color: #00FFFF;
  border: 1px solid #;
}

.navbar a.n {
  background-color: #4CAF50;
}
button
			{
				float: right;
				width:100;
				height=100;
			}
			#dp
			{
				border-radius:50%;
				float: left;
			}
</style>

<body>
	<div class="row">
  		<div class="colum">
    		<img src="logo.jpg"style="width:10%">
		</div>
	</div>
	<div>
	<h1 align="center"> CAMAGRU </h1>
	<nav class="navbar">
		<a href="home.php?u=<?php echo $u?>">HOME</a>
		<a href="search.php?u=<?php echo $u?>">SEARCH</a>
		<a href="explore.php?u=<?php echo $u?>">EXPLORE</a>
		<a href="profile.php?u=<?php echo $u?>">MY PROFILE</a>
	</nav>
	</div>
	<img id = "dp" src="<?php echo $data[8]; ?>"  height= "200px" width = "200px">
	<a href="noti.php?u=<?php echo $u?>"><img src="settings.png" width="100" height="100"></a>
	<button type="button" onclick="bye()" formaction="login.php">LOG OUT</button>
	<h1> <?php echo strtoupper($data[0]);?> </h1>
	<script>
		function bye()
		{
			alert('Goodbye <?php echo $data[0]; ?> :(\nCome Back Soon!!');
			window.location.href = "login.php";
		}
	</script>
</body>
</html>
