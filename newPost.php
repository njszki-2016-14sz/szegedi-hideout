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
		session_start();
		$userid=$_SESSION['userid'];
		$posttitle=$_POST['posttitle'];
		$comment=$_POST['comment'];
		//
		mysql_query("INSERT INTO `feedposts` (`id`, `userid`, `posttitle`, `post`,`postdate`) VALUES (NULL, '$userid', '$posttitle', '$comment',now());", $db);
		$res = mysql_query("SELECT * FROM feedposts ORDER BY id DESC LIMIT 1;", $db);
		$postdata=mysql_fetch_assoc($res);
		$postid=$postdata['id'];
		$tablename='postcomment'.$postid;
		mysql_query("CREATE TABLE `facebookclonecomment`.".$tablename." ( `id` INT NOT NULL AUTO_INCREMENT , `userid` INT NOT NULL , `comment` VARCHAR(512) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;", $db);
		print mysql_error();
		header('Location: /feed.php');



?>