<?php
	session_start();
	
	if(isset($_SESSION['userid']))
	{
		header('Location: /feed.php');
	}
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{	
			header('Location: /register.php');
	}
?>
<html>
	<head>
	<title>nem facebook klón</title>
	<meta charset="utf8">
	<link rel="stylesheet" href="base.css">
	</head>
	<body>
	<div id="header">
	<div id="login">
	<form method="post" action="login.php" id="loginform">
	
	<input type="text" name="username">
	<input type="password" name="password">
	<input type="submit" name="login" value="Bejelentkezés" id="loginbt">
	</form>
	<form method="post" id="registerfrm">
	<input type="submit" value="regisztrálás" name="reg">
	</form>
	</div>
	</div>
	<?php
	if(isset($_SESSION['hiba']))
	{
	print "<div>";
	print $_SESSION['hiba'];
	print "</div>";
	}
	include("postfeed.php");
	?>
	</body>
</html>