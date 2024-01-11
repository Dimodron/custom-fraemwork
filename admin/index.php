<?
	$site_url='http://fox-club.ru/admin';
	include "functions.php";
	include "templ.php";
	include "users.php";
	$func = new func();
	$templ = new templ();
	$usr = new user();
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
		$func->manga();
		break;
		case 'mangachap':
		$func->manga();
		break;
		break;
		case 'firstpage':
		$func->firstpage();
		break;
		case 'auth';
		$usr->login();
		break;
		default:
		$act = 'login';
		$func->login();
		break;
	}
	
?>
