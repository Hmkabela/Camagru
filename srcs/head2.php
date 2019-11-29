<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
body {font-family: Arial, Helvetica, sans-serif;}
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

button
                        {
                                float: right;
                                width:100;
                                height=100;
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
		<button type="button" id= "but" onclick="log()">LOG IN</button>
		<script>
			function log()
			{
				window.location.href = "index.php";
			}
		</script>
</body>
</html>
