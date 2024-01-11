<?
	$mysqli = new mysqli("localhost","root","","fox-club");
	$mysqli->query("SET NAMES'utf8'");
	date_default_timezone_set('Europe/Moscow');
	class func{
		function chat_bot($action){
			global $templ, $mysqli,$user;
			$usem=$user->member;
			$usemid=$usem['id'];
			if($usemid==0){
				$row=$mysqli->query("SELECT * FROM `bot_menu` WHERE `id` = 1  ");
				$contain=mysqli_fetch_array($row);
				$contain['logauth']='<span id="login">Вход</span>
				<span id="registr">Регистрация</span>';
				}else{
				$row=$mysqli->query("SELECT * FROM `bot_menu` WHERE `id` = 1  ");
				$contain=mysqli_fetch_array($row);
				$contain['logauth']='<form action="index.php?act=logout" method="post" enctype="multipart/form-data">
				<input  type="submit" value="Выход"/>
				</form>';
			}
			return $templ->chat_bot($contain);
		}
		function header(){
			global $templ, $mysqli;
			$background='';
			$logo='';
			if (isset($_GET['act'])) {
				$tab=$_GET['act'];
			}
			if (isset($tab)) {
				switch ($tab) {
					case 'anime':
					$background = "bg_dark.jpg";
					$logo="fox_dark.png";
					break;
					case 'manga':
					$background = "bg_light.jpg";
					$logo="fox_light.png";
					break;
					default:
					$background = "bg_light.jpg";
					$logo="fox_light.png";
					break;
					
				}
				return $templ->header('',$background,$logo);
			}else{$background = "bg_light.jpg";$logo="fox_light.png";return $templ->header('',$background,$logo);}
		}
		
		function slideshow(){
		global $templ, $mysqli;
		$content = '<div class="slideshow">';
		$content.= '<div class="left"><</div>';
		$content.= "<ul>";
		$result_set = $mysqli->query("SELECT * FROM `slideshow` WHERE `status`=1 ORDER BY `position`");
		if (mysqli_num_rows($result_set)){
		while (($row_slide=$result_set->fetch_assoc())!=false) {
        $content.=$templ->slideshow($row_slide);
		}
		}
		$content.= '</ul>';
		$content.= '<div class="right">></div>';
		$content.= '<div class="count"></div>';
		$content.= "</div>";
		return $content;
		}
		function slideshow_anime(){
		global $templ, $mysqli;
		$content = '<div class="slideshow">';
		$content.= '<div class="left"><</div>';
		$content.= "<ul>";
		$result_set = $mysqli->query("SELECT * FROM `slideshow` WHERE `status`=1 ORDER BY `position`");
		if (mysqli_num_rows($result_set)){
		while (($row_slide=$result_set->fetch_assoc())!=false) {
        $content.=$templ->slideshow($row_slide);
		}
		}
		$content.= '</ul>';
		$content.= '<div class="right">></div>';
		$content.= '<div class="count"></div>';
		$content.= "</div>";
		return $content;
		}
		function PopularManga(){
		global $templ,$mysqli;
		$content="";
		$content.= "<div class='popular_m'><div class='zagolovok'>Популярная манга</div><ul>";
		$result_set=$mysqli->query("SELECT * FROM `manga` WHERE `status`=1 ORDER BY `number_of_likes` DESC");
		while (($row_pop_m=$result_set->fetch_assoc())!=false) {
		$content.=$templ->PopularManga($row_pop_m);
		}
		$content.= "</ul></div>";
		return $content;
		}
		function PopularAnime(){
		global $templ,$mysqli;
		$content="";
		$content.= "<div class='popular_mz'><div class='zagolovok'>Популярное Аниме</div><ul>";
		$result_set=$mysqli->query("SELECT * FROM `anime` WHERE `status`=1 ORDER BY `number_of_likes` DESC");
		while (($row_pop_m=$result_set->fetch_assoc())!=false) {
		$content.=$templ->PopularAnime($row_pop_m);
		}
		$content.= "</ul></div>";
		return $content;
		}
		function manga(){
		global $templ,$mysqli,$site_url;
		if(isset($_GET['id'])){
		if (isset($_GET['ch'])) {
		$ch=$_GET['ch'];
		}
		$id = $_GET['id'];
		$chapter = array();
		$result=$mysqli->query("SELECT * FROM `manga` WHERE `id` = {$id} ");
		if ($arr_manga_list=mysqli_fetch_array($result)) {
		$result=$mysqli->query("SELECT * FROM `manga_chapter` where `manga_id` ={$id} ORDER BY `chapter`");
		$arr_manga_list['count'] = mysqli_num_rows($result);
		if ($arr_manga_list['count']>0) {
        $arr_manga_list['jumpchapter']='';
        $i=0;
        $last_chapter = array();
        while (($list_manga=$result->fetch_assoc())!=false) {
		$i++;
		if ((isset($ch) && $ch==$list_manga['chapter']) || (!isset($ch) && $arr_manga_list['count'] == $i)) {$selected = "selected='selected'";}else {$selected="";}
		$arr_manga_list['jumpchapter'].="<option ".$selected." value='".$site_url."/index.php?act=manga&id=".$id."&ch=".$list_manga['chapter']."'>".$list_manga['chapter_name'].'</option>';
		if (isset($ch)) {
		if ($ch==$list_manga['chapter']) {
		$last_chapter = $list_manga;
		}
		}else{$last_chapter = $list_manga;}
        }
        $content = $templ->manga($arr_manga_list);
        $content.= $this->manga_reader($arr_manga_list['id'],$last_chapter);
        $this->print_page($content);
		}
		}
		}else{
		$manga='';
		$result=$mysqli->query("SELECT * FROM `manga` WHERE `status`=1");
		while (($result_manga=$result->fetch_assoc())!=false) {
        $manga.= '<li><a href="index.php?act=manga&id='.$result_manga["id"].'"><img src=" '.$result_manga['way'].'/'.$result_manga['file_name'].'"/><div><span>Наименование:</span>'.$result_manga['name'].'</br><span>Жанр:</span>'.$result_manga['genre'].'</br><span>Автор:</span>'.$result_manga['author'].'</br></div></a></li>';
		}
		$this->print_page($templ->manga_menu($manga));
		
		}
		}
		function anime(){
		global $templ,$mysqli,$site_url;
		if(isset($_GET['id'])){
		if (isset($_GET['ep'])) {
        $ep=$_GET['ep'];
		}
		$id = $_GET['id'];
		$anime = array();
		$result=$mysqli->query("SELECT * FROM `anime` WHERE `id` = {$id} ");
		if ($anime=mysqli_fetch_array($result)) {
        $result=$mysqli->query("SELECT * FROM `anime_chapter` where `anime_id` = {$id} ORDER BY `episode`");
        $anime['count'] = mysqli_num_rows($result);
        if ($anime['count']>0) {
		$anime['jumpseries']='';
		$i=0;
		while (($episode=$result->fetch_assoc())!=false) {
		$i++;
		if ((isset($ep) && $ep==$episode['episode']) || (!isset($ep) && $anime['count'] == $i)) {$selected = "selected='selected'";}else {$selected="";}
		$anime['jumpseries'].="<option ".$selected." value='".$site_url."/index.php?act=anime&id=".$id."&ep=".$episode['episode']."'>".$episode['episode_title'].'</option>';
		if (isset($ep)) {
		if ($ep==$episode['episode']) {
		$anime['link'] = $episode['link'];
		}
		}else{$anime['link'] = $episode['link'];}
		}
		$content=$templ->anime($anime);
		$content.=$this->anime_viewer($id,$anime);
		$this->print_page($content);
        }
		}
		}else{
		$anime='';
		$result=$mysqli->query("SELECT * FROM `anime` WHERE `status`=1");
		while (($result_anime=$result->fetch_assoc())!=false) {
		$anime.= '<li><a href="index.php?act=anime&id='.$result_anime["id"].'"><img src=" '.$result_anime['way'].'/'.$result_anime['file_name'].'"/><div><span>Наименование:</span>'.$result_anime['name'].'</br><span>Жанр:</span>'.$result_anime['genre'].'</br><span>Студия:</span><img src=" '.$result_anime['way'].'/'.$result_anime['studio'].'"/></br></div></a></li>';
		}
		$this->print_page($templ->anime_menu($anime));
		
		}
		}
		function anime_viewer($id,$anime){
		global $templ,$mysqli;
		$anime['screen']="";
		$directory = $anime['way']."/screen";    // Папка с изображениями
		$allowed_types=array("jpg", "png", "gif","jpeg");  //разрешеные типы изображений
		$file_parts = array();
		$ext="";
		$title="";
		$i=0;
		$slides="";
        //пробуем открыть папку
		if ($dir_handle = @opendir($directory) ) {
		while ($file = readdir($dir_handle)){    //поиск по файлам
		if($file=="." || $file == "..") continue;  //пропустить ссылки на другие папки
		$file_parts = explode(".",$file);          //разделить имя файла и поместить его в массив
		$ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение
		if(in_array($ext,$allowed_types)){
        $anime['screen'].= "<img src='".$directory."/".$file."''/>";
		}
		}
		}
		return $templ->anime_viewer($anime);
		}
		function manga_reader($id,$last_chapter){
		global $templ,$mysqli;
		$chapter = array();
		$chapter['jumppages']="";
		$chapter['pages']="";
		$directory = $last_chapter['way']."/chapter_".$last_chapter['chapter'];    // Папка с изображениями
		$allowed_types=array("jpg", "png", "gif","jpeg");  //разрешеные типы изображений
		$file_parts = array();
		$ext="";
		$title="";
		$i=0;
		$slides="";
        //пробуем открыть папку
		$dir_handle = @opendir($directory) or die("Ошибка при открытии папки !!!".$directory);
		while ($file = readdir($dir_handle)){    //поиск по файлам
		if($file=="." || $file == "..") continue;  //пропустить ссылки на другие папки
		$file_parts = explode(".",$file);          //разделить имя файла и поместить его в массив
		$ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение
		if(in_array($ext,$allowed_types)){
        $chapter['pages'].= "<li id='page_".$i."'><img src='".$directory.'/'.$file."'></li>";
        $chapter['jumppages'].= "<option value='#page_".$i."'>Cтраница: ".($i+1)."</option>";
		$i++;
		}
		}
		return $templ->manga_reader($chapter);
		}
		function print_page($content=""){
		global $templ,$action,$user;
		$usem=$user->member;
		$body = $this->header();
		$body.= $templ->menu();
		$body.= $templ->search();
		if (!$content) {
		if ($action=='homeanime') {
        $body.= $this->slideshow_anime();
        $body.= $this->PopularAnime();
        if ($usem['id']!=0) {
		$body.= $templ->NewChaptersOfSelectedManga();
        }
        $body.= $templ->NewChaptersOfPopularManga();
        $body.= $templ->latestUpdates();
		} else {
        $body.= $this->slideshow();
        $body.= $this->PopularManga();
        if ($usem['id']!=0) {
		$body.= $templ->NewChaptersOfSelectedManga();
        }
        $body.= $templ->NewChaptersOfPopularManga();
        $body.= $templ->latestUpdates();
		}
		} else {
		$body.= $content;
		}
		$body.= $this->chat_bot($action);
		$body.= $templ->login();
		$body.= $templ->regist();
		$body.= $templ->footer();
		print $body;
		exit;
		}
		
		}
		?>
				