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
if(!isset($_SESSION['username']))
{
	header('Location: /index.php');
}
if($_SERVER["REQUEST_METHOD"]=="POST"&&isset($_POST['phpmyadminquit'])||$_SERVER["REQUEST_METHOD"]=="POST"&&isset($_POST['reset']))
	{
		header('Location: /feed.php');
	}
if($_SERVER["REQUEST_METHOD"]=="POST"&&isset($_POST['phpmyadmin']))
	{
?>
<iframe src="http://localhost/phpmyadmin/" style="width: 100%;height:95%;"></iframe>
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
	<div id="userbox">
	<p id="username"><?=$_SESSION['username'];?></p>
	</div>
		<div id="mainpage">
		<form method="post">
		<input type="submit" value="Fő oldal" name="reset">
		</form>
		</div>
		<div class="logout">
		
			<form method="post" action="logout.php" id="logoutform">
			
				<input type="submit" name="logout" value="Kijelentkezés" class="logoutinput">
			</form>
		</div>
		<?php
			if($_SESSION['username']=="admin"||$_SESSION['username']=="steamhunter")
			{
			
				if(isset($_POST['phpmyadmin']))
				{
				?>
				<div style="background-color:#da4f38;width: 300px;height: 60;float:left;border: 1px red solid;">
				<?php
				}else
				{
				?>
				<div style="background-color:#da4f38;width: 150px;height: 60;float:left;border: 1px red solid;">
				<?php
				}
				?>
				<form method="post" action="" style="width:100%; float:left;">
				
				<input type="submit" name="phpmyadmin" value="phpmyadmin" style="background-color:#da4f38;width: 150px;height: 60;float:left;    font-weight: bold;">
				<?php
				if(isset($_POST['phpmyadmin']))
				{
				?>
				<input type="submit" name="phpmyadminquit" value="phpmyadminquit" style="background-color:#da4f38;width: 150px;height: 60;float:left;border-left:1px;border-style:solid;border-color:red;     font-weight: bold;">
				<?php
				}
				?>
				</form>
				</div>
			<?php
			}
			?>
	</div>
	<?php
	
			include("postfeed.php");
	?>
	
		
		
	
	</body>
	
</html>