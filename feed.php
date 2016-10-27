<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"&&isset($_POST['phpmyadminquit']))
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
	<p id="username"><?=$_SESSION['username'];?></p>
		<div id="logout">
		<?php
			if($_SESSION['username']=="admin"||$_SESSION['username']=="steamhunter")
			{
		?>
				<form method="post" action="" style="width:90px; float:left;">
				
				<input type="submit" name="phpmyadmin" value="phpmyadmin" style="width:80px; margin-right:5px; margin-left:5px;">
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
	<div id="content">
		<div id="leftsidebar">
		<div class="titlebar">
		<p class="titlebar-title">left</p>
		</div>
		</div>
		<div id="rightsidebar">
		<div class="titlebar">
		<p class="titlebar-title">right</p>
		</div>
		</div>
		
		<div id="centerfeed">
		
		<?php
		$db = mysql_connect('localhost', 'root', '');
		if(!$db){
				die('Could not connect: '.mysql_error());
				}
		$db_selected = mysql_select_db('facebookclone', $db);
		if(!$db_selected){
				die ('Can\'t use: '. mysql_error());
			}
			mysql_query("SET NAMES utf8", $db);		
			$res = mysql_query("SELECT * FROM feedposts ORDER BY id DESC;", $db);
				
			
			while($record = mysql_fetch_assoc($res)){
				
				?>
				
				<div class="feed">
					<div class="titlebar">
					<p class="titlebar-title"><?= $record['posttitle']?></p>
					</div>
				<div class="feedcontent">
				<?=$record['post']?>
				</div>
				<div class="feedfooter">
				
				</div>
				</div>
			
		
				<?php
				
			}
			
?>
		</div>	
	</div>
		
	
		
		
	</div>
	</body>
	
</html>