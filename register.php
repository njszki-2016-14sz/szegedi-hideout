<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$db = mysql_connect('localhost', 'root', '');
		if(!$db){
				die('Could not connect: '.mysql_error());
				}
		$db_selected = mysql_select_db('facebookclone', $db);
		if(!$db_selected){
				die ('Can\'t use: '. mysql_error());
			}
			mysql_query("SET NAMES utf8", $db);
			
			if(strlen($_POST['username'])>5 /* $_POST['password']==$_POST['passwordagain']*/)
			{
			$hibatext="a felhasználónév túl rövid";	
			$hiba=true;
			}
			if(strlen(/*$_POST['username'])>5 */ strcmp ( $_POST['password'] ,$_POST['passwordagain'])!=0))
			{
			$hibatext="a jelszó nem egyezik";
				echo $_POST['password'];
				echo $_POST['passwordagain'];			
			$hiba=true;
			}
			if(strlen($_POST['username'])>5 &&  strcmp ( $_POST['password'] ,$_POST['passwordagain'] ) !=0)
			{
				
			$hibatext="a felhasználónév túl rövid /n a jelszó nem egyezik";	
			$hiba=true;
			}
			
			
			
			
			
			
			if(isset($hiba))
			{
				?>
<html>
	<head>
	<title>nem facebook klón</title>
	<meta charset="utf8">
	</head>
	<body>
	<div id="header">
	<div id="register">
	<form method="post">
	<p id="eror"><?=$hibatext?></p>
	<p>felhasználónév</p>
	
	<input type="text" name="username">
	<p>e-mail cím</p>
	<input type="text" name="email">
	<p>jelszó</p>
	<input type="password" name="password">
	<p>jelszó ismét</p>
	<input type="password" name="passwordagain">
	<input type="submit" name="login" value="regisztrálás">
	</form>
	</div>
	
	</body>
</html>
				<?php
			}
			
		

			if(/*strlen($_POST['username'])>5 $_POST['password']==$_POST['passwordagain']*/!isset($hiba))
			{
				
			$res = mysql_query('INSERT INTO `users` (`id`, `username`, `password`, `e-mail`) VALUES (NULL, "$_POST[\'username\']", MD5("$_POST[\'password\']"), "$_POST[\'email\']");', $db);
			header('Location: /index.php');
			}




		
	}else
	{
?>
<html>
	<head>
	<title>nem facebook klón</title>
	<meta charset="utf8">
	</head>
	<body>
	<div id="header">
	<div id="register">
	<form method="post">
	<p>felhasználónév</p>
	<input type="text" name="username">
	<p>e-mail cím</p>
	<input type="text" name="email">
	<p>jelszó</p>
	<input type="password" name="password">
	<p>jelszó ismét</p>
	<input type="password" name="passwordagain">
	<input type="submit" name="login" value="regisztrálás">
	</form>
	</div>
	
	</body>
</html>
<?php
	}
	?>