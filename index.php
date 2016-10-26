<?php
	session_start();
	
	if(isset($_SESSION['userid']))
	{
		header('Location: /feed.php');
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
	<form method="post" action="login.php">
	<input type="text" name="username">
	<input type="password" name="password">
	<input type="submit" name="login" value="Bejelentkezés">
	</form>
	</div>
	<div id="register">
	<a href="register.php">regisztrálás</a>
	</div>
	</div>
	<?php
	if(isset($_SESSION['hiba']))
	{
	print "<div>";
	print $_SESSION['hiba'];
	print "</div>";
	?>
	</body>
</html>