<?
$mysqli = new mysqli("localhost","root","","fox-club");
$mysqli->query("SET NAMES'utf8'");
$site_url='http://fox-club.ru/admin';
	 
	 
$do = (isset($_GET['do']))?$_GET['do']:"";
$id = (isset($_GET['id']))?$_GET['id']:"";
$status = (isset($_GET['status']))?$_GET['status']:"";
if($id != ''){
	switch($do){
		case'deletchapter':
			deletchapter($id);
		break;
		case'activchapter':
			activchapter($id,$status);
		break;
		case'editchapter':
		
		break;
		case'addchapter':
			addchapter();
		break;
		default:
			die('ERROR 404');
		break;
	}
}
	 
	 
	 
function deletmanga(){
	//$mysqli->query("DELETE FROM `manga_chapter` WHERE `id`='{$id}'");
}
function deletchapter($id){
	global $mysqli;
	
}
function editmanga(){
	$mysqli->query("DELETE FROM `manga_chapter` WHERE `id`='{$id}'");
}
function activchapter($id,$status){
	global $mysqli,$site_url;
	if($status == 1){
		$mysqli->query("UPDATE `manga_chapter` SET `status` = '0' WHERE `id` = {$id}");
	}else{
		$mysqli->query("UPDATE `manga_chapter` SET `status` = '1' WHERE `id` = {$id}");
	}
	header("location:{$site_url}/index.php?act=mangachap&id={$id}&do=editchapter");
	exit;
}
function addchapter(){
	global $mysqli;
	//die($data['id'].'|'.$data['tom'].'|'.$data['chapter_name']);
	$coincidence = $mysqli->query("SELECT * FROM `manga_chapter` WHERE `manga_id` = 7 AND `tom` = 1 AND `chapter` = 3 AND `chapter_name` LIKE 'ужас'");
	if(mysqli_num_rows($coincidence)){
		//$mysqli->query("INSERT INTO `manga_chapter` (`id`, `manga_id`, `tom`, `chapter`, `chapter_name`, `status`, `add_data`, `edit_data`, `way`) VALUES (NULL, '7', '', '', '', '1', '', '', '')");
		die('ново');
	}else{
		die('повторка');
	}
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* 
	if(is_numeric($_POST['id'])){
		$id = $_POST['id'];
		}else{
		header("location:http://fox-club.ru/admin/index.php?act=manga&do=editmanga&id=$id");
		exit;
	}
	if (!get_magic_quotes_gpc()) {
		foreach ($_POST as $key => $value) {
			$value=strip_tags($value);
			$value=htmlspecialchars($value,ENT_QUOTES);
			$_POST[$key]=$mysqli->real_escape_string($value);
		}
		foreach ($_GET as $key => $value) {
			$value=strip_tags($value);
			$value=htmlspecialchars($value,ENT_QUOTES);
			$_GET[$key]=$mysqli->real_escape_string($value);
			
		}
	}
	
	switch ($_POST['do']) {
		case 'editmanga':
		editmanga();
		break;
		case 'editanime':
        editanime();
        break;
	}
	
	function editmanga(){
		global $mysqli,$id;
		$i = 0;
		$test='';
		$var['name']=$_POST['name'];
		$var['status']=$_POST['status'];
		$var['genre']=$_POST['genre'];
		$var['year']=$_POST['year'];
		$var['date_of_issue']=$_POST['date_of_issue'];
		$var['author']=$_POST['author'];
	$var['description']=$_POST['description'];
	
	$bd = mysqli_fetch_array($mysqli->query("SELECT `way`,`file_name` FROM `manga` WHERE `id`='$id'"));
	if(!file_exists($_FILES['file']['name']) || !is_uploaded_file($_FILES['file']['name'])) {
	$type = explode('/',$_FILES["file"]["type"]);
	if($type[1]=='png'||$type[1]=='jpeg'||$type[1]=='jpg'){
	if($_FILES['file']['size']> 1024*5*1024){
	header("location:http://fox-club.ru/admin/index.php?act=manga&do=editmanga&id=$id");
	exit;
	}else{
	if(getimagesize($_FILES["file"]["tmp_name"])){
	if(file_exists('../'.$bd['way'].'/'.$bd['file_name']))unlink('../'.$bd['way'].'/'.$bd['file_name']);
	move_uploaded_file($_FILES["file"]["tmp_name"], '../'.$bd['way'].'/'.basename($_FILES["file"]["tmp_name"]).'.jpg');
	$file=basename($_FILES["file"]["tmp_name"]).'.jpg';
	$mysqli->query("UPDATE `manga` SET `file_name` = '$file' WHERE `id` = '$id'");
	}
	}
	}
	}
	
	$len = count($var);
	foreach ($var as $key => $value) {
	if ($i != $len - 1) {
	$test.="`$key`='$value', ";
	}else{
	$test.="`$key`='$value' ";
	}
	$i++;
	}
	
	$mysqli->query("UPDATE `manga` SET $test WHERE `id` = '$id'");
	header("location:http://fox-club.ru/admin/index.php?act=manga&do=editmanga&id=$id");
	exit;
	}
	
	function editanime(){
	global $mysqli,$id;
	$i = 0;
	$test='';
	$var['name']=$_POST['name'];
	$var['status']=$_POST['status'];
	$var['genre']=$_POST['genre'];
	$var['year']=$_POST['year'];
	$var['date_of_issue']=$_POST['date_of_issue'];
	$var['author']=$_POST['author'];
	$var['description']=$_POST['description'];
	
	$bd = mysqli_fetch_array($mysqli->query("SELECT `way`,`file_name` FROM `manga` WHERE `id`='$id'"));
	if(!file_exists($_FILES['file']['name']) || !is_uploaded_file($_FILES['file']['name'])) {
	$type = explode('/',$_FILES["file"]["type"]);
	if($type[1]=='png'||$type[1]=='jpeg'||$type[1]=='jpg'){
	if($_FILES['file']['size']> 1024*5*1024){
	header("location:http://fox-club.ru/admin/index.php?act=manga&do=editmanga&id=$id");
	exit;
	}else{
	if(getimagesize($_FILES["file"]["tmp_name"])){
	if(file_exists('../'.$bd['way'].'/'.$bd['file_name']))unlink('../'.$bd['way'].'/'.$bd['file_name']);
	move_uploaded_file($_FILES["file"]["tmp_name"], '../'.$bd['way'].'/'.basename($_FILES["file"]["tmp_name"]).'.jpg');
	$file=basename($_FILES["file"]["tmp_name"]).'.jpg';
	$mysqli->query("UPDATE `manga` SET `file_name` = '$file' WHERE `id` = '$id'");
	}
	}
	}
	}
	
	$len = count($var);
	foreach ($var as $key => $value) {
	if ($i != $len - 1) {
	$test.="`$key`='$value', ";
	}else{
	$test.="`$key`='$value' ";
	}
	$i++;
	}
	
	$mysqli->query("UPDATE `manga` SET $test WHERE `id` = '$id'");
	header("location:http://fox-club.ru/admin/index.php?act=manga&do=editmanga&id=$id");
	exit;
	}
	
	
	
	
	
	
	
	
	
	//if($_FILES["file"]["size"] > 1024*5*1024){
	
	//}else{
	//if (getimagesize($_FILES["file"]["tmp_name"])) {
    //print_r(getimagesize($_FILES["file"]["tmp_name"]));
    //echo "изображение";
	//}else{
    //echo "не изображение";
	//}
	//move_uploaded_file($_FILES["file"]["tmp_name"], 'images/trash/'.basename($_FILES["file"]["tmp_name"]).'.jpg');
	
	//}
	//deleted manga
	function absd(){
	$directory='../images/manga/overlord';
	if($handle= @opendir($directory)){
	while (false !== ($file = readdir($handle))) {
	if($file=="." || $file == "..") continue;
	if(is_dir($directory.'/'.$file)){
	echo '====='.$file."======</br>";
	$hand = @opendir($directory.'/'.$file);
	while (false !== ($fil = readdir($hand))) {
	if($fil=="." || $fil == "..") continue;
	echo '-----'.$fil."----- </br>";
	unlink($directory.'/'.$file.'/'.$fil);
	}
	echo '====='.$file."====== delete </br>";
	rmdir($directory.'/'.$file);
	}else{
	echo '-----'.$file." -----</br>";
	unlink($directory.'/'.$file);
	}
	}
	rmdir($directory);
	closedir($hand);
	closedir($handle);
	}
	}
	
	//deleted chapter
	function delete_chapter(){
	$directory='../images/manga/tokyo_ghoul/chapter_1';
	if($handle= @opendir($directory)){
	while (false !== ($file = readdir($handle))) {
	if($file=="." || $file == "..") continue;
	unlink($directory.'/'.$file);
	}
	rmdir($directory);
	closedir($handle);
	}
	}
	//deleted titul
	function delete_titul(){
	$directory='../images/manga/tokyo_ghoul/chapter_2/001.png';
	if(file_exists($directory))unlink($directory);
	}
	
	
	
	
	//$namearchiv= explode('/',$name);
	//echo $namearchiv[0];
	//move_uploaded_file($_FILES["file"]["tmp_name"], 'images/trash/');
	//$zip = new ZipArchive;
	//$res = $zip->open('images/trash/001.zip');
	//$zip->extractTo('images/trash/001');
	//$zip->close();
	//unlink('images/trash/001.zip');
	//mkdir('images/trash/createdir',0750);
	//rmdir('images/trash/createdir');
	//if($handle= @opendir('images/trash/001')){
	//  while (false !== ($file = readdir($handle))) {
	//    if($file=="." || $file == "..") continue;
	//    if(is_file('images/trash/001/'.$file)){
	//      $type = explode('.',$file);
	//      if($type[1]=='png'||$type[1]=='jpeg'||$type[1]=='jpg'){
	//        if(getimagesize('images/trash/001/'.$file)){
	//          move_uploaded_file($file,'images/trash/001');
	//        }
	//      }
	//    }
	
	//$zip = new ZipArchive;
	//$res = $zip->open('test.zip', ZipArchive::CREATE);
	//if ($res === TRUE) {
	//    $zip->addFile('images/trash/phpsUk38E.jpg', 'newname.jpg');
	//    $zip->close();
	//    echo 'готово';
	//} else {
	//    echo 'ошибка';
	//}
	//closedir($handle)
	
	 */
	
	
	
	
	
	
	
	
	?>
		