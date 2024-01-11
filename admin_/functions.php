<?
	$mysqli = new mysqli("localhost","root","","fox-club");
	$mysqli->query("SET NAMES'utf8'");
	date_default_timezone_set('Europe/Moscow');
	$secret_key = md5('253');
	class func{
		function login(){
			header("location:http://fox-club.ru/admin/index.php?act=menu");
		}
		function const_menu(){
			global $mysqli,$templ;
			$data='';
			$result = $mysqli->query("SELECT * FROM `logs` ORDER BY `edit_date` DESC LIMIT 10;");
			if (mysqli_num_rows($result)){
				while (($row=$result->fetch_assoc())!=false) {
					$data.='<li>'.$row['user'].'/'.$row['name'].'/'.date('H:i d/m/Y',$row['edit_date']).'</li>';
				}
			}
			$content=$templ->const_menu($data);
			$this->print_page($content);
		}
		function menu(){
			global $mysqli,$templ;
			$act=(isset($_GET['act']))?$_GET['act']:'';
			$data=array();
			$data='';
			if($act!='menu'){
				$result = $mysqli->query("SELECT * FROM `admin_menu` WHERE `status`=1 AND `url` NOT LIKE '%{$act}%' ORDER BY `position`");
				}else{
				$result = $mysqli->query("SELECT * FROM `admin_menu` WHERE `status`=1 AND `id` NOT LIKE 4  ORDER BY `position`");
			}
			if (mysqli_num_rows($result)){
				while (($row=$result->fetch_assoc())!=false) {
					$data.='<a href="'.$row['url'].'"><li>'.$row['title'].'</li></a>';
				}
			}
			return $templ->menu($data);
		}
		function action_manga(){
			global $mysqli,$templ,$secret_key;
			$table='';
			$cont='';
			$checkman = array();
			$checkchap=array();
			$id=(isset($_GET['id']))?$_GET['id']:'';
			$do=(isset($_GET['do']))?$_GET['do']:'';
			$table=$templ->action_table();
			if($do==''){
				$result=$mysqli->query("SELECT * FROM `manga`");
				while (($row=$result->fetch_assoc())!=false){
					$chaps=$mysqli->query("SELECT * FROM `manga_chapter`WHERE `manga_id`={$row['id']}");
					$row['count'] = mysqli_num_rows($chaps);
					while (($chapter=$chaps->fetch_assoc())!=false) {
						$checkchap=$chapter;
					}
					$row['date']=date('H:i d/m/Y',$row['add_data']);
					$cont.= $templ->action_manga_row($row);
				}
				$content=$templ->action_manga($cont,$table);
			}
			if($do=='mangachap'){
			$result=$mysqli->query("SELECT * FROM `manga_chapter`WHERE `manga_id`='{$id}'");
				while (($row=$result->fetch_assoc())!=false){
					$row['date']=date('H:i d/m/Y',$row['add_data']);
					if ($row['id']==$id) 
					$checkman=$row;
					$cont.= $templ->action_chap_row($row);
				}
				$content=$templ->action_manga($cont,$table);
			}
			if($checkman){
			echo('/'.$do.'/');
				if($_GET['do']=='deletemanga'){
					$mysqli->query("DELETE FROM `manga` WHERE `id`='$id'");
					$mysqli->query("DELETE FROM `manga_chapter` WHERE `manga_id`='$id'");
					header("location:index.php?act=manga");
				}
				if($do=='activmanga'){
					if($checkman['status']){
						$mysqli->query("UPDATE `manga` SET `status` = '0' WHERE `id` = '$id'");
						}else{
						$mysqli->query("UPDATE `manga` SET `status` = '1' WHERE `id` = '$id'");
					}
					header("location:index.php?act=manga");
					exit;
				}
				if($do=='editmanga'){
					die('22');
					foreach ($checkman as $key => $value) {
						
						$checkman[$key]= html_entity_decode($value);
					}
					$content=$templ->edit_manga($checkman,$secret_key);
				}
				if($do=='activchapter' && $checkchap['manga_id']){
					$manga_id=$checkchap['manga_id'];
					if($checkchap['status']){
						$mysqli->query("UPDATE `manga_chapter` SET `status` = '0' WHERE `id` = '$id'");
						}else{
						$mysqli->query("UPDATE `manga_chapter` SET `status` = '1' WHERE `id` = '$id'");
					}
					header("location:index.php?act=manga&do=mangachap&id=$manga_id");
					exit;
				}
				if($do=='editchapter' && $checkchap['manga_id']){
					$content=$templ->edit_chapter($checkman);
				}	
				if($do=='deletechapter' && $checkchap['manga_id']){
					$manga_id=$checkchap['manga_id'];
					$mysqli->query("DELETE FROM `manga_chapter` WHERE `id`='$id'");
					header("location:index.php?act=manga&do=mangachap&id=$manga_id");
					exit;
				}
			}
			$this->print_page($content);
		}
		function action_anime(){
			global $mysqli,$templ,$secret_key;
			$table='';
			$content='';
			$checanim = array();
			$checkchap=array();
			$id=(isset($_GET['id']))?$_GET['id']:'';
			$do=(isset($_GET['do']))?$_GET['do']:'';
			$table=$templ->action_table();
			$result=$mysqli->query("SELECT * FROM `anime`");
			while (($row=$result->fetch_assoc())!=false){
				$episod=$mysqli->query("SELECT * FROM `anime_chapter`WHERE `anime_id`={$row['id']}");
				$row['count'] = mysqli_num_rows($episod);
				while (($chapter=$episod->fetch_assoc())!=false) {
					if ($chapter['id']==$id) $checkchap=$chapter;
				}
				$row['date']=date('H:i d/m/Y',$row['add_data']);
				if ($row['id']==$id) $checanim=$row;
				if (!$do) $content.= $templ->action_anime_row($row);
			}
			if($do=='animepisod'){
				$result=$mysqli->query("SELECT * FROM `anime_chapter`WHERE `anime_id`='$id'");
				while (($row=$result->fetch_assoc())!=false){
					$row['date']=date('H:i d/m/Y',$row['add_data']);
					$content.= $templ->action_episod_row($row);
				}
			}
			if($checanim){
				if($do=='deleteanime'){
					$mysqli->query("DELETE FROM `anime` WHERE `id`='$id'");
					$mysqli->query("DELETE FROM `anime_chapter` WHERE `anime_id`='$id'");
					header("location:index.php?act=anime");
				}
				if($do=='activanime'){
					if($checanim['status']){
						$mysqli->query("UPDATE `anime` SET `status` = '0' WHERE `id` = '$id'");
						}else{
						$mysqli->query("UPDATE `anime` SET `status` = '1' WHERE `id` = '$id'");
					}
					header("location:index.php?act=anime");
					exit;
				}
				if($do=='editanime'){
					$content.=$templ->edit_anime($checanim);
				}
			}
			
			if($do=='activepisod' && $checkchap['anime_id']){
				$manga_id=$checkchap['anime_id'];
				if($checkchap['status']){
					$mysqli->query("UPDATE `anime_chapter` SET `status` = '0' WHERE `id` = '$id'");
					}else{
					$mysqli->query("UPDATE `anime_chapter` SET `status` = '1' WHERE `id` = '$id'");
				}
				header("location:index.php?act=anime&do=animepisod&id=$manga_id");
				exit;
			}
			
			if($do=='deletepisod' && $checkchap['anime_id']){
				$manga_id=$checkchap['anime_id'];
				$mysqli->query("DELETE FROM `anime_chapter` WHERE `id`='$id'");
				header("location:index.php?act=anime&do=animepisod&id=$manga_id");
			}
			if($do=='editepisod' && $checkchap['anime_id']){
				$content=$templ->edit_anime($checanim);
			}
			$this->print_page($templ->action_anime($content,$table));
			
			
		}
		function print_page($content=''){
			global $templ;
			$body = $templ->header();
			$body.= $this->menu();
			$body.= $content;
			$body.= $templ->footer();
			print $body;
			exit;
		}
		
	}
?>
