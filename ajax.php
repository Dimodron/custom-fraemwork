<?
	class ajax{
		function const(){
			$action = (isset($_POST['action']))?$_POST['action']:"";
			switch ($action) {
				case 'search':
				$this->search();
				break;
				case 'bot':
				$this->bot();
				break;
			}
		}
		function search(){
			global $mysqli;
			$word="%".$_POST["name"]."%";
			$result_set=$mysqli->query("SELECT * FROM `manga`WHERE `name` LIKE '$word' AND `status`=1");
			while (($row_manga=$result_set->fetch_assoc())!=false) {
			?>
			<a href="index.php?act=manga&id=<?=$row_manga["id"]?>"><li><img src="<?=$row_manga["way"]?>/<?=$row_manga["file_name"]?>"/></div><span><?=$row_manga["name"]?></span>
				<span>manga<span>
				</li></a>
				<?
				}
				$result_set=$mysqli->query("SELECT * FROM `anime`WHERE `name` LIKE '$word' AND `status`=1");
				while (($row_anime=$result_set->fetch_assoc())!=false) {
				?>
				<a href="index.php?act=anime&id=<?=$row_anime["id"]?>"><li><img src="<?=$row_anime["way"]?>/<?=$row_anime["file_name"]?>"/></div><span><?=$row_anime["name"]?></span>
					<span>anime<span>
					</li></a>
					<?
					}
				}
				function bot(){
					global $mysqli,$templ;
					$bot_id=$_POST['bot_id'];
					$row=$mysqli->query("SELECT * FROM `bot_menu`  WHERE `id`='$bot_id' ");
					$contain=mysqli_fetch_array($row);
					print $templ->chat_bot($contain);
					exit;
				}
			}
		?>
		