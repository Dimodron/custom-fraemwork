<?
	class templ{
		function login(){
		return <<<EOF
				<div>
					<form name="login" action="fox-club.ru"  method="get">
						<input type="text" name="login"/>
						<input type="password" name="pass"/>
						<input type="submit" value="Войти"/>
					</form>
				</div>
EOF;
		}
		function const_menu($data){
			return <<<EOF
				<div class="action_window">
					<ul>
						{$data}
					</ul>
				</div>
EOF;
		}
		function header(){
			return <<<EOF
			<html>
			<head>
			<title>
			Admin
			</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<meta content="no-cache" http-equiv="Pragma"/>
			<meta content="no-cache" http-equiv="no-cache"/>
			<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
			<link rel="stylesheet" href="style.css">
			</head>
			<body>
EOF;
		}
		function menu($data){
			return <<<EOF
			<div class="menu">
			<ul>
			{$data}
			</ul>
			</div>
EOF;
		}
		function manga(){
			return <<<EOF
			<div class="manga_list"></div>
			<div class="search-filter"></div>
EOF;
		}
		
		function action_manga($content="",$table){
			if(!isset($_GET["do"])||$_GET["do"]==""){$search="manga";$id="";}else{$search="manga";$id=$_GET["do"];}
			return <<<EOF
		<div class="action_window">
        <div class="search">
		<input type="text" class="search_winidw" id="{$id}" name="{$search}" autocomplete="off" placeholder = "Название аниме или манги..."/>
		</div>
		<div class="options"></div>
		<div style="clear:both"></div>
		<div class="folder">
		<table>
		<thead>
		<tr>
		{$table}
		</tr>
		</thead>
		<tbody>
		{$content}
		</tbody>
		</table>
		</div>
		</div>
EOF;
}
		function action_table($content=""){
		return <<<EOF
		<td class="td-property"> Настройки </td>
		<td class="td-id"> ID </td>
		<td class="td-name"> Наименование </td>
		<td class="td-activity"> Активность </td>
		<td class="td-number-likes">Дата добавления</td>
EOF;
		}
		function action_chap_row($row){
		$status=($row["status"]==1)?"Yes":"No";
		return <<<EOF
		<tr>
		<td><span><a href="index.php?act=manga&do=activchapter&id={$row["id"]}">Активировать</a></span>/<span><a href="index.php?act=manga&do=deletechapter&id={$row["id"]}">Удалить</a></span>/<span><a href="index.php?act=manga&do=editchapter&id={$row["id"]}">Изменить</a></span></td>
		<td>{$row["id"]}</td><td>{$row["chapter_name"]}</td>
		<td>{$status}</td><td>{$row["date"]}</td>
		</a>
		</tr>
EOF;
		}
		function action_manga_row($row){
		$status=($row["status"]==1)?"Yes":"No";
		return <<<EOF
		<tr>
		<td><span><a href="index.php?act=manga&do=activmanga&id={$row["id"]}">Активировать</a></span>/<span><a href="index.php?act=manga&do=deletemanga&id={$row["id"]}">Удалить</a></span>/<span><a href="index.php?act=manga&do=editmanga&id={$row["id"]}">Изменить</a></span></td>
		<td>{$row["id"]}</td><td><a href="index.php?act=manga&do=mangachap&id={$row["id"]}">{$row["name"]}</a></td>
		<td>{$status}</td><td>{$row["date"]}</td>
		</a>
		</tr>
EOF;
		}
		function action_episod_row($row){
		$status=($row["status"]==1)?"Yes":"No";
		return <<<EOF
		<tr>
		<td><span><a href="index.php?act=anime&do=activepisod&id={$row["id"]}">Активировать</a></span>/<span><a href="index.php?act=anime&do=deletepisod&id={$row["id"]}">Удалить</a></span>/<span><a href="index.php?act=anime&do=editepisod&id={$row["id"]}">Изменить</a></span></td>
		<td>{$row["id"]}</td><td>{$row["episode_title"]}</td>
		<td>{$status}</td><td>{$row["date"]}</td>
		</a>
		</tr>
EOF;
		}
		function action_anime_row($row){
		$status=($row["status"]==1)?"Yes":"No";
		return <<<EOF
		<tr>
		<td><span><a href="index.php?act=anime&do=activanime&id={$row["id"]}">Активировать</a></span>/<span><a href="index.php?act=anime&do=deleteanime&id={$row["id"]}">Удалить</a></span>/<span><a href="index.php?act=anime&do=editanime&id={$row["id"]}">Изменить</a></span></td>
		<td>{$row["id"]}</td><td><a href="index.php?act=anime&do=animepisod&id={$row["id"]}">{$row["name"]}</a></td>
		<td>{$status}</td><td>{$row["date"]}</td>
		</tr>
EOF;
		}
		function action_anime($content="",$table){
		(!isset($_GET["do"])||$_GET["do"]=="")?$search="anime":$search="anime";
		return <<<EOF
		<div class="action_window">
        <div class="search">
		<input type="text" class="search_winidw" id="{$search}" autocomplete="off" placeholder = "Название аниме или манги..."/>
		</div>
		<div class="options"></div>
		<div style="clear:both"></div>
		<div class="folder">
		<table>
		<thead>
		<tr>
		{$table}
		</tr>
		</thead>
		<tbody>
		{$content}
		</tbody>
		</table>
		</div>
		</div>
EOF;
		}
		function edit_anime(){
		return<<<EOF
		<div class="action_window">
		
		</div>
EOF;
		}
		function edit_episod(){
		return<<<EOF
		<div class="action_window">
		
		</div>
EOF;
		}
		function edit_manga($manga,$secret_key){
		return<<<EOF
		<div class="action_window">
		<form name="form_download"action="sendbd.php"  method="post" enctype="multipart/form-data">
		Дата изменения {$manga["edit_data"]}
		</br>
		Дата добавления {$manga["add_data"]}
		</br>
		<input type="hidden" name="secret_key" value="$secret_key" />
		<input type="hidden" name="do" value="editmanga"/>
		<input type="hidden" name="id" value="{$manga["id"]}"/>
		Название <input type="text"value="{$manga["name"]}" name="name"/>
		</br>
		Активно <input type="text" value="{$manga["status"]}" name="status"/>
		</br>
		Жанр <input type="text" value="{$manga["genre"]}" name="genre"/>
		</br>
		Год <input type="text" value="{$manga["year"]}" name="year"/>
		</br>
		Время выхода манги <input type="text" value="{$manga["date_of_issue"]}" name="date_of_issue"/>
		</br>
		Автор <input type="text" value="{$manga["author"]}" name="author"/>
		</br>
		Описание <textarea  name="description">{$manga["description"]}</textarea>
		</br>
		Загрузить лицевое изображение:<input type="file" name="file"/>
		</br>
		<input type="submit" value="Сохранить"/>
		</form>
		</div>
EOF;
		}
		
		function edit_chapter($manga){
		return<<<EOF
		<div class="action_window">
		<form name="form_download"action="sendbd.php"  method="post" enctype="multipart/form-data">
		Дата изменения {$manga["edit_data"]}
		</br>
		Дата добавления {$manga["add_data"]}
		</br>
		<input type="hidden" name="secret_key" value="$secret_key" />
		<input type="hidden" name="do" value="editmanga"/>
		<input type="hidden" name="id" value="{$manga["id"]}"/>
		Название <input type="text"value="{$manga["name"]}" name="name"/>
		</br>
		Активно <input type="text" value="{$manga["status"]}" name="status"/>
		</br>
		Жанр <input type="text" value="{$manga["genre"]}" name="genre"/>
		</br>
		Год <input type="text" value="{$manga["year"]}" name="year"/>
		</br>
		Время выхода манги <input type="text" value="{$manga["date_of_issue"]}" name="date_of_issue"/>
		</br>
		Автор <input type="text" value="{$manga["author"]}" name="author"/>
		</br>
		Описание <textarea  name="description">{$manga["description"]}</textarea>
		</br>
		Загрузить лицевое изображение:<input type="file" name="file"/>
		</br>
		<input type="submit" value="Сохранить"/>
		</form>
		</div>
EOF;
		}
		function footer(){
		return <<<EOF
		<script src="script.js"></script>
		</body>
		</html>
EOF;
		}
		}
		?>
				