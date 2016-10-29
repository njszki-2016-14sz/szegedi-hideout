<?php
			/*<form method="post" action="commenter.php" id="newcommentform">
			div class="feedcontent">
			<input type="hidden" name="postid" value=<?=$record['id'];?>>
			<textarea name="comment" form="newpost" id="textareacomment" style="border:1px solid red;"></textarea>
			</div>
			<div class="feedfooter">
			<input type="submit" value="hozászólás" name="post">
			</div>
			</form>*/
		$db = mysql_connect('localhost', 'root', '');
		if(!$db){
				die('Could not connect: '.mysql_error());
				}
		$db_selected = mysql_select_db('facebookclonecomment', $db);
		if(!$db_selected){
				die ('Can\'t use: '. mysql_error());
		}
		mysql_query("SET NAMES utf8", $db);
		session_start();
		$userid=$_SESSION['userid'];
		$postid=$_POST['postid'];
		$comment=$_POST['comment'];
		mysql_query("INSERT INTO postcomment".$postid." (`id`, `userid`, `comment`) VALUES (NULL, ".$userid.", '$comment');", $db);
		print mysql_error();
		$_SESSION['postid']=$postid;
		header('Location: /feed.php');

?>