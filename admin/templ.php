<?
	class templ{
		function __construct(){}
		function firstpage($data){
			return <<<EOF
			<div class = 'cont_box'>
				<div class='firstpage'>
					<ul>
						{$data}
					</ul>
				</div>
			</div>
EOF;
		}
		function addchapter($id){
		return <<<EOF
		<div class = 'cont_box'>
			<form action="sendbd.php"  method="post">
				<ul>
					<li>Том: <input type='text' name='tom'/></li>
					<li>Глава: <input type='text' name='chapter'/></li>
					<li>Наименование главы:<input type='text' name='chapter_name'/></li>
					<li	>Активность:<input type='checkbox'name='status' value="1"/></li>
					<li>Загрузить главу: <input type='file'/></li>
					<li><input type='submit' value='сохранить'/></li>
					<input type='hidden' name='do' value='addchapter'/>
					<input type='hidden' name='id' value='{$id}'/>
				</ul>
			</form>
		</div>
EOF;
		}
		function addmanga(){
		return <<<EOF
		<div class = 'cont_box'>
			<div>
				
			</div>
		</div>
EOF;
		}
		function manga($data){
		global $site_url;
		return <<<EOF
		<div class = 'cont_box'>
			<div class='manga_menu'>
			<form action=""  method="post">
				<input type='text'/>
				<input type='submit' value='Поиск'/>
			</form>
			<div style="clear:both"></div>
			</div>
			<div class='manga_content'>
				<table border="1">
					<tr>
						<td>Имя</td>
						<td>Активность</td>
						<td><a href='{$site_url}/index.php?act=manga&do=addmanga'>Добавить</a></td>
					</tr>
					<tr>
						{$data}
					</tr>
				</table>
			</div>
		</div>
EOF;
		}
		function edit_chapter($data){
			$status=($data['status']==1)?'checked':'';
			$add_data = date('H:i d/m/Y',$data['add_data']);
			$edit_data = date('H:i d/m/Y',$data['edit_data']);
			return <<<EOF
			<div class = 'cont_box'>
				<form action="functions.php"  method="post">
					<ul>
						<li>Том: <input type='text' name='tom' value='{$data['tom']}'/></li>
						<li>Глава: <input type='text' name='chapter' value='{$data['chapter']}'/></li>
						<li>Наименование главы:<input type='text' name='chapter_name' value='{$data['chapter_name']}'/></li>
						<li	>Активность:<input type='checkbox'name='status' value='{$data['status']}' {$status}/></li>
						<li>Загрузить главу: <input type='file'/></li>
						<li><input type='submit' value='сохранить'/></li>
						<input type='hidden' name='do' value='addchapter'/>
						<input type='hidden' name='id' value='{$data['id']}'/>
					</ul>
				</form>
			</div>
EOF;
		}
		function edit_manga($data,$chapters){
		global $site_url;
		$status=($data['status']=='1')?'checked':'';
		$add_data = date('H:i d/m/Y',$data['add_data']);
		$edit_data = date('H:i d/m/Y',$data['edit_data']);
		return <<<EOF
			<div class = 'cont_box'>
				<div class = 'desc'>
					<div>Дата последнего изменения:{$edit_data}</div>
					<div>Дата добавления:{$add_data}</div>
					<form action="{$site_url}/index.php?act=manga&id=7&do=editmanga"  method="post">
						<ul>
							<li>Наименование:<input type='text' value='{$data['name']}' name='name'/></li>
							<li	>Активность:<input type='checkbox'name='status' value='1' {$status} name='status'/></li>
							<li>Жанр:<input type='text' value='{$data['genre']}' name='genre'/></li>
							<li>Год:<input type='text' value='{$data['year']}' name='year'/></li>
							<li>Дата выпуска:<input type='text' value='{$data['date_of_issue']}' name='date_of_issue'/></li>
							<li>Автор:<input type='text' value='{$data['author']}' name='author'/></li>
							<li>Описание:<input type='textarea' value='{$data['description']}' name='description'/></li>
							<li>Загрузить изображение для манги: <input type='file'/></li>
							<li><input type='submit' value='Изменить'/></li>
							<input type='hidden' name='do' value='addchapter'/>
						</ul>
					</form>
				</div>
				<div class = 'chapter_box'>
				<table border="1">
					<tr>
						<td>Имя</td>
						<td>Активность</td>
						<td style='background-color: rgb(21, 227, 46);'><a href = "{$site_url}/index.php?act=mangachap&id={$data['id']}&do=addchapter">Добавить</a></td>
						<td style='background-color: rgb(21, 227, 46);'><a href=''>Добавить несколько</a></td>
					</tr>
					<tr>
					
						{$chapters}
						</tr>
					</table>
				</div>
			</div>
EOF;
		}
		function error($message){
			
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
		function menu_list($cont){
		return <<<EOF
		<div class='menu_list'>
			<ul>
				{$cont}
			</ul>
		</div>
EOF;
		}
		
		function login(){
		return <<<EOF
		<div>
					<form name="login" action="index.php?act=auth"  method="post">
						<input type="text" name="login"/>
						<input type="password" name="pass"/>
						<input type="submit" value="Войти"/>
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
				