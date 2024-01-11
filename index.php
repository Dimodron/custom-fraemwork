<?			
	$site_url='http://localhost/fox-club';
	include "templ.php";
	include "functions.php";
	include "users.php";
	$user= new user();
	$func = new func();
	$templ = new templ();
	$action = (isset($_GET['act']))?$_GET['act']:"";
	$user->check_user($action);
	switch ($action) {
		case 'manga':
		$func->manga();
		break;
		case 'anime':
		$func->anime();
		break;
		case 'homeanime':
		$func->print_page();
		break;
		case 'ajax':
		include "ajax.php";
		$ajax= new ajax();
		$ajax->const();
		break;
		default:
		$action="home";
		$func->print_page();
		break;
	}
?>
