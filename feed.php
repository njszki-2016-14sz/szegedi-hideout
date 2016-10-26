<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"&&isset($_POST['phpmyadminquit']))
	{
		header('Location: /feed.php');
	}
if($_SERVER["REQUEST_METHOD"]=="POST"&&isset($_POST['phpmyadmin']))
	{
?>
<iframe src="http://localhost/phpmyadmin/db_structure.php?server=1&db=facebookclone&token=e5ef0ff881567ecec6ee219e5b132ce1" style="width: 100%;height:90%;"></iframe>
<?php
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
	<p id="username"><?=$_SESSION['username'];?></p>
		<div id="logout">
		<?php
			if($_SESSION['username']=="admin"||$_SESSION['username']=="steamhunter")
			{
		?>
				<form method="post" action="" style="width:75px; float:left;">
				
				<input type="submit" name="phpmyadmin" value="phpmyadmin" style="width:75px;">
				<?php
				if(isset($_POST['phpmyadmin']))
				{
				?>
				<input type="submit" name="phpmyadminquit" value="phpmyadminquit" style="width:95px;">
				<?php
				}
				?>
				</form>
			<?php
			}
			?>
			<form method="post" action="logout.php" id="logoutform">
			
				<input type="submit" name="logout" value="Kijelentkezés">
			</form>
		</div>
	</div>
	</body>
	
</html>