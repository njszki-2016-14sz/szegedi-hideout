<?php
session_start();

?>
<html>
	<head>
	<title>nem facebook klón</title>
	<meta charset="utf8">
	</head>
	<body>
	<div id="header">
	<p><?=$_SESSION['username'];?></p>
		<div id="logout">
			<form method="post" action="logout.php">
				<input type="submit" name="logout" value="Kijelentkezés">
			</form>
		</div>
	</div>
	</body>
	
</html>