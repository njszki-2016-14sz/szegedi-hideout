
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
				<?php
				$userid=$record['userid'];
				$ress = mysql_query("SELECT * FROM users WHERE id='$userid';", $db);
				$rec = mysql_fetch_assoc($ress);
				$bg="background-color: ".GetColorByRank($rec['rankid']).";";
				$username=$rec['username'];
				print"<p id='senderbox' style='$bg'>$username</p>"
				?>
				<form method="post" class="commnethidder">
				<input type="submit" name="comment" value="hozzászólások">
				<input type="hidden" name="postid" value=<?=$record['id'];?>>
				
				</form>
				</div>
				</div>
				<?php
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
							</div
							<div class="feedfooter">
								<?php
								$userid=$cmtrecord['userid'];
								$ress = mysql_query("SELECT * FROM users WHERE id='$userid';", $db);
								$rec = mysql_fetch_assoc($ress);
								?>
								<div class="feedfooter">
								
								<?php
								$bg="background-color: ".GetColorByRank($rec['rankid']).";";
								$username=$rec['username'];
								print"<p id='senderbox' style='$bg'>$username</p>"
								?>
								</div>
								
								</form>
							</div>
						<?php
						}
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
						<input type="submit" value="hozászólás" name="post">
						</div>
						</form>
						</div>
					<?php
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
		}
			?>
		</div>
	</div>