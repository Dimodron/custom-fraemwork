<?
	$mysqli = new mysqli("localhost","root","","fox-club");
	$mysqli->query("SET NAMES'utf8'");
	date_default_timezone_set('Europe/Moscow');
	//через теги реализоватть вещи которые будут повтаряться в жанрах чтобы ссылк были разные или одна
	$secret_key = md5('253');// защита от ботов запилить на ввод 17.12.2019
	$time=time();
	class func{
		function __construct(){
		}
		function addmanga(){
			global $templ,$mysqli;
			
			$content=$templ->addmanga(); 
			$this->print_page($content);
		}
		function manga(){
			global $templ,$mysqli,$site_url,$time;
			$data = '';
			(isset($_POST['do']))?'':$_POST['do']='';
			$do_m = array('editmanga','deletmanga','activmanga','addmanga');//допустимые do для манги
			$do_c = array('editchapter','deletchapter','activchapter','addchapter');//допустимые do для глав манги
			$act = (isset($_GET['act']))?$_GET['act']:"";
			$id = (isset($_GET['id']))?$_GET['id']:"";
			$id = (!is_numeric($id))?'':$id;//проверка на число
			$do = (isset($_GET['do']))?$_GET['do']:"";
			if($act == 'manga'){
				if($do == '' && $id == ''){
					$manga = $mysqli->query("SELECT * FROM `manga`");
					if (mysqli_num_rows($manga)){
						while (($row=$manga->fetch_assoc())!=false) {
							$status=($row['status']==1)?'Да':'Нет';
							$data.='<tr>
										<td><a href="'.$site_url.'/index.php?act=manga&id='.$row['id'].'&do=editmanga" >'.$row['name'].'</a></td>
										<td>'.$status.'</td>
										<td><a href="'.$site_url.'/index.php?act=manga&id='.$row['id'].'&do=activmanga " >Активировать</a></td>
										<td><a href="'.$site_url.'/index.php?act=manga&id='.$row['id'].'&do=deletmanga" >Удалить</a></td>
									</tr>';
						}
						$content=$templ->manga($data); 
						$do = 'manga';
					}else{
						die('manga not in bd');
					}
				}				
				if($id != '' && $do != ''){
					if(in_array($do, $do_m)){
						$manga = $mysqli->query("SELECT * FROM `manga` WHERE `id` = {$id}");
						if (mysqli_num_rows($manga)){
							$data = mysqli_fetch_array($manga);
							if($do=='deletmanga'){			
								$mysqli->query("DELETE FROM `manga` WHERE `id`='{$id}'");
								header("location:{$site_url}/index.php?act=manga");
							}
							if($do=='activmanga'){
								if($data['status']=='1'){
									$mysqli->query("UPDATE `manga` SET `status` = '0' WHERE `id` = {$id}");
								}else{
									$mysqli->query("UPDATE `manga` SET `status` = '1' WHERE `id` = {$id}");
								}
								header("location:{$site_url}/index.php?act=manga");
								exit;
							}
							if($do=='editmanga'){
								$chapter=$mysqli->query("SELECT * FROM `manga_chapter` WHERE `manga_id` = {$id}");
								if (mysqli_num_rows($chapter)){
									if($_POST['do']=='addchapter'){
										$sql_data = '';
											$sql_data.= "`name`='".$_POST['name']."',";
											$sql_data.= "`genre`='".$_POST['genre']."',";
											$sql_data.= "`edit_data`='".time()."',";
											$sql_data.= "`status`='".(isset($_POST['status'])?'1':'0')."'";
														
										die($sql_data);
										$mysqli->query("UPDATE `manga` SET {$sql_data} WHERE `id` = {$id}");
										//die();
										header("location:{$site_url}/index.php?act=manga&id={$id}&do=editmanga");
										exit;
									}else{
										$chapters = '';
										while (($row=$chapter->fetch_assoc())!=false) {
											$status=($row['status']==1)?'Да':'Нет';
											$chapters.='<tr>
															<td><a href = "'.$site_url.'/index.php?act=mangachap&id='.$row['id'].'&do=editchapter" >'.$row['chapter_name'].'</a></td>
															<td>'.$status.'</td>
															<td><a href = "'.$site_url.'/index.php?act=mangachap&id='.$row['id'].'&do=activchapter" >Активировать</a></td>
															<td><a href = "'.$site_url.'/index.php?act=mangachap&id='.$row['id'].'&do=deletchapter" >Удалить</a></td>
														</tr>';
										}
									}
								}
								$content=$templ->edit_manga($data,$chapters);
							}						
						
						}else{
							die('404 Not Found');
						}
					}else{
						die('404 Not Found');
					}		
				}else{
					if($do =='addmanga'){
							$content=$templ->addmanga($id);
							//post if
						}elseif($do != 'manga'){
							die('404 Not Found');
						}
				}	
			}
			//работа с главами манги
			if($act == 'mangachap'){
				if($id != '' && $do != ''){
					if(in_array($do, $do_c)){
						if($do =='addchapter'){
							$content=$templ->addchapter($id);
						}else{
							$chapter = $mysqli->query("SELECT * FROM `manga_chapter` WHERE `id` = {$id}");
							if (mysqli_num_rows($chapter)){
								$data = mysqli_fetch_array($chapter);
								if($do=='editchapter'){
									$content=$templ->edit_chapter($data);
									//if(post)
								}	
								if($do=='deletchapter'){
									$way = '../'.$data['way'].'/chapter_'.$data['chapter'];
									if(file_exists($way)){
										if(is_dir($way)){
											if ($handle = opendir($way)) {
												while (false !== ($entry = readdir($handle))) {
													if($entry=="." || $entry == "..") continue;
														unlink($way.'/'.$entry);
												}
												if(rmdir($way)){
													$mysqli->query("DELETE FROM `manga_chapter` WHERE `manga_id`='{$data['id']}'");
												}else{
													die('error');
												}
												closedir($handle);						
											}
										}
									}else{
										$mysqli->query("DELETE FROM `manga_chapter` WHERE `id`='{$id}'");
									}
									header("location:{$site_url}/sendbd.php?act=manga&id={$data['manga_id']}&do=deletchapter");
									exit;
								}
								if($do=='activchapter'){
									if($data['status'] == 1){
										$mysqli->query("UPDATE `manga_chapter` SET `status` = '0' WHERE `id` = {$id}");
									}else{
										$mysqli->query("UPDATE `manga_chapter` SET `status` = '1' WHERE `id` = {$id}");
									}
									header("location:{$site_url}/index.php?act=manga&id={$data['manga_id']}&do=editmanga");
									exit;
								}
							}else{
								die('404 Not Found');
							}
						}
					}else{
						die('404 Not Found');
					}
				}else{
					die('404 Not Found');
				}
			}
			$this->print_page($content);
		}
		function firstpage(){
			global $templ,$mysqli;
			$data='';
			$result = $mysqli->query("SELECT * FROM `logs` ORDER BY `edit_date` DESC LIMIT 10;");
			if (mysqli_num_rows($result)){
				while (($row=$result->fetch_assoc())!=false) {
					$data.='<li>'.$row['name'].'|'.$row['user'].'|'.date('H:i | d/m/Y',$row['edit_date']).'</li>';
				}
			}
			$content=$templ->firstpage($data);
			$this->print_page($content);
		}
		function login(){
			global $templ,$mysqli;
			$content=$templ->login();
			$this->print_page($content);
		}
		function menu_list(){// меню с перечнем
			global $mysqli,$templ;
		$act=(isset($_GET['act']))?$_GET['act']:'чат бот';
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
		return $templ->menu_list($data);
		}
		function print_page($content=''){
			global $templ;
			$body = $templ->header();
			$body.= $this->menu_list();
			$body.= $content;
			$body.= $templ->footer();
			print $body;
		exit;
		}
		
	}
?>
