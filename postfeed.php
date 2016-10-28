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