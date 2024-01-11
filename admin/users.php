<?
	class user{
		function __construct(){
		}
		function login(){
			global $mysqli;
			if (isset($_SERVER['HTTP_REFERER'])) {
				$url=$_SERVER['HTTP_REFERER'];
			}else{$url='';}
			if(isset($_POST["login"])){
				$log=$_POST["login"];
				$pass=md5($_POST["pass"]);
				$check=$mysqli->query("SELECT * FROM `users` WHERE `login` = '{$log}' AND `pass` = '{$pass}'");	
				if (mysqli_num_rows($check)){//если нашел
					$user = mysqli_fetch_array($check);
					$sessionid = md5(time()); 
					$userid=$user['id'];
					$username=$user['login'];
					$time=time();
					//$mysqli->query("INSERT INTO `session` (`session_id`, `user_id`, `user_name`, `log_date`,`section`) VALUES ('$sessionid', '$userid', '$username', '$time','$url')");
					$_SESSION['id']=$sessionid;
					$_SESSION['user']=$username;
					$_SESSION['time']=$time;
					header("location:index.php?act=menu");
				}
			}else{header("location:index.php?act=login");}
			
			exit;
		}
	}
?>
