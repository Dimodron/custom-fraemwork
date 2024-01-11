<?
	class ajax{
		function const(){
			$action = (isset($_POST['action']))?$_POST['action']:"";
			switch ($action) {
				case 'search':
				$this->search();
				break;
			}
		}
		function search(){
			global $mysqli;
			$act=$_POST['act'];
			switch ($act) {
				case 'anime':
				$this->search_anime();
				break;
				case 'manga':
				$this->search_manga();
				break;
				case 'mangachap':
				$this->search_mangachap();
				break;
				case 'animechap':
				$this->search_animechap();
				break;
			}
		}
		function search_animechap(){
			global $mysqli,$templ;
			$content='';
			$id=$_POST["id"];
			$row=array();
			$word="%".$_POST["name"]."%";
			$result=$mysqli->query("SELECT * FROM `anime_chapter` WHERE `episode_title` LIKE '$word'AND `anime_id`='$id'");
			while (($row=$result->fetch_assoc())!=false){
				$row['date']=date('H:i d/m/Y',$row['add_data']);
				$content.= $templ->action_episod_row($row);
			}
			die($content);
		}
		
		function search_mangachap(){
			global $mysqli,$templ;
			$content='';
			$id=$_POST["id"];
			$row=array();
			$word="%".$_POST["name"]."%";
		$result=$mysqli->query("SELECT * FROM `manga_chapter` WHERE `chapter_name` LIKE '$word'AND `manga_id`='$id'");
		while (($row=$result->fetch_assoc())!=false){
		$row['date']=date('H:i d/m/Y',$row['add_data']);
		$content.= $templ->action_chap_row($row);
		}
		die($content);
		}
		
		function search_anime(){
		global $mysqli,$templ;
		$content='';
		$row=array();
		$word="%".$_POST["name"]."%";
		$result=$mysqli->query("SELECT * FROM `anime` WHERE `name` LIKE '$word'");
		while (($row=$result->fetch_assoc())!=false){
		$row['date']=date('H:i d/m/Y',$row['add_data']);
		$content.= $templ->action_anime_row($row);
		}
		die($content);
		}
		function search_manga(){
		global $mysqli,$templ;
		$content='';
		$row=array();
		$word="%".$_POST["name"]."%";
		$result=$mysqli->query("SELECT * FROM `manga` WHERE `name` LIKE '$word'");
		while (($row=$result->fetch_assoc())!=false){
		$row['date']=date('H:i d/m/Y',$row['add_data']);
		$content.= $templ->action_manga_row($row);
		}
		die($content);
		}
		}
		?>
				