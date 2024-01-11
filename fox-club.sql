-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 25 2020 г., 16:44
-- Версия сервера: 10.4.8-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fox-club`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `position` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `title`, `url`, `status`, `position`) VALUES
(1, 'Манга', 'index.php?act=manga', 0, 10),
(2, 'Аниме', 'index.php?act=anime', 1, 20),
(3, 'Чат бот', '', 1, 30),
(4, '<---', 'index.php?act=menu', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `anime`
--

CREATE TABLE `anime` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `add_data` int(11) NOT NULL,
  `edit_data` int(11) NOT NULL,
  `number_of_likes` int(11) DEFAULT 0,
  `year` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `date_of_issue` varchar(255) NOT NULL,
  `producer` varchar(255) NOT NULL,
  `original_author` varchar(255) NOT NULL,
  `studio` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `way` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `anime`
--

INSERT INTO `anime` (`id`, `name`, `status`, `add_data`, `edit_data`, `number_of_likes`, `year`, `genre`, `country`, `date_of_issue`, `producer`, `original_author`, `studio`, `description`, `file_name`, `way`) VALUES
(1, 'Токийский Гуль / Tokyo Ghoul', 0, 0, 0, 0, 2014, 'боевик, мистика, драма, ужасы', 'Japan', 'c 04.07.2014 по 19.09.2014', ' Морита Сюхэй', 'Исида Суи', 'StudioPierrot.png', 'Студент университета Канеки Кен в результате несчастного случая попадает в больницу, где ему по ошибке пересаживают органы одного из гулей - чудовищ, питающихся человеческой плотью. Теперь он сам становится одним из них, а для людей превращается в изгоя, подлежащего уничтожению. Но сможет ли он стать своим для других гулей? Или теперь в мире для него больше нет места? Это аниме расскажет о судьбе Канеки и том, какое влияние он окажет на будущее Токио, где идет непрерывная война между двумя видами.', '34dff4065de80ba980803dbf776db9ef.jpg', 'images/anime/tokyo_ghoul');

-- --------------------------------------------------------

--
-- Структура таблицы `anime_chapter`
--

CREATE TABLE `anime_chapter` (
  `id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `episode_title` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `add_data` int(11) NOT NULL,
  `edit_data` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `anime_chapter`
--

