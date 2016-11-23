<?php
function GetColorByRank($rankid)
{
	switch($rankid)
	{
		case 99:return "#efff00;";
		default:return "#6af98f";
	
	}
}
if($_SERVER["REQUEST_METHOD"]=="POST"&&isset($_POST['reset']))
	{	
			header('Location: /index.php');
	}
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
			
			if(strlen($_POST['username'])<5)
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
		<link rel="stylesheet" href="reg.css">
	</head>
	<body>
	<div id="header">
	<div id="login">
	<form method="post" action="login.php" id="loginform">
	<div id="logintexts">
	<input type="text" name="username" class="logintextbox">
	<input type="password" name="password" class="logintextbox">
	<?php
	if(isset($_SESSION['hiba']))
	{
	print "<div>";
	print $_SESSION['hiba'];
	print "</div>";
	$_SESSION['hiba']=null;
	}
	?>
	</div>
	<input type="submit" name="login" value="Bejelentkezés" id="loginbt">
	
	</form>
	
	</div>
	<div id="mainpage">
		<form method="post">
		<input type="submit" value="Fő oldal" name="reset">
		</form>
		</div>
	</div>
		<div id="register">
			<form method="post">
				<p id="error"><?=$hibatext?></p>
				<p>felhasználónév</p>
				
				<input type="text" name="username">
				<p>e-mail cím</p>
				<input type="text" name="email">
				<p>jelszó</p>
				<input type="password" name="password">
				<p>jelszó ismét</p>
				<input type="password" name="passwordagain">
				<input type="submit" name="login" value="regisztrálás" class="regbt">
			</form>
		</div>
		<div id="rightsidebar">
		<div class="titlebar">
		<p class="titlebar-title">új posztok</p>
		<?php
		if(isset($_SESSION['userid']))
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
			$userid=$_SESSION['userid'];
			
			$lastseen=mysql_query("SELECT lastseen FROM `users` WHERE id=$userid");
			$lastseenf= mysql_fetch_array($lastseen);
			$lastseen=$lastseenf[0];
			
			$res = mysql_query("SELECT * FROM `feedposts` WHERE postdate> '$lastseen' ORDER BY id DESC;", $db);
			$postok=array();
			while($fetch=mysql_fetch_array($res))
			{
			$posttitle=$fetch['posttitle'];
			$postid=$fetch['id'];
			echo("<a class='titlebar-title' href='post.php?postid=$postid'> $posttitle</a>");
			echo("<br>");
			}
			
			mysql_query("UPDATE `users` SET `lastseen` = NOW() WHERE `users`.`id` ='$userid';");
		}else
		{
			print "<p>bejelentkezés szükséges</p>";
		}
		?>
		</div>
		</div>
		<div>
		
		
		<div id="centerfeed">	
		<?php
		
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
				<?php
				$userid=$record['userid'];
				$ress = mysql_query("SELECT * FROM users WHERE id='$userid';", $db);
				$rec = mysql_fetch_assoc($ress);
				$bg="background-color: ".GetColorByRank($rec['rankid']).";";
				$username=$rec['username'];
				print"<p id='senderbox' style='$bg'>$username</p>"
				?>
				<form method="post" class="commnethidder">
				<input type="submit" name="comment" value="hozzászólások" class="commentbt">
				<input type="hidden" name="postid" value=<?=$record['id'];?>>
				
				</form>
				</div>
				</div>
				<?php
				if(isset($_SESSION['postid']))
					{
						$_POST['postid']=$_SESSION['postid'];
						$_POST['comment']="hozászólás";
						$_SESSION['postid']=null;
					}
				if(isset($_POST['comment']))
				{
					
					if($_POST['postid']==$record['id'])
					{
					
					mysql_select_db('facebookclonecomment', $db);
					$cmtres = mysql_query("SELECT * FROM postcomment".$_POST['postid'].";", $db);
					mysql_select_db('facebookclone', $db);
					print mysql_error();
						while($cmtrecord = mysql_fetch_assoc($cmtres)){
						?>
							<div class="feedcomment">
							
							<div class="feedcommentcontent">
							<?=$cmtrecord['comment']?>
							</div>
							<div class="feedfooter">
								<?php
								$userid=$cmtrecord['userid'];
								$ress = mysql_query("SELECT * FROM users WHERE id='$userid';", $db);
								$rec = mysql_fetch_assoc($ress);
								?>
								<div class="feedfooter">
								
								<?php
								$bg="background-color: ".GetColorByRank($rec['rankid'])."; margin:0;";
								$username=$rec['username'];
								print"<p id='senderbox' style='$bg'>$username</p>"
								?>
								</div>
								
								</form>
							</div>
						<?php
						}
					
					}
				}
			}
			?>
		</div>
	
	</body>
