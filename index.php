<?php
function GetColorByRank($rankid)
{
	switch($rankid)
	{
		case 99:return "#efff00;";
		default:return "#6af98f";
	
	}
}
	session_start();
	
	if(isset($_SESSION['userid']))
	{
		header('Location: /feed.php');
	}
	if($_SERVER["REQUEST_METHOD"]=="POST"&&!isset($_POST['comment']))
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
	
	<input type="text" name="username" class="logintextbox">
	<input type="password" name="password" class="logintextbox">
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