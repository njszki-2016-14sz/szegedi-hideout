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
	<div id="userbox">
	<p id="username"><?=$_SESSION['username'];?></p>
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
				<div style="background-color:#f9a56a;width: 300px;height: 60;float:left;border: 1px red solid;">
				<?php
				}else
				{
				?>
				<div style="background-color:#f9a56a;width: 150px;height: 60;float:left;border: 1px red solid;">
				<?php
				}
				?>
				<form method="post" action="" style="width:100%; float:left;">
				
				<input type="submit" name="phpmyadmin" value="phpmyadmin" style="background-color:#f9a56a;width: 150px;height: 60;float:left;    font-weight: bold;">
				<?php
				if(isset($_POST['phpmyadmin']))
				{
				?>
				<input type="submit" name="phpmyadminquit" value="phpmyadminquit" style="background-color:#f9a56a;width: 150px;height: 60;float:left;border-left:1px;border-style:solid;border-color:red;     font-weight: bold;">
				<?php
				}
				?>
				</form>
				</div>
			<?php
			}
			?>
	</div>
	</div>
	<div id="content">
		<div id="leftsidebar">
		<div class="titlebar">
		<p class="titlebar-title">left</p>
		</div>
		<div class="">
		<p class="">könyvjelzős posztok</p>
		</div>
		</div>
		<div id="rightsidebar">
		<div class="titlebar">
		<p class="titlebar-title">right</p>
		</div>
		<div class="">
		<p class="">új posztok</p>
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
			
		if($_SESSION['rankid']>=99)
		{
		?>
		<div class="feed">
		<div class="titlebar">
			<p class="titlebar-title">ÚJ POSZT</p>
		</div>
		<form method="post" action="poszt.php" id="newpost">
		<div class="feedcontent">
				
				<p>poszt címe</p>
				<input type="text" name="posttitle" style="border:1px solid red;">
				
				<p>poszt szövege</p>
				<textarea name="comment" form="newpost" id="textareaposzt" style="border:1px solid red;"></textarea>
		</div>
		<div class="feedfooter">
				<input type="submit" value="poszt" name="post">
		</div>
		</form>
		</div>
		<?php
		}
		?>
		
		</div>
	</div>
		
	
		
		
	
	</body>
	
</html>