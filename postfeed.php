
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
		<div>
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
			
		?>
		</div>
		</div>
		<div id="centerfeed">	
		<?php
		
			$res = mysql_query("SELECT * FROM feedposts ORDER BY id DESC;", $db);
			while($record = mysql_fetch_assoc($res)){
				?>
				<div class="feed">
					<div class="titlebar">
					<?php

					
					$posttitle=$record['posttitle'];
					$postid=$record['id'];
					echo("<a class='titlebar-title' href='post.php?postid=$postid'> $posttitle</a>");
					
					?>
					
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
								
								
								<?php
								$bg="background-color: ".GetColorByRank($rec['rankid']).";";
								$username=$rec['username'];
								print"<p id='senderbox' style='$bg'>$username</p>"
								?>
								
								
								</form>
							</div>
						<?php
						}
						
						
						if(isset($_SESSION['userid']))
						{
						?>
						<div class="newcomment">
						<div class="titlebar">
						<p class="titlebar-title">új hozászólás</p>
						</div>
						<form method="post" action="commenter.php" id="newcommentform">
						<div class="feedcontent">
						<input type="hidden" name="postid" value=<?=$record['id'];?>>
						<textarea name="comment" form="newcommentform" id="textareacomment" style="border:1px solid red;"></textarea>
						</div>
						<div class="feedfooter">
						<input type="submit" value="hozászólás" name="post" class="commentbt">
						</div>
						</form>
						</div>
					<?php
						}
					}
				}
			}
		if(isset($_SESSION['rankid']))
		{			
			if($_SESSION['rankid']>=99)
			{
			?>
			<div class="feed">
			<div class="titlebar">
				<p class="titlebar-title">ÚJ POSZT</p>
			</div>
			<form method="post" action="newPost.php" id="newpost">
			<div class="feedcontent">
					<p>poszt címe</p>
					<input type="text" name="posttitle" style="border:1px solid red;">
					<p>poszt szövege</p>
					<textarea name="comment" form="newpost" id="textareaposzt" style="border:1px solid red;"></textarea>
			</div>
			<div class="feedfooter">
					<input type="submit" value="poszt" name="post" class="commentbt">
			</div>
			</form>
			</div>
			<?php
			}
		}
			?>
		</div>
</div>