INSERT INTO `anime_chapter` (`id`, `anime_id`, `episode`, `episode_title`, `status`, `add_data`, `edit_data`, `link`) VALUES
(5, 1, 2, 'sadasd', 1, 0, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `bot_menu`
--

CREATE TABLE `bot_menu` (
  `id` int(11) NOT NULL,
  `for_authorized` int(1) NOT NULL DEFAULT 0,
  `action` varchar(255) NOT NULL DEFAULT 'home',
  `dialogue_text` text NOT NULL,
  `answer_text` text NOT NULL,
  `way` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bot_menu`
--

INSERT INTO `bot_menu` (`id`, `for_authorized`, `action`, `dialogue_text`, `answer_text`, `way`, `img`) VALUES
(1, 0, 'home', 'О, к нам гости.Меня называют Жрицей манги ,и я все знаю по манге.Ты можешь называть меня Манга.Чего бы ты хотел:\r\n', '<ul>\r\n<li><a data=\'4\' href=\"index.php?act=manga\">Я бы хотел посмотреть Мангу. </a></li>\r\n<li><a data=\"2\" href=\"index.php?act=homeanime\">Я бы хотел посмотреть Аниме.</a></li>\r\n<li><a data=\'3\' href=\"#\">\r\nПокажи что у тебя есть еще.\r\n</a>\r\n</li>\r\n</ul>', 'images/character/fox/', 'hello.png'),
(2, 0, 'home', 'Погоди, Семпай давай до...', '', 'images/character/fox/', 'farewell.png'),
(3, 0, 'home', 'Кхм , не так быстро Семпай.Здесь есть только часть моих способностей таких как \"Новые главы популярной манги\",\"Последняя добавленная манга\" и\"Популярная манга\".Для пробуждения других способностей тебе всего лишь нужно представиться:', '\r\n<ul>\r\n<li><a data=\"\" href=\"#\">Назвать имя</a></li>\r\n<li><a data=\"\" href=\"#\">Придумать имя</a></li>\r\n<li><a data=\"1\" href=\"#\">\r\nПопросить рассказать все с начала\r\n</a>\r\n</li>\r\n</ul>', 'images/character/fox/', 'manga-login-registr.png'),
(4, 0, 'home', 'Хо хо , я приготовила для тебя очень много всего....', '', 'images/character/fox/', 'list-manga.png'),
(5, 0, 'manga', '....', '', 'images/character/fox/', 'perehod-fox.png'),
(6, 0, 'homeanime', 'О,нове лицо.Я тебя здесь не видел.Меня зовут Анимаг и я владею сущностью аниме.Чтобы ты хотел узреть:', '<ul> <li><a data=\'7\' href=\"index.php\">Я бы хотел посмотреть Мангу. </a></li> <li><a data=\"\" href=\"index.php?act=anime\">Я бы хотел посмотреть Аниме.</a></li> <li><a data=\'3\' href=\"#\"> Покажи что у тебя есть еще. </a> </li> </ul>', 'images/character/cat/', 'hello.png'),
(7, 0, 'homeanime', 'Умри тысячу раз и не возвращайся', '', 'images/character/cat/', 'farewell.png');

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `parent_id_section` int(11) NOT NULL,
  `child_section_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `edit_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `logs`
--

INSERT INTO `logs` (`id`, `user`, `section`, `parent_id_section`, `child_section_id`, `name`, `edit_date`) VALUES
(1, 'admin', 'manga', 7, 1, '1 chapter', 1576243000),
(2, 'admin', 'manga', 7, 2, '2 chapter', 1576242000),
(3, 'admin', 'manga', 7, 3, '3 chapter', 1576230000);

-- --------------------------------------------------------

--
-- Структура таблицы `manga`
--

CREATE TABLE `manga` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `add_data` int(11) NOT NULL,
  `edit_data` int(11) NOT NULL,
  `number_of_likes` int(11) DEFAULT 0,
  `total_tom` varchar(100) NOT NULL,
  `total_chapters` varchar(100) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `date_of_issue` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `way` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `manga`
--

INSERT INTO `manga` (`id`, `name`, `status`, `add_data`, `edit_data`, `number_of_likes`, `total_tom`, `total_chapters`, `genre`, `year`, `date_of_issue`, `author`, `description`, `file_name`, `way`) VALUES
(7, 'Tokyo Ghoul/Токийский гуль', 1, 0, 1582731527, 100, '', '', 'ужасы, драмма, фантастика', 2011, 'c 8 сентября 2011 года по 18 сентября 2014 года', 'Исида Суи', 'Токийский гуль манга повествует о мире, где существуют два разумных вида - Люди и Гули, которые ежедневно воют на улицах Токио и питаются людьми. Поэтому для человечества Гули - это жестокие монстры, которых нужно полностью истребить. Манга токийский гуль рассказывает о студенте университета, который в результате якобы несчастного случая попадает в больницу, где ему пересаживают органы Гуля - монстра, который был вместе с ним, питающегося человеческой плотью. Теперь он сам становится одним из них, а для людей превращается в изгоя, подлежащего уничтожению. Что произойдет дальше? Манга токийский гуль читать онлайн будет интересно всем, кто любит захватывающий сюжет и приключения понравится читать онлайн мангу токийский гуль.', 'phpMbjUPb.jpg', 'images/manga/tokyo_ghoul'),
(8, 'Naruto', 1, 0, 0, 0, '', '', '', 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `manga_chapter`
--

CREATE TABLE `manga_chapter` (
  `id` int(11) NOT NULL,
  `manga_id` int(11) DEFAULT NULL,
  `tom` int(11) NOT NULL,
  `chapter` int(11) NOT NULL,
  `chapter_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `add_data` int(11) NOT NULL,
  `edit_data` int(11) NOT NULL,
  `way` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `manga_chapter`
--

INSERT INTO `manga_chapter` (`id`, `manga_id`, `tom`, `chapter`, `chapter_name`, `status`, `add_data`, `edit_data`, `way`) VALUES
(3, 7, 2, 3, 'Ужас', 1, 1563363935, 0, 'images/manga/tokyo_ghoul'),
(89, 4, 2, 3, 'Зоро, охотник на пиратов', 1, 1563363925, 0, 'images/manga/one_peace'),
(88, 4, 1, 2, 'Луффи по прозвищу Мугивара', 1, 1563363915, 0, 'images/manga/one_peace'),
(65, 7, 1, 4, 'Кофе', 1, 1563363655, 0, 'images/manga/tokyo_ghoul');

-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `log_date` int(11) DEFAULT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `session`
--

INSERT INTO `session` (`id`, `session_id`, `user_id`, `user_name`, `log_date`, `section`) VALUES
(2073, '3fb49ddb95d7c7f1fde8736e211e3769', 0, 'Guest', 1591349787, '');

-- --------------------------------------------------------

--
-- Структура таблицы `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `button_title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `position` int(11) NOT NULL DEFAULT 10,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `slideshow`
--

INSERT INTO `slideshow` (`id`, `title`, `button_title`, `url`, `status`, `position`, `image_url`) VALUES
(1, 'О наc', 'Читать', '', 1, 20, 'images/slideshow/79ded4461a767196d317ec5e08706117.jpg'),
(2, 'Популярное', 'Смотреть', '', 1, 30, 'images/slideshow/154360416613776023.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT 0,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `img` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `admin`, `login`, `pass`, `img`) VALUES
(10, 0, 'sekiro', '202cb962ac59075b964b07152d234b70', ''),
(9, 0, 'Chaverma', '4d34d28090c68efda473116062654212', ''),
(8, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', ''),
(11, 0, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', ''),
(12, 0, 'Kayne', '4d34d28090c68efda473116062654212', ''),
(14, 0, '1', 'c81e728d9d4c2f636f067f89cc14862c', ''),
(15, 0, 'Manga', '202cb962ac59075b964b07152d234b70', ''),
(16, 0, 'Lak', '202cb962ac59075b964b07152d234b70', ''),
(17, 0, 'sas', '202cb962ac59075b964b07152d234b70', ''),
(18, 0, 'Chaver', '4d34d28090c68efda473116062654212', ''),
(19, 0, 'Chaves', '6226f7cbe59e99a90b5cef6f94f966fd', ''),
(20, 0, 'lariz', 'c865be5baf7929abcef390311740798f', ''),
(21, 0, 'Mustafa', '81dc9bdb52d04dc20036dbd8313ed055', ''),
(22, 0, 'ss', '3691308f2a4c2f6983f2880d32e29c84', ''),
(0, 0, 'Guest', '', ''),
(24, 0, 'miron', '2be2f293088b40e3f364fa3393a079a9', ''),
(25, 0, 'jin', '84fff20659999e2b83b45c6851ec57dd', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `anime_chapter`
--
ALTER TABLE `anime_chapter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bot_menu`
--
ALTER TABLE `bot_menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file_name` (`file_name`);

--
-- Индексы таблицы `manga_chapter`
--
ALTER TABLE `manga_chapter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `anime`
--
ALTER TABLE `anime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `anime_chapter`
--
ALTER TABLE `anime_chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `bot_menu`
--
ALTER TABLE `bot_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `manga_chapter`
--
ALTER TABLE `manga_chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT для таблицы `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2075;

--
-- AUTO_INCREMENT для таблицы `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
