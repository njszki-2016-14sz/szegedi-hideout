<?php
session_start();
print $_SESSION['username'];
?>
<html>
	<head>
	<title>nem facebook klón</title>
	<meta charset="utf8">
	</head>
	<body>
	<div id="header">
	<div id="logout">
	<form method="post" action="logout.php">
	<input type="submit" name="logout" value="Kijelentkezés">
	</form>
	</div>
	</body>
</html>