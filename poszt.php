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
		$res = mysql_query("INSERT INTO `feedposts` (`id`, `userid`, `posttitle`, `post`) VALUES (NULL, '$userid', '$posttitle', '$comment');", $db);
		print mysql_error();
		header('Location: /feed.php');



?>