</html>
				<?php
			}
			if(/*strlen($_POST['username'])>5 $_POST['password']==$_POST['passwordagain']*/!isset($hiba))
			{
				$username= $_POST['username'];
				$pass= MD5($_POST['password']);
				$email=$_POST['email'];
			$res = mysql_query("INSERT INTO `users` (`id`, `username`, `password`, `e-mail`) VALUES (NULL,'$username', '$pass', '$email');", $db);
			print mysql_error();
			header('Location: /index.php');
			}
	}else
	{
?>
<html>
	<head>
		<title>nem facebook klón</title>
		<meta charset="utf8">
		<link rel="stylesheet" href="reg.css">
	</head>
	<body>
	<div id="header">
	<div id="login">
	<form method="post" action="login.php" id="loginform">
	
	<input type="text" name="username" class="logintextbox">
	<input type="password" name="password" class="logintextbox">
	<input type="submit" name="login" value="Bejelentkezés" id="loginbt">
	</form>
		<div id="mainpage">
		<form method="post">
		<input type="submit" value="Fő oldal" name="reset">
		</form>
		</div>
	</div>
	</div>
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
				<input type="submit" name="login" value="regisztrálás" class="regbt">
			</form>
		</div>
		<div id="rightsidebar">
		<div class="titlebar">
		<p class="titlebar-title">új posztok</p>
		<?php
		if(isset($_SESSION['userid']))
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
			$userid=$_SESSION['userid'];
			
			$lastseen=mysql_query("SELECT lastseen FROM `users` WHERE id=$userid");
			$lastseenf= mysql_fetch_array($lastseen);
			$lastseen=$lastseenf[0];
			
			$res = mysql_query("SELECT * FROM `feedposts` WHERE postdate> '$lastseen' ORDER BY id DESC;", $db);
			$postok=array();
			while($fetch=mysql_fetch_array($res))
			{
			$posttitle=$fetch['posttitle'];
			$postid=$fetch['id'];
			echo("<a class='titlebar-title' href='post.php?postid=$postid'> $posttitle</a>");
			echo("<br>");
			}
			
			mysql_query("UPDATE `users` SET `lastseen` = NOW() WHERE `users`.`id` ='$userid';");
		}else
		{
			print "<p>bejelentkezés szükséges</p>";
		}
		?>
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
				<?php
				$userid=$record['userid'];
				$ress = mysql_query("SELECT * FROM users WHERE id='$userid';", $db);
				$rec = mysql_fetch_assoc($ress);
				$bg="background-color: ".GetColorByRank($rec['rankid'])."; margin:0; margin-right:15px;";
				$username=$rec['username'];
				print"<p id='senderbox' style='$bg'>$username</p>"
				?>
				<form method="post" class="commnethidder">
				<input type="submit" name="comment" value="hozzászólások" class="commentbt">
				<input type="hidden" name="postid" value=<?=$record['id'];?>>
				
				</form>
				</div>
				</div>
				<?php
				if(isset($_SESSION['postid']))
					{
						$_POST['postid']=$_SESSION['postid'];
						$_POST['comment']="hozászólás";
						$_SESSION['postid']=null;
					}
				if(isset($_POST['comment']))
				{
					
					if($_POST['postid']==$record['id'])
					{
					
					mysql_select_db('facebookclonecomment', $db);
					$cmtres = mysql_query("SELECT * FROM postcomment".$_POST['postid'].";", $db);
					mysql_select_db('facebookclone', $db);
					print mysql_error();
						while($cmtrecord = mysql_fetch_assoc($cmtres)){
						?>
							<div class="feedcomment">
							
							<div class="feedcommentcontent">
							<?=$cmtrecord['comment']?>
							</div>
							<div class="feedfooter">
								<?php
								$userid=$cmtrecord['userid'];
								$ress = mysql_query("SELECT * FROM users WHERE id='$userid';", $db);
								$rec = mysql_fetch_assoc($ress);
								?>
								<div class="feedfooter">
								
								<?php
								$bg="background-color: ".GetColorByRank($rec['rankid'])."; margin: 0; margin-right:15px;";
								$username=$rec['username'];
								print"<p id='senderbox' style='$bg'>$username</p>"
								?>
								</div>
								
								</form>
							</div>
						<?php
						}
						
					}
				}
			}
			?>
		</div>
	</body>
</html>
<?php
	}
	?>