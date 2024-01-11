<?
	$site_url='http://fox-club.ru/admin';
	include "functions.php";
	include "templ.php";
	include "users.php";
	$func = new func();
	$templ = new templ();
	$action = (isset($_GET['act']))?$_GET['act']:"";
	switch ($action) {
		case 'ajax':
		include "ajax.php";
		$ajax= new ajax();
		$ajax->const();
		break;
		case 'anime':
		$func->action_anime();
		break;
		case 'manga':
		$func->action_manga();
		break;
		case 'menu':
		$func->const_menu();
		break;
		default:
		$func->login();
		break;
	}
	
?>
