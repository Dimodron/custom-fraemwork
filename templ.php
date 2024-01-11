<?
class templ{
  function menu(){
return <<<EOF
      <div class="site_cap">
      </div>
EOF;
  }
  function search(){
return <<<EOF
      <div class="search">
        <img src="images/search.png"/>
        <input type="text" id="search_window" autocomplete="off" placeholder = "Название аниме или манги..."/>
      </div>
      <div class="drop_list">
        <ul>
        </ul>
      </div>
EOF;
  }
  function slideshow($row_slide = array()){
return <<<EOF
      <li style="background-image:url('{$row_slide['image_url']}')"><h1>{$row_slide['title']}</h1><a href="{$row_slide['url']}" class="listbox_item">{$row_slide['button_title']}</a></li>
EOF;
  }
  function PopularManga($row_pop_m = array()){
return <<<EOF
      <div class="content"><li class="manga"><a href="index.php?act=manga&id={$row_pop_m["id"]}"><img src="{$row_pop_m["way"]}/{$row_pop_m["file_name"]}"/><h1>{$row_pop_m["name"]}</h1></a></li>
      <div style="clear:both"></div></div>
EOF;
  }
  function PopularAnime($row_pop_m = array()){
return <<<EOF
      <div class="content"><li class="manga"><a href="index.php?act=anime&id={$row_pop_m["id"]}"><img src="{$row_pop_m["way"]}/{$row_pop_m["file_name"]}"/><h1>{$row_pop_m["name"]}</h1></a></li>
      <div style="clear:both"></div></div>
EOF;
  }
  function NewChaptersOfPopularManga(){
return <<<EOF
      <div class="new_chap_popular_m"><div>Новые главы популярной манги</div></div>
EOF;
  }
  function latestUpdates(){
return <<<EOF
    <div class="latest_updates"><div>Последние обновления</div></div>
EOF;
  }
  function header($title='',$background='',$logo=''){
    return <<<EOF
    <html>
      <head>
        <title>
          {$title}
        </title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta content="no-cache" http-equiv="Pragma"/>
      <meta content="no-cache" http-equiv="no-cache"/>
      <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
      <link rel="stylesheet" href="style.css">
      </head>
        <body style="background-image: url('images/{$background}')">
          <a href="index.php"><img class="foxy"src="images/{$logo}"></a>
EOF;
  }
  function login(){
    return <<<EOF
    <div class="user_autoriz">
      <form action="index.php?act=log" method="post" enctype="multipart/form-data">
      <div><span>Напиши свое имя:</span><input name="log" autocomplete="off" type="text"/></div>
      <div><span>Напиши секретное слово:</span><input name="pass" type="password"/></div>
      <div><span>Запомнить логин и пароль</span><input name="check"type="checkbox" value="1"></div>
      <input type="submit"/>
    </form>
    </div>
EOF;
  }
  function regist(){
    return <<<EOF
    <div class="user_registration">
    <form action="index.php?act=reg" method="post" >
      <div><span>Придумай имя:</span><input type="text" autocomplete="off"name="log"/></div>
      <div><span>Придумай секретное слово:</span><input type="password" name="pass"/></div>
      <input type="submit"/>
    </form>
    </div>
EOF;
  }
  function chat_bot($data){
    global $user;
  $user=$user->member;
    return <<<EOF
    <div class="bot">
      <img src="{$data['way']}{$data['img']}">
      <div class="dialog">
        {$data['dialogue_text']}
      </div>
      <div class="answer">
        <span>{$user["login"]}</span>
        {$data['logauth']}
        {$data['answer_text']}
      </div>
    </div>
EOF;
  }
  function footer(){
return <<<EOF
      <div style="clear:both"></div>
      <div class="site_basement"></div>
      <script src="script.js"></script>
    </body>
  </html>
EOF;
  }
  function error($text){
return <<<EOF
    <h1>{$text}</h1>
EOF;
  }
  function manga($row_manga){
  return <<<EOF
      <div class="picture_man"><img src="{$row_manga["way"]}/{$row_manga["file_name"]}"/></div>
      <div class="description_man">
        <span class="manga_atrib">Название манги:</span> <span class="manga_atrib_zn">{$row_manga["name"]}</span>
        </br>
        <span class="manga_atrib">Год:</span> <span class="manga_atrib_zn">{$row_manga["year"]}</span>
        </br>
        <span class="manga_atrib">Жанр:</span> <span class="manga_atrib_zn">{$row_manga["genre"]}</span>
        </br>
        <span class="manga_atrib">Количество глав:</span> <span class="manga_atrib_zn">{$row_manga["count"]}</span>
        </br>
        <span class="manga_atrib">Дата выпуска:</span> <span class="manga_atrib_zn">{$row_manga["date_of_issue"]}</span>
        </br>
        <span class="manga_atrib">Автор:</span> <span class="manga_atrib_zn">{$row_manga["author"]}</span>
        </br>
        <span class="manga_atrib">Описание:</span> <span class="manga_atrib_zn">{$row_manga["description"]}</span>
    </div>
    <div style="clear:both"></div>
    <select class="manga_chapter">{$row_manga['jumpchapter']}</select>
EOF;
  }
  function manga_menu($manga){
return <<<EOF
      <div class="manga_menu">
        <div></div>
        <ul>{$manga}</ul>
      </div>
EOF;
  }
  function anime($row_anime){
    return <<<EOF
    <div class="picture_anim"><img src="{$row_anime["way"]}/{$row_anime["file_name"]}"/></div>
    <div class="description_anim">
      <span class="anime_atrib">Название манги:</span> <span class="manga_atrib_zn">{$row_anime["name"]}</span>
      </br>
      <span class="anime_atrib">Год:</span> <span class="manga_atrib_zn">{$row_anime["year"]}</span>
      </br>
      <span class="anime_atrib">Жанр:</span> <span class="manga_atrib_zn">{$row_anime["genre"]}</span>
      </br>
      <span class="anime_atrib">Количество серий:</span> <span class="manga_atrib_zn">{$row_anime["count"]}</span>
      </br>
      <span class="anime_atrib">Дата выпуска:</span> <span class="manga_atrib_zn">{$row_anime["date_of_issue"]}</span>
      </br>
      <span class="anime_atrib">Продюссер:</span> <span class="manga_atrib_zn">{$row_anime["producer"]}</span>
      </br>
      <span class="anime_atrib">Описание:</span> <span class="manga_atrib_zn">{$row_anime["description"]}</span>
  </div>
  <div style="clear:both"></div>
  <select class="anime_series">{$row_anime['jumpseries']}</select>
EOF;
  }
  function anime_viewer($row_anime){
return <<<EOF
      <div id="zoom"><img src=''/></div>
      <div class="screen">
        <fieldset class="field">
          <legend>Аниме состоит из:</legend>
          {$row_anime['screen']}
        </fieldset>
      </div>
      <div class="anime_wind"><iframe class="" width="640" height="384" src="{$row_anime['link']}" frameborder="0" scrolling="no" allowfullscreen></iframe></div>
EOF;
  }
  function anime_menu($anime){
return <<<EOF
      <div class="anime_menu">
        <ul>{$anime}</ul>
      </div>
EOF;
  }
  function manga_reader($chapter){
return <<<EOF
      <div class="manga_reader">
        <select>{$chapter['jumppages']}</select>
        <ul>{$chapter['pages']}</ul>
        <div class="count"></div>
      </div>
EOF;
  }
  function NewChaptersOfSelectedManga(){
  return <<<EOF
      <div class="new_chap_select_m"><div>Новые главы избранной манги</div></div>
EOF;
 }
}


?>
