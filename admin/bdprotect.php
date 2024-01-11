<?
input();
function input(){
	$data= '';
	$manga = $bdprotectf->query("SELECT * FROM `manga_chapter`");
	while (($row=$manga->fetch_assoc())!=false) {
		$data.= $row['chapter_name'].'|</br>';
	}
	echo $data;	
}
function bdprotect(){
	if (mysqli_connect("localhost","root","","fox-club")){
		$mysqli->query("SET NAMES'utf8'");	
		
	}else{
		die('Нет соединения с бд');
	}		
}
?>
