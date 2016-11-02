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
			$username=$_POST['username'];
			$pass=md5($_POST['password']);
			$res = mysql_query("SELECT * FROM users WHERE username='$username' ;", $db);
			session_start();		
			$record = mysql_fetch_assoc($res);
				if($pass==$record['password'])
				{
					$userid=$record['id'];
					mysql_query("UPDATE `users` SET `lastlogin` = NOW() WHERE `users`.`id` ='$userid' ;");
						$_SESSION['userid']=$record['id'];
						$_SESSION['username']=$record['username'];
						$_SESSION['rankid']=$record['rankid'];
					header('Location: /feed.php');
				}else
				{
					$_SESSION['hiba']="jelszó nem egyezik";
					header('Location: /index.php');
				}
			
